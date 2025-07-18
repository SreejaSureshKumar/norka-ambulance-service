<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ServiceApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Rules\AlphaSpaceNumChar;
use App\Rules\PhoneNumber;
use App\Rules\AlphaSpace;
use App\Models\DriverDetails;
use App\Models\ServiceDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AgencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            $columns = [
                0 => 'id',
                1 => 'application_no',
                2 => 'deceased_person_name',
                3 => 'passport_no',
                4 => 'country',
                5 => 'state',
                6 => 'status',
                7 => 'created_at',
            ];
            //fetch applications whic are submittedand pending for approval
            $totalData = ServiceApplication::where('application_status', 2)->where('service_status', 0)->count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            // Handle initial load vs sorted requests
            if (empty($request->input('order.0.column'))) {
                // Initial load - force created_at desc
                $order = 'created_at';
                $dir = 'desc';
            } else {
                // User clicked a column to sort
                $order = $columns[$request->input('order.0.column')] ?? 'created_at';
                $dir = $request->input('order.0.dir') ?? 'desc';
            }


            $query = ServiceApplication::with('countryRelation', 'stateRelation', 'driverDetails', 'agencyUser')->where('application_status', 2)
                ->where('agency_id', $user->id);

            // Search filter
            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');
                $query->where(function ($q) use ($search) {
                    $q->where('deceased_person_name', 'LIKE', "%{$search}%")
                        ->orWhere('passport_no', 'LIKE', "%{$search}%");
                });
                $totalFiltered = $query->count();
            }

            $applications = $query->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $routeName = 'application.application-details';
            $data = [];
            foreach ($applications as $app) {
                $id = encrypt($app->id);
                $url = URL::signedRoute('application.application-details', ['app_id' => $id]);
                $actions = '<div class="d-inline-flex gap-1">'; // Use d-inline-flex to avoid full width
                $actions .= '<a class="btn btn-primary view_but" href="' . $url . '" target="_blank">
                <div class="preview-icon-wrap"><em class="icon ni ni-eye"></em> View</div>
                </a>';
                $hasDriver = $app->driverDetails !== null;
                $serviceDate = $app->service_date ?? null;
                $serviceDate = \Carbon\Carbon::parse($app->arriving_date_time)->format('d-m-Y');
                $serviceExpired = $serviceDate && \Carbon\Carbon::parse($serviceDate)->isPast();

                if (!$hasDriver) {
                    if (!$serviceExpired) {
                        //assign driver
                        $actions .= '<a href="#" class="btn btn-primary add-details-modal"
            data-id="' . $app->id . '" data-number="' . $app->application_no . '">Assign Driver</a>';
                        $status = '<span class="badge bg-success align-self-center">Awaiting Driver</span>';
                    } else {
                        //service date expired but no driver assigned
                        $status = '<span class="badge bg-danger text-dark">Unattended</span>';
                    }
                } else {
                    if ($serviceExpired && $app->service_status == 0) {
                        //Mark as service completed
                        $actions .= '<button type="button" class="btn btn-success btn-sm confirm-complete"
                data-id="' . $app->id . '" >
                <em class="icon ni ni-check-circle"></em> Mark as Completed';
                        $status = '<span class="badge bg-warning text-dark">Awaiting Completion</span>';
                    } else {
                        $status = '<span class="badge bg-info text-dark">Assigned to driver</span>';
                    }
                }
                $actions .= '</div>';
                $data[] = [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'state' => $app->stateRelation->state_name,
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $status,
                    'created_at' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
                    'service_date' => $app->arriving_date_time ? \Carbon\Carbon::parse($app->arriving_date_time)->format('d-m-Y') : '',
                    'actions' =>  $actions,
                ];
            }

            return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data,
            ]);
        }
        return view('agency.new-application-list');
    }

    public function serviceCompletedList(Request $request)
    {
        $user = Auth::user();
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            $columns = [
                0 => 'id',
                1 => 'application_no',
                2 => 'deceased_person_name',
                3 => 'passport_no',
                4 => 'country',
                5 => 'state',
                6 => 'status',
                7 => 'created_at',
                8 => 'service_date'
            ];
            //fetch applications whic are submittedand pending for approval
            $totalData = ServiceApplication::whereIn('application_status',[2,4] )->where('service_status', 0)->count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            // Handle initial load vs sorted requests
            if (empty($request->input('order.0.column'))) {
                // Initial load - force created_at desc
                $order = 'created_at';
                $dir = 'desc';
            } else {
                // User clicked a column to sort
                $order = $columns[$request->input('order.0.column')] ?? 'created_at';
                $dir = $request->input('order.0.dir') ?? 'desc';
            }


            $query = ServiceApplication::with('countryRelation', 'stateRelation', 'driverDetails', 'agencyUser','serviceDetails')->whereIn('application_status', [2,4])
                ->where('agency_id', $user->id)->where('service_status', 1);

            // Search filter
            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');
                $query->where(function ($q) use ($search) {
                    $q->where('deceased_person_name', 'LIKE', "%{$search}%")
                        ->orWhere('passport_no', 'LIKE', "%{$search}%");
                });
                $totalFiltered = $query->count();
            }

            $applications = $query->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $routeName = 'application.application-details';
            $data = [];
            foreach ($applications as $app) {
                $id = encrypt($app->id);
                $url = URL::signedRoute('application.application-details', ['app_id' => $id]);
                $actions = '<div class="d-inline-flex gap-1">'; // Use d-inline-flex to avoid full width
                $actions .= '<a class="btn btn-primary view_but" href="' . $url . '" target="_blank">
                <div class="preview-icon-wrap"><em class="icon ni ni-eye"></em> View</div>
                </a>';
                $updatedService = $app->serviceDetails !== null;


                if (!$updatedService) {

                    //assign driver
                    $actions .= '<a href="#" class="btn btn-primary service-details-modal"
            data-id="' . $app->id . '" data-number="' . $app->application_no . '">Add details</a>';

                    $status = '<span class="badge bg-info text-dark">Service completed</span>';
                } else {

                    $status = '<span class="badge bg-success text-dark">Details submitted</span>';
                }
                $actions .= '</div>';
                $data[] = [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'state' => $app->stateRelation->state_name,
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $status,
                    'created_at' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
                    'service_date' => $app->arriving_date_time ? \Carbon\Carbon::parse($app->arriving_date_time)->format('d-m-Y') : '',
                    'actions' =>  $actions,
                ];
            }

            return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data,
            ]);
        }
        return view('agency.service-completed-list');
    }
    public function addDetails(Request $request)
    {
        $user = Auth::user();
        $app_id = $request->hid_application_id;

        $agency_id = $request->agency_id;
        $validatedData = $request->validate([
            'driver_name' => ['required', 'max:255', new AlphaSpace],
            'address' => ['required',  'max:255', new AlphaSpaceNumChar],
            'mobile' => ['required', new PhoneNumber('IN'), 'max:25']
        ], [], [
            'driver_name' => 'Name',
            'address' => 'Address',
            'mobile' => 'Mobile'

        ]);
        $data = array_merge($validatedData, [
            'application_id' => $app_id,
            'created_by' => $user->id,

        ]);
        $updated = DriverDetails::create($data);
        if ($updated) {
            DB::commit();
            return redirect()->route('agency.index')->with('success', 'Details added !');
        } else {
            DB::rollback();
            return redirect()->route('agency.index')->with('error_status', 'Failed !!!');
        }
    }
    public function markCompleted(Request $request)
    {
        $user = Auth::user();
        $app_id = $request->input('application_id');
        $app = ServiceApplication::findOrFail($app_id);


        if ($app->agency_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action!',
            ], 403);
        }

        $app->service_status = 1; // mark as completed

        if ($app->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Application marked as completed!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark application as completed!',
            ], 500);
        }
    }
    public function addServiceDetails(Request $request)
    {
        $user = Auth::user();
        $app_id = $request->hid_application_id;

        $app = ServiceApplication::findOrFail($app_id);
        $rules =  [
            'source_location' => ['required', 'max:255', new AlphaSpaceNumChar],
            'destination_location' => ['required', 'max:255', new AlphaSpaceNumChar],
            'total_distance' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'attachment_path' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ];

        $customAttributes = [
            'source_location' => 'Source Location',
            'destination_location' => 'Destination Location',
            'total_distance' => 'Total Distance',
            'amount' => 'Amount',
            'attachment_path' => 'Attachment',
        ];

        $validator = Validator::make($request->all(), $rules, [], $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        if ($request->hasFile('attachment_path')) {
            $file = $request->file('attachment_path');
            $extension = $file->getClientOriginalExtension();

            $up_filename = strtotime("now") . '.' . $extension;
            $filePath = 'documents/' . $up_filename;
            $attachuploaded = Storage::disk('public')->put(
                $filePath,
                file_get_contents($file->getRealPath())
            );
        }
        $data =  [
            'application_id' => $app_id,
            'created_by' => $user->id,
            'source_location' => $request->input('source_location'),
            'destination_location' => $request->input('destination_location'),
            'total_distance' =>  $request->input('total_distance'),
            'amount' => $request->input('amount'),
            'attachment_path' => $filePath,
        ];

        $serviceDetails = ServiceDetails::create($data);

        if ($serviceDetails) {

            return response()->json([
                'status' => true,
                'message' => 'Details submitted successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please try again.'
            ], 500);
        }
    }
}
