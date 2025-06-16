<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use App\Rules\AlphaSpaceNumChar;
use App\Models\UserComponent;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationProcessingEmail;



class ApplicationController extends Controller
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
    /**
     * Show the application form for beneficiaries.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request): View|\Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $beneficiary = config('customredirects.user_types.beneficiary');
        $offcial = config('customredirects.user_types.official_user');


        // Check if the request is an AJAX request
        if ($request->ajax()) {
            $columns = [
                0 => 'id',
                1 => 'application_no',
                2 => 'deceased_person_name',
                3 => 'passport_no',
                4 => 'death_date',
                5 => 'country',
                6 => 'status',
                7 => 'created_at',
            ];

            //fetch applications whic are submittedand pending for approval
            $totalData = Application::where('application_status', 1)->count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column') ?? 0] ?? 'id';
            $dir = $request->input('order.0.dir') ?? 'desc';

            $query = Application::with('countryRelation')->where('application_status', 1);

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

            $routeName = 'application.show';
            $data = [];
            foreach ($applications as $app) {
                $id = encrypt($app->id);
                $url = URL::signedRoute('application.show', ['app_id' => $id]);

                $data[] = [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'death_date' => \Carbon\Carbon::parse($app->death_date)->format('d-m-Y'),
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $app->application_status == 2 ? 'Approved' : ($app->application_status == 3 ? 'Rejected' : 'Pending'),
                    'created_at' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
                    'actions' => '<a class="btn btn-primary view_but" href="' . $url . '" target="_blank" >
                    <div class="preview-icon-wrap"><em class="icon ni ni-eye"></em> View</div>
                  </a>',
                ];
            }

            return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data,
            ]);
        }
        return view('official.application-list');
    }

    /**
     * Display the list of submitted applications.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function applicationList()
    {
        // Fetch the list of applications from the database
        $applications = []; // Replace with actual data fetching logic

        return view('beneficiary.application-list', compact('applications'));
    }
    /**
     * Show the details of a specific application.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $previousMenuUrl = url()->previous();
        $previousMenuLabel = 'Application List';

        $beneficiary = config('customredirects.user_types.beneficiary');
        $official = config('customredirects.user_types.official_user');
        $user = Auth::user();
        $id = Crypt::decrypt($id);

        $application = Application::with('countryRelation')->findOrFail($id);

        $edit_enable = 1;
        if ($application->application_status != 1) {
            $edit_enable = 0;
        }

        if (!$application) {
            return redirect()->route('application.index')->with('error', 'Application not found.');
        }

        return view('beneficiary.application-details', compact('application', 'edit_enable', 'previousMenuLabel', 'previousMenuUrl','user','beneficiary','official'));
    
    }
    public function applicationProcess(Request $request, $id): RedirectResponse
    {
        $user = Auth::user();

        $id = Crypt::decrypt($id);
        $remarks = $request->input('remarks', '');

        $data = ['remarks' => ['required', 'string', 'max:1000', new AlphaSpaceNumChar]];
        // Validate only the remarks field
        $validatedData = $request->validate([
            'remarks' => ['required', 'string', 'max:1000', new AlphaSpaceNumChar],
        ], [
            'remarks.required' => 'The remarks field is required.',
            'remarks.string' => 'The remarks must be a valid string.',
            'remarks.max' => 'The remarks may not be greater than 1000 characters.',
        ]);

        // Handle the action (approve or reject)
        if ($request->input('action') === 'approve') {
            $status = 2;
        } elseif ($request->input('action') === 'reject') {
            $status = 3;
        }

        // Fetch the application
        $application = Application::findOrFail($id);
        $application_data=[
            'application_no' => $application->application_no,
            'deceased_person_name' => $application->deceased_person_name,
            'application_status' => $status,
            'date'=>date('d-m-Y')
            
        ];
        $email=$user->email;
        // Update the application with the validated remarks
        $application->remarks = $validatedData['remarks'];
        $application->processed_by = $user->id;
        $application->processed_date = date('Y-m-d H:i:s');
        $application->application_status = $status;
        $application->save();

        Mail::to($email)->send(new ApplicationProcessingEmail($application_data));


        $message = $application->application_status === 2
            ? 'Application approved successfully.'
            : 'Application rejected successfully.';
        return redirect()->route('application.index')->with('success', $message);
    }

    public function processedApplications()
    {

        $user = Auth::user();
        $beneficiary = config('customredirects.user_types.beneficiary');
        $offcial = config('customredirects.user_types.official_user');

        // Check if the request is an AJAX request
        if (request()->ajax()) {
            $columns = [
                0 => 'id',
                1 => 'application_no',
                2 => 'deceased_person_name',
                3 => 'passport_no',
                4 => 'death_date',
                5 => 'country',
                6 => 'created_at',
            ];

            //fetch applications which are processed
            $totalData = Application::where('application_status', '=', 2)->count();
            $totalFiltered = $totalData;

            $limit = request()->input('length');
            $start = request()->input('start');
            $order = $columns[request()->input('order.0.column') ?? 0] ?? 'id';
            $dir = request()->input('order.0.dir') ?? 'desc';

            $query = Application::with('countryRelation')->where('application_status', '=', 2);

            // Search filter
            if (!empty(request()->input('search.value'))) {
                $search = request()->input('search.value');
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



            $routeName = 'application.show';
            $data = [];
            foreach ($applications as $app) {
                $id = encrypt($app->id);
                $url = URL::signedRoute('application.show', ['app_id' => $id]);
                $download_url = route('application.generate-application-pdf', ['app_id' =>  $id]);

                // Prepare actions
                $actions = '<div class="d-flex gap-2">'; // Flex container with small gap between buttons
                $actions .= '<a class="btn btn-primary view_but" href="' . $url . '" target="_blank">
                <div class="preview-icon-wrap"> View</div>
             </a>';

                // Add download button with modal trigger only for approved applications
                if ($app->application_status == 2) {
                    $actions .= '<a href="' . $download_url . '" class="btn btn-success document-modal-control popup" data-download="">
                        <div class="preview-icon-wrap"><i class="ti ti-file-download"></i></div>
                     </a>';
                }

                $actions .= '</div>';
                $data[] = [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'processed_date' => \Carbon\Carbon::parse($app->processed_date)->format('d-m-Y'),
                    'country' => $app->countryRelation->country_name ?? '',
                    // 'status' => $app->application_status == 2
                    //     ? '<span class="badge bg-success">Approved</span>'
                    //     : ($app->application_status == 3
                    //         ? '<span class="badge bg-danger">Rejected</span>'
                    //         : '<span class="badge bg-warning text-dark">Pending</span>'),
                    'created_at' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
                    'actions' => $actions,
                ];
            }

            return response()->json([
                "draw" => intval(request()->input('draw')),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data,
            ]);
        }
        return view('official.processed-applications', compact('user', 'beneficiary', 'offcial'));
    }
    public function generateApplicationPdf(Request $request, $id)
    {

        try {
            $application_id = decrypt($id);
        } catch (DecryptException $e) {
            abort(400, 'Invalid request.');
        }

        \App\Helpers\FileHelper::generateApplicationPDF($application_id);
    }
    public function rejectedApplications()
    {
        $user = Auth::user();
        $beneficiary = config('customredirects.user_types.beneficiary');
        $offcial = config('customredirects.user_types.official_user');

        // Check if the request is an AJAX request
        if (request()->ajax()) {
            $columns = [
                0 => 'id',
                1 => 'application_no',
                2 => 'deceased_person_name',
                3 => 'passport_no',
                4 => 'death_date',
                5 => 'country',
                6 => 'created_at',

            ];

            //fetch applications which are processed
            $totalData = Application::where('application_status', '=', 3)->count();
            $totalFiltered = $totalData;

            $limit = request()->input('length');
            $start = request()->input('start');
            $order = $columns[request()->input('order.0.column') ?? 0] ?? 'id';
            $dir = request()->input('order.0.dir') ?? 'desc';

            $query = Application::with('countryRelation')->where('application_status', '=', 3);

            // Search filter
            if (!empty(request()->input('search.value'))) {
                $search = request()->input('search.value');
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



            $routeName = 'application.show';
            $data = [];
            foreach ($applications as $app) {
                $id = encrypt($app->id);
                $url = URL::signedRoute('application.show', ['app_id' => $id]);
                $download_url = route('application.generate-application-pdf', ['app_id' =>  $id]);

                // Prepare actions
                $actions = '<div class="d-flex gap-2">'; // Flex container with small gap between buttons
                $actions .= '<a class="btn btn-primary view_but" href="' . $url . '" target="_blank">
                <div class="preview-icon-wrap"> View</div>
             </a>';

                // Add download button with modal trigger only for approved applications
                if ($app->application_status == 2) {
                    $actions .= '<a href="' . $download_url . '" class="btn btn-success document-modal-control popup" data-download="">
                        <div class="preview-icon-wrap"><i class="ti ti-file-download"></i></div>
                     </a>';
                }

                $actions .= '</div>';
                $data[] = [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'processed_date' => \Carbon\Carbon::parse($app->processed_date)->format('d-m-Y'),
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $app->application_status == 2
                        ? '<span class="badge bg-success">Approved</span>'
                        : ($app->application_status == 3
                            ? '<span class="badge bg-danger">Rejected</span>'
                            : '<span class="badge bg-warning text-dark">Pending</span>'),
                    'created_at' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
                    'actions' => $actions,
                ];
            }

            return response()->json([
                "draw" => intval(request()->input('draw')),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data,
            ]);
        }
        return view('official.rejected-applications', compact('user', 'beneficiary', 'offcial'));
    }
}
