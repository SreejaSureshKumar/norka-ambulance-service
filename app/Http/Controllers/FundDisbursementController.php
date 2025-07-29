<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceApplication;
use App\Models\ApplicationBatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use App\Rules\AlphaSpaceNumChar;
use App\Models\UserComponent;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationProcessingEmail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Batch;

class FundDisbursementController extends Controller
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
        $beneficiary = config('customredirects.user_types.beneficiary');
        $offcial = config('customredirects.user_types.official_user');

        if ($request->ajax()) {
            $columns = [
                0 => 'id',
                1 => 'application_no',
                2 => 'deceased_person_name',
                3 => 'passport_no',
                4 => 'country',
                5 => 'state',

                6 => 'created_at',
                7 => 'approved_date'
            ];

            //fetch applications whic are submittedand pending for approval
            $totalData = ServiceApplication::count();
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

            $query = ServiceApplication::with('countryRelation', 'stateRelation');
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

                $data[] = [
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'state' => $app->stateRelation->state_name,
                    'country' => $app->countryRelation->country_name ?? '',
                    'approved_date' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
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
        return view('accounts.approved-application-list');
    }

    public function createBatch(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'application_ids' => 'required|array|min:1',
            'application_ids.*' => 'integer|exists:ambulance_service_details,id'
        ]);

        DB::beginTransaction();
        try {
           
            $latestBatch = \App\Models\ApplicationBatch::orderBy('id', 'desc')->first();
            $nextSerial = $latestBatch ? ($latestBatch->serial_number + 1) : 1;
            $year = date('Y');
            $batchNo = 'batch/' . str_pad($nextSerial, 2, '0', STR_PAD_LEFT) . '/' . $year;

           
            $batch = \App\Models\ApplicationBatch::create([
                'batch_no' => $batchNo,
                'serial_number' => $nextSerial,
                'total_applications' => count($request->application_ids),
                'created_by' => $user->id
            ]);

          
            ServiceApplication::whereIn('id', $request->application_ids)
                ->where('application_status', 4)
                ->where('batch_id', 0)
                ->update(['batch_id' => $batch->id]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Batch created successfully.',
                'batch_id' => $batch->id,
                'batch_no' => $batchNo
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create batch.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
