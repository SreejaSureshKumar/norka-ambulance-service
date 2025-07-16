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
    public function index(Request $request): View|\Illuminate\Http\JsonResponse
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
            $totalData = ServiceApplication::where('application_status', 2)->count();
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


            $query = ServiceApplication::with('countryRelation', 'stateRelation', 'driverDetails','agencyUser')->where('application_status', 2)
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
                if (!$app->driverDetails) {
                    $actions .= '<a href="#" class="btn btn-primary add-details-modal" data-id="' . $app->id . '" data-number="' . $app->application_no . '">Add Details</a>';
                } else {
                    $actions .= '<span class="badge bg-success align-self-center">Driver Details Added</span>';
                }
                $actions .= '</div>';
                $data[] = [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'state' => $app->stateRelation->state_name,
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $app->application_status == 2 ? 'Approved' : ($app->application_status == 3 ? 'Rejected' : 'Pending'),
                    'created_at' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
                    'service_date'=> $app->arriving_date_time ? \Carbon\Carbon::parse($app->arriving_date_time)->format('d-m-Y') : '',
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
}
