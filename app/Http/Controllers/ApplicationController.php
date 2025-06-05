<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;


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
                1 => 'deceased_person_name',
                2 => 'passport_no',
                3 => 'death_date',
                4 => 'country',
                5 => 'status',
                6 => 'created_at',
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
                $id=encrypt($app->id);
                $url = URL::signedRoute('application.show', ['application' => $id]);
       
                $data[] = [
                    'id' => $app->id,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'death_date' => \Carbon\Carbon::parse($app->death_date)->format('d-m-Y'),
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $app->status ?? 'Pending',
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
        
        $beneficiary = config('customredirects.user_types.beneficiary');
        $offcial = config('customredirects.user_types.official_user');

        $user = Auth::user();

        //enale user to verify /approve the application
        $edit_enable=1;
       
             $id= Crypt::decrypt($id);
            
             $application = []; 
             $application = Application::with('countryRelation')->findOrFail($id);
        // Fetch the application details from the database using the provided ID
      
        if (!$application) {
            return redirect()->route('application.index')->with('error', 'Application not found.');
        }

        return view('beneficiary.application-details', compact('application', 'edit_enable'))
            ->with('user', $user)
            ->with('beneficiary', $beneficiary)
            ->with('offcial', $offcial);
      
    }
}
