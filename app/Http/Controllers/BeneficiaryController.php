<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Application;
use App\Rules\AlphaSpaceNumChar;
use App\Rules\Passport;
use App\Rules\PhoneNumber;
use App\Rules\AlphaSpace;
use App\Models\Country;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Models\ServiceApplication;
use Illuminate\Support\Facades\Storage;
use App\Rules\DateValidation;
use App\Rules\ValidateArrivalTime;
use Illuminate\Support\Facades\DB;



class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax()) {
            $columns = [
                0 => 'id',
                1 => 'application_no',
                2 => 'deceased_person_name',
                3 => 'passport_no',
                4 => 'death_date',
                5 => 'country',
                6 => 'status',
                7 => 'service_type',
                8 => 'created_at',
            ];

            // Get current applications
            $currentQuery = Application::with('countryRelation')
                ->where('created_by', $user->id)
                ->select([
                    'id',
                    'application_no',
                    'deceased_person_name',
                    'passport_no',
                    'death_date',
                    'country',
                    'application_status as status',
                    'created_at'
                ]);

            // Get historical applications
            $historyQuery = ServiceApplication::with('countryRelation')
                ->where('created_by', $user->id)
                ->select([
                    'id',
                    'application_no',
                    'deceased_person_name',
                    'passport_no',
                    'country',
                    'application_status as status',
                    'created_at'
                ]);

            // Apply search filter to both queries
            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');

                $currentQuery->where(function ($q) use ($search) {
                    $q->where('deceased_person_name', 'LIKE', "%{$search}%")
                        ->orWhere('passport_no', 'LIKE', "%{$search}%")
                        ->orWhere('application_no', 'LIKE', "%{$search}%");
                });

                $historyQuery->where(function ($q) use ($search) {
                    $q->where('deceased_person_name', 'LIKE', "%{$search}%")
                        ->orWhere('passport_no', 'LIKE', "%{$search}%")
                        ->orWhere('application_no', 'LIKE', "%{$search}%");
                });
            }

            // Execute both queries
            $currentApps = $currentQuery->get()
                ->each(function ($app) {
                    $app->service_type = 'Death Repartiation';
                    $app->application_type = 1;
                });

            $historyApps = $historyQuery->get()
                ->each(function ($app) {
                    $app->service_type = 'Ambulance Service';
                    $app->application_type = 2;
                });

            // Combine collections

            $applications = collect();

            $currentApps->each(function ($item) use ($applications) {
                $applications->push($item);
            });

            $historyApps->each(function ($item) use ($applications) {
                $applications->push($item);
            });

            if (empty($request->input('order.0.column'))) {
                // Initial load - force created_at desc
                $order = 'created_at';
                $dir = 'desc';
            } else {
                // User clicked a column to sort
                $order = $columns[$request->input('order.0.column')] ?? 'created_at';
                $dir = $request->input('order.0.dir') ?? 'desc';
            }



            $applications = $applications->sortBy($order, SORT_REGULAR, $dir === 'desc');
            // Get counts before pagination
            $totalData = $currentQuery->count() + $historyQuery->count();
            $totalFiltered = !empty($request->input('search.value'))
                ? $applications->count()
                : $totalData;

            // Apply pagination
            $limit = $request->input('length');
            $start = $request->input('start');
            $applications = $applications->slice($start, $limit);

            // Format data for DataTables
            $data = $applications->map(function ($app) {
                $id = encrypt($app->id);

                if ($app->status == 1 || $app->status == 2 || $app->status == 3 || $app->status == 4) {
                    $url = $app->application_type == 1
                        ? URL::signedRoute('beneficiary.application-show', ['app_id' => $id])
                        : URL::signedRoute('beneficiary.application-details', ['app_id' => $id]);

                    $label = 'View';
                } elseif ($app->status == 0) {
                    $label = 'Apply';
                    $url = $app->application_type == 2 ? route('beneficiary.service-application-form', ['resume' => 1, 'id' => encrypt($app->id)]) : '';
                }


                $downloadUrl =  URL::signedRoute('application.generate-application-pdf', ['app_id' => $id]);




                return [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'death_date' => $app->death_date ? Carbon::parse($app->death_date)->format('d-m-Y') : '',
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $this->getStatusBadge($app),
                    'service_type' => $app->service_type,
                    'created_at' => $app->created_at->format('d-m-Y'),
                    'actions' => $this->getActionButtons($url, $downloadUrl, $app, $label)
                ];
            });

            return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data->values()
            ]);
        }

        return view('beneficiary.application-list');
    }

    private function getStatusBadge($application)
    {
        $status = $application->status;
        $serviceStatus = $application->service_status;
        $applicationType = $application->application_type;

        // Only check driverDetails if from application_type 2
        $hasDriverAssigned = ($applicationType == 2) && !empty($application->driverDetails);

        if ($status == 2) {
            if ($applicationType == 2) {
                if (!$hasDriverAssigned) {
                    return '<span class="badge bg-info text-dark">Approved</span>';
                }
                if ($hasDriverAssigned && $serviceStatus == 1) {
                    return '<span class="badge bg-success text-dark">Service Completed</span>';
                }

                if ($hasDriverAssigned && $serviceStatus == 0) {
                    return '<span class="badge bg-primary">Driver Assigned</span>';
                }
            }

            // For application_type == 1 (Death Repatriation)
            return '<span class="badge bg-success">Approved</span>';
        }

        return match ($status) {

            1 => '<span class="badge bg-primary text-dark">Submitted</span>',
            3 => '<span class="badge bg-danger text-dark">Rejected</span>',
            4 => '<span class="badge bg-success text-dark">Service Completed</span>',
            default => '<span class="badge bg-warning text-dark">Pending</span>',
        };
    }

    private function getActionButtons($url, $downloadUrl, $app, $label)
    {

        $buttons = '<div class="d-flex gap-2">';
        $buttons .= '<a class="btn btn-primary  view_but" href="' . $url . '" target="_blank"><div class="preview-icon-wrap"> ' . $label . '</div></a>';

        if ($app->status == 2 && $app->type == 1) {
            $buttons .=
                '<a href="' . $downloadUrl . '" class="btn btn-success document-modal-control popup" data-download="" title="Download">
                        <div class="preview-icon-wrap"><i class="ti ti-file-download"></i></div>
                     </a>';
        }

        return $buttons . '</div>';
    }
    public function applicationForm(Request $request): View
    {
        $countries = Country::all()->where('active', 'Y');
        return view('beneficiary.submit-application', compact('countries'));
    }
    public function serviceApplicationForm(Request $request): View
    {
        $user = Auth::user();
        $is_resume = $request->query('resume');
        $app_id = $request->query('id');

        $countries = Country::all()->where('active', 'Y');
        $states = \App\Models\State::all()->where('state_status', 1);

        $application = null;

        if ($is_resume == 1 && $app_id) {
            $id = decrypt($app_id);

            $application = ServiceApplication::where('created_by', $user->id)
                ->where('id', $id)
                ->where('application_status', 0)
                ->first();
        }
        return view('beneficiary.service-application-form', compact('countries', 'states', 'application'));
    }
    /**
     * Store a newly created death departure application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitApplication(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $iso_code = strtoupper($request->mobile_country_iso_code);

        $validated = $request->validate([
            'deceased_person_name' => ['required',  'max:255', new AlphaSpace],
            'passport_no' => ['required',  new Passport],
            'death_date' => ['required', 'date'],
            'cause_of_death' => ['required',  'max:255', new AlphaSpaceNumChar],
            'country' => ['required',  'max:255', new AlphaSpaceNumChar],
            'sponsor_details' => ['required', 'max:1000', new AlphaSpaceNumChar],
            'contact_abroad_name' => ['required', 'max:255', new AlphaSpace],
            'contact_abroad_phone' => ['required', new PhoneNumber($iso_code), 'max:25'],
            'contact_local_name' => ['required', 'max:255', new AlphaSpace],
            'contact_local_phone' => ['required', new PhoneNumber('IN'), 'max:25'],
            'alt_contact_abroad_name' => ['nullable', 'max:255', new AlphaSpace],
            'alt_contact_abroad_phone' => ['nullable', new PhoneNumber($iso_code), 'max:25'],
            'alt_contact_local_name' => ['nullable',  'max:255', new AlphaSpace],
            'alt_contact_local_phone' => ['nullable', new PhoneNumber('IN'), 'max:25'],
            'airport_from' => ['required',  'max:255', new AlphaSpaceNumChar],
            'airport_to' => ['nullable', 'max:255', new AlphaSpaceNumChar],
            'native_address' => ['required',  'max:1000', new AlphaSpaceNumChar],
            'cargo_norka_status' => ['nullable', 'numeric', 'in:0,1'],
            'intimation_flag' => ['nullable', 'numeric', 'in:0,1'],
            'ambulance_service_status' => ['nullable', 'numeric', 'in:0,1'],
            'mobile_country_code' => ['required', 'numeric'],
            'alt_mobile_country_code' => ['nullable', 'numeric'],
            'application_attachment' => ['required', 'array', 'max:5'],
            'application_attachment.0' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'application_attachment.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],

        ], [ //custom   messages
        ], [

            'deceased_person_name' => 'Deceased person name',
            'passport_no' => 'Passport number',
            'death_date' => 'Death date',
            'cause_of_death' => 'Cause of death',
            'country' => 'Country',
            'sponsor_details' => 'Sponsor details',
            'contact_abroad_name' => 'Contact Person Abroad (name)',
            'contact_abroad_phone' => 'Contact Number',
            'contact_local_name' => 'Local contact (name)',
            'contact_local_phone' => 'Local Contact number',
            'alt_contact_abroad_name' => 'Alternative Contact Name',
            'alt_contact_local_name' => 'Alternative Contact Name',
            'alt_contact_local_phone' => 'Alternative Contact Number',
            'alt_contact_abroad_phone' => 'Alternative Contact Name',
            'application_attachment.0.required' => 'At least one attachment is required.'
        ]);

        $maxAttempts = 20;
        $attempt = 0;

        do {
            $randomNumber  = mt_rand(100000, 999999);
            $currentYear   = date('Y');
            $application_no = "ROOTS/D&SDI/MR{$randomNumber}/{$currentYear}";

            $attempt++;
        } while (
            ServiceApplication::where('application_no', $application_no)->exists() &&
            $attempt < $maxAttempts
        );

        if ($attempt === $maxAttempts) {
            return back()
                ->withErrors(['application_no' => 'Failed!! Please try again.'])
                ->withInput();
        }


        $data = array_merge($validated, [
            'application_status' => 1,
            'created_by' => $user->id,
            'application_no' => $application_no,
        ]);
        // try {

        DB::beginTransaction();
        $new_application = Application::create($data);
        if ($request->ambulance_service_status == 1) {
            $data = [
                'deceased_person_name' => $request->deceased_person_name,
                'passport_no' => $request->passport_no,
                'country' => $request->country,
                'contact_abroad_name'  => $request->contact_abroad_name,
                'contact_abroad_phone' => $request->contact_abroad_phone,
                'contact_local_name' => $request->contact_local_name,
                'contact_local_phone' => $request->contact_local_phone,
                'alt_contact_abroad_name' => $request->alt_contact_abroad_name,
                'alt_contact_local_name' => $request->alt_contact_local_name,
                'alt_contact_local_phone' => $request->alt_contact_local_phone,
                'alt_contact_abroad_phone' => $request->alt_contact_abroad_phone,
                'native_address' => $request->native_address,
                'created_by' => $user->id,
                'intimation_flag' => $request->intimation_flag ?? 0,
                'arrival_airport' => $request->airport_to,
                'mobile_country_code' => $request->mobile_country_code,

                'mobile_country_iso_code' => $request->mobile_country_iso_code

            ];
            if ($request->filled('alt_contact_abroad_phone')) {
                $data = array_merge($data, [
                    'alt_mobile_country_code' => $request->alt_mobile_country_code,
                    'alt_mobile_iso_code'     => $request->alt_mobile_iso_code,
                ]);
            }

            $service_application = ServiceApplication::create($data);
        }
        if ($new_application) {
            DB::commit();
            return redirect()->route('beneficiary.index')->with('success', 'Application submitted successfully!');
        } else {
            DB::rollback();
            return redirect()->route('beneficiary.application-form')->with('error_status', 'Failed !!!');
        }
        // } catch (\Exception $e) {

        // }

    }

    public function applicationSubmission(Request $request): RedirectResponse
    {

        $user = Auth::user();
        $iso_code = strtoupper($request->mobile_country_iso_code);
        $app_id = $request->application_id;

        $validated = $request->validate([
            // Personal Information
            'deceased_person_name' => ['required', 'max:255', new AlphaSpace],
            'passport_no' => ['required',  new Passport],
            'country' => ['required', 'numeric'],

            // Contact Information
            'contact_abroad_name' => ['required', 'max:255', new AlphaSpace],
            'contact_abroad_phone' => ['required', new PhoneNumber($iso_code), 'max:25'],
            'contact_local_name' => ['required', 'max:255', new AlphaSpace],
            'contact_local_phone' => ['required', new PhoneNumber('IN'), 'max:25'],
            'alt_contact_abroad_name' => ['nullable', 'max:255', new AlphaSpace],
            'alt_contact_abroad_phone' => ['nullable', new PhoneNumber($iso_code), 'max:25'],
            'alt_contact_local_name' => ['nullable',  'max:255', new AlphaSpace],
            'alt_contact_local_phone' => ['nullable', new PhoneNumber('IN'), 'max:25'],
            'mobile_country_code' => ['required', 'numeric'],
            'alt_mobile_country_code' => ['nullable', 'numeric'],


            // Flight Information
            'flight_no' => ['required',  'max:10', new AlphaSpaceNumChar],
            'departure_date' => ['required', 'date', 'after_or_equal:today'],
            'departure_time' => ['required', 'date_format:H:i'],
            'arriving_date' => ['required', 'date', new DateValidation($request->departure_date)],
            'arriving_time' => ['required', 'date_format:H:i', new ValidateArrivalTime($request->departure_date, $request->arriving_date, $request->departure_time)],
            'arrival_airport' => ['required', 'max:255', new AlphaSpaceNumChar],
            // Location Information
            'state' => ['required', 'numeric'],
            'district' => ['required', 'numeric'],
            'native_address' => ['required', 'max:255', new AlphaSpaceNumChar],

            // File Upload
            'application_attachment' => ['required', 'array', 'max:5'],
            'application_attachment.0' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'application_attachment.*' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            // 'intimation_flag' => ['nullable', 'numeric', 'in:0,1'],


        ], [], [
            // Personal Information
            'deceased_person_name' => 'Name',
            'passport_no' => 'Passport',
            'country' => 'Country',

            // Contact Information
            'contact_abroad_name' => 'Abroad Contact(name)',
            'contact_abroad_phone' => 'Abroad Contact Number',
            'contact_local_name' => 'Local Contact(name)',
            'contact_local_phone' => 'Local Contact Number',
            'alt_contact_abroad_name' => 'Abroad Contact(Name)',
            'alt_contact_abroad_phone' =>  'Abroad Contact Number',
            'alt_contact_local_name' => 'Local Contact(name)',
            'alt_contact_local_phone' => 'Local Contact Number',

            // Flight Information
            'flight_no' => 'Flight No',
            'departure_date' => 'Departure Date',
            'departure_time' => 'Departure Time',
            'arriving_date' => 'Arrival Date',
            'arriving_time' => 'Arrival Time',

            // Location Information
            'state' => 'State',
            'district' => 'District',
            'native_address' => 'Address',

            // File Upload
            'application_attachment' => 'Attachment',
            'application_attachment.0' => 'Attachment',
            'application_attachment.*' =>'Attachment'
        ]);
        // Combine date and time
        $departureDatetime = Carbon::parse($request->departure_date . ' ' . $request->departure_time);
        $arrivalDatetime = Carbon::parse($request->arriving_date . ' ' . $request->arriving_time);


        // if ($request->hasFile('application_attachment')) {
        //     $file = $request->file('application_attachment');
        //     $extension = $file->getClientOriginalExtension();

        //     $up_filename = strtotime("now") . '.' . $extension;
        //     $filePath = 'documents/' . $up_filename;
        //     $attachuploaded = Storage::disk('public')->put(
        //         $filePath,
        //         file_get_contents($file->getRealPath())
        //     );


        //     if (!$attachuploaded) {
        //         throw new \Exception("Failed to store file");
        //     }
        // }
        $maxAttempts = 20;
        $attempt = 0;

        do {
            $randomNumber  = mt_rand(100000, 999999);
            $currentYear   = date('Y');
            $application_no = "ROOTS/D&SDI/A1{$randomNumber}/{$currentYear}";

            $attempt++;
        } while (
            ServiceApplication::where('application_no', $application_no)->exists() &&
            $attempt < $maxAttempts
        );

        if ($attempt === $maxAttempts) {
            return back()
                ->withErrors(['application_no' => 'Failed!! Please try again.'])
                ->withInput();
        }

        // Merge validated input with extra columns
        $data = [
            "deceased_person_name" => $request->deceased_person_name,
            "passport_no" => $request->passport_no,
            "country"=>$request->country,

            "contact_abroad_name" => $request->contact_abroad_name,
            "contact_abroad_phone" => $request->contact_abroad_phone,
            "mobile_country_code" => $request->mobile_country_code,
            "mobile_country_iso_code" => $request->mobile_country_iso_code,
            "alt_contact_abroad_name" => $request->alt_contact_abroad_name,
            "alt_contact_abroad_phone" => $request->alt_contact_abroad_phone,
            "contact_local_name" => $request->contact_local_name,
            "contact_local_phone" => $request->contact_local_phone,
            "alt_contact_local_name" => $request->alt_contact_local_name,
            "alt_contact_local_phone" => $request->alt_contact_local_phone,
            "flight_no" => $request->flight_no,

            "native_address" => $request->native_address,
            'application_status' => 1,
            'created_by' => $user->id,
            'application_no' => $application_no,
            'departure_date_time' =>  $departureDatetime,
            'arriving_date_time' => $arrivalDatetime,


        ];

        if ($request->filled('alt_contact_abroad_phone')) {
            $data = array_merge($data, [
                'alt_mobile_country_code' => $request->alt_mobile_country_code,
                'alt_mobile_iso_code' =>$request->alt_mobile_country_code

            ]);
        }
        if ($request->filled('application_id')) {
            $application = ServiceApplication::find($request->application_id);
            $application->update($data);
        } else {
            $application = ServiceApplication::create($data);
        }

        // Handle file uploads for multiple files
        if ($request->hasFile('application_attachment')) {
            foreach ($request->file('application_attachment') as $file) {
                if ($file && is_object($file)) { // skip empty or invalid
                    $extension = $file->getClientOriginalExtension();
                    $up_filename = strtotime("now") . '_' . uniqid() . '.' . $extension;
                    $filePath = 'documents/' . $up_filename;
                    $attachuploaded = Storage::disk('public')->put(
                        $filePath,
                        file_get_contents($file->getRealPath())
                    );
                    if (!$attachuploaded) {
                        throw new \Exception("Failed to store file");
                    }
                    // Save to new attachment table
                    \App\Models\ServiceApplicationAttachment::create([
                        'application_id' => $application->id,
                        'attachment_path' => $filePath,
                    ]);
                }
            }
        }

        return redirect()->route('beneficiary.index')->with('success', 'Application submitted successfully!');
    }
    public function show($id): View
    {

        $previousMenuUrl = url()->previous();
        $previousMenuLabel = 'Application List';

        $beneficiary = config('customredirects.user_types.beneficiary');
        $official = config('customredirects.user_types.official_user');

        $user = Auth::user();

        //enale user to verify /approve the application
        $edit_enable = 0;
        $id = Crypt::decrypt($id);
        $application = Application::with('countryRelation')->findOrFail($id);
        return view('beneficiary.application-details', compact('application', 'edit_enable', 'previousMenuLabel', 'previousMenuUrl', 'user', 'beneficiary', 'official'));
    }
    public function applicationDetails($id)
    {
        $previousMenuUrl = url()->previous();
        $previousMenuLabel = 'Application List';

        $beneficiary = config('customredirects.user_types.beneficiary');
        $official = config('customredirects.user_types.official_user');
        $nodal_officer = config('customredirects.user_types.nodal_officer');
        $user = Auth::user();

        //enale user to verify /approve the application
        $edit_enable = 0;
        $id = Crypt::decrypt($id);
        $application = ServiceApplication::with('countryRelation', 'stateRelation', 'districtRelation')->findOrFail($id);
        return view('beneficiary.application-view', compact('application', 'edit_enable', 'previousMenuLabel', 'previousMenuUrl', 'user', 'beneficiary', 'official', 'nodal_officer'));
    }
    /**
     * validate the application form fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validateApplication(Request $request)
    {

        $field_name = $request->field_name;
        $rules = [
            'deceased_person_name' => ['required', 'max:255', new AlphaSpace],
            'passport_no' => ['required',  new Passport],
            'death_date' => ['required', 'date'],
            'cause_of_death' => ['required',  'max:255', new AlphaSpaceNumChar],
            'country' => ['required', 'numeric'],
            'sponsor_details' => ['required', 'max:1000', new AlphaSpaceNumChar],
            'contact_abroad_name' => ['required', 'max:255', new AlphaSpace],

            'contact_local_name' => ['required', 'max:255', new AlphaSpace],
            'contact_local_phone' => ['required', new PhoneNumber('IN'), 'max:25'],
            'alt_contact_abroad_name' => ['nullable',  'max:255', new AlphaSpace],

            'alt_contact_local_name' => ['nullable', 'max:255', new AlphaSpace],
            'alt_contact_local_phone' => ['nullable', new PhoneNumber('IN'), 'max:25'],
            'airport_from' => ['required', 'max:255', new AlphaSpaceNumChar],
            'airport_to' => ['nullable', 'max:255', new AlphaSpaceNumChar],
            'native_address' => ['required', 'max:1000', new AlphaSpaceNumChar],
            'cargo_norka_status' => ['nullable', 'numeric', 'in:0,1'],
        ];
        if (!in_array($request->field_name, array_keys($rules), true)) {
            return response()->json(['message' => "Invalid field!"], 422);
        }
        $validator = Validator::make($request->all(), [
            $field_name => $rules[$field_name],
        ], [], [
            'deceased_person_name' => 'Deceased person name',
            'passport_no' => 'Passport number',
            'death_date' => 'Death date',
            'cause_of_death' => 'Cause of death',
            'country' => 'Country',
            'sponsor_details' => 'Sponsor details',
            'contact_abroad_name' => 'Contact Person Abroad ',
            'contact_abroad_phone' => 'Contact Number',
            'contact_local_name' => 'Local contact ',
            'contact_local_phone' => 'Local contact number',
            'airport_from' => 'Departure airport',
            'airport_to' => 'Arrival airport',
            'native_address' => 'Native address',
            'cargo_norka_status' => 'NORKA cargo status',
            'alt_contact_abroad_name' => 'Alternative Contact Name',
            'alt_contact_local_name' => 'Alternative Contact Name',
            'alt_contact_local_phone' => 'Alternative Contact Number'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            return response()->json(['message' => "Field validated successfully!"]);
        }
    }
    public function applicationValidation(Request $request)
    {
        $field_name = $request->field_name;

        $rules =  [
            // Personal Information
            'deceased_person_name' => ['required',  'max:255', new AlphaSpace],
            'passport_no' => ['required',  new Passport],
            'country' => ['required', 'numeric'],

            // Contact Information
            'contact_abroad_name' => ['required', 'max:255', new AlphaSpace],
            'contact_abroad_phone' => ['required', new PhoneNumber('IN'), 'max:25'],
            'contact_local_name' => ['required', 'max:255', new AlphaSpace],
            'contact_local_phone' => ['required', new PhoneNumber('IN'), 'max:25'],
            'alt_contact_abroad_name' => ['nullable',  'max:255', new AlphaSpace],

            'alt_contact_local_name' => ['nullable', 'max:255', new AlphaSpace],
            'alt_contact_local_phone' => ['nullable', new PhoneNumber('IN'), 'max:25'],

            // Flight Information
            'flight_no' => ['required',  'max:10', new AlphaSpaceNumChar],
            'departure_date' => ['required', 'date', 'after_or_equal:today'],
            'departure_time' => ['required', 'date_format:H:i'],
            'arrival_airport' => ['required', 'max:255', new AlphaSpaceNumChar],

            // Location Information
            'state' => ['required', 'numeric'],
            'district' => ['required', 'numeric'],
            'native_address' => ['required', 'max:255', new AlphaSpaceNumChar],

            // File Upload
            'application_attachment.0' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'application_attachment.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],


        ];
        if (!in_array($request->field_name, array_keys($rules), true)) {
            return response()->json(['message' => "Invalid field!"], 422);
        }
        $validator = Validator::make($request->all(), [
            $field_name => $rules[$field_name],
        ], [], [
            // Personal Information
            'deceased_person_name' => 'Name',
            'passport_no' => 'Passport',
            'country' => 'Country',

            // Contact Information
            'contact_abroad_name' => 'Abroad Contact(name)',
            'contact_abroad_phone' => 'Abroad Contact Number',
            'contact_local_name' => 'Local Contact(name)',
            'contact_local_phone' => 'Local Contact Number',

            // Flight Information
            'flight_no' => 'Flight No',
            'departure_date' => 'Departure Date',
            'departure_time' => 'Departure Time',
            'arrival_airport' => 'Arrival Airport',

            // Location Information
            'state' => 'State',
            'district' => 'District',
            'native_address' => 'Address',

            // File Upload
            'application_attachment' => 'Attachment'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            return response()->json(['message' => "Field validated successfully!"]);
        }
    }
    public function datefieldValidation(Request $request)
    {
        $field_name = $request->field_name;

        $rules =  [
            'arriving_date' => ['required', 'date', new DateValidation($request->departure_date)],
            'arriving_time' => ['required', 'date_format:H:i', new ValidateArrivalTime($request->departure_date, $request->arriving_date, $request->departure_time)],
        ];
        $validator = Validator::make($request->all(), [
            $field_name => $rules[$field_name],
        ], [], [
            'arriving_date' => 'Arrival Date',
            'arriving_time' => 'Arrival Time',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            return response()->json(['message' => "Field validated successfully!"]);
        }
    }
    public function loadDistricts(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:m_states,state_id'
        ]);

        $districts =  \App\Models\District::where('state_id', $request->state_id)
            ->orderBy('district_name')
            ->get(['district_id', 'district_name']);

        return response()->json([
            'districts' => $districts
        ]);
    }
}
