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
use App\Models\Country;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;


class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
     
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

            $totalData = Application::where('created_by', $user->id)->count();
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column') ?? 0] ?? 'id';
            $dir = $request->input('order.0.dir') ?? 'desc';

            $query = Application::with('countryRelation')->where('created_by', $user->id);

            // Search filter
            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');
                $query->where(function($q) use ($search) {
                    $q->where('deceased_person_name', 'LIKE', "%{$search}%")
                      ->orWhere('passport_no', 'LIKE', "%{$search}%");
                });
                $totalFiltered = $query->count();
            }

            $applications = $query->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $data = [];
            foreach ($applications as $app) {
                $data[] = [
                    'id' => $app->id,
                    'deceased_person_name' => $app->deceased_person_name,
                    'passport_no' => $app->passport_no,
                    'death_date' => \Carbon\Carbon::parse($app->death_date)->format('d-m-Y'),
                    'country' => $app->countryRelation->country_name ?? '',
                    'status' => $app->status ?? 'Pending',
                    'created_at' => $app->created_at ? $app->created_at->format('d-m-Y') : '',
                    'actions' => '<a class="btn btn-primary view_but" href="' . route('beneficiary.application.show', encrypt($app->id) ). '" target="_blank">
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

        return view('beneficiary.application-list');
    }

    public function applicationForm(Request $request): View
    {
        $countries=Country::all()->where('active', 'Y');
        return view('beneficiary.submit-application', compact('countries'));
    }

    /**
     * Store a newly created death departure application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitApplication(Request $request): RedirectResponse
    {
        $iso_code = strtoupper($request->mobile_country_iso_code);
        $validated = $request->validate([
            'deceased_person_name' => ['required', 'string', 'max:255', new AlphaSpaceNumChar],
            'passport_no' => ['required',  new Passport],
            'death_date' => ['required', 'date'],
            'cause_of_death' => ['required', 'string', 'max:255', new AlphaSpaceNumChar],
            'country' => ['required', 'string', 'max:255', new AlphaSpaceNumChar],
            'sponsor_details' => ['required', 'string', 'max:1000', new AlphaSpaceNumChar],
            'contact_abroad_name' => ['required', 'string', 'max:255', new AlphaSpaceNumChar],
            'contact_abroad_phone' => ['required', new PhoneNumber($iso_code), 'max:25'],
            'contact_kerala_name' => ['required', 'string', 'max:255', new AlphaSpaceNumChar],
            'contact_kerala_phone' => ['required', new PhoneNumber('IN'), 'max:25'],
            'airport_from' => ['required', 'string', 'max:255', new AlphaSpaceNumChar],
            'airport_to' => ['required', 'string', 'max:255', new AlphaSpaceNumChar],
            'native_address' => ['required', 'string', 'max:1000', new AlphaSpaceNumChar],
            'cargo_norka_status' => ['nullable', 'numeric', 'in:0,1'],
        ], [//custom   messages
            ], [

            'deceased_person_name' => 'Deceased person name',
            'passport_no' => 'Passport number',
            'death_date' => 'Death date',
            'cause_of_death' => 'Cause of death',
            'country' => 'Country',
            'sponsor_details' => 'Sponsor details',
            'contact_abroad_name' => 'Contact Person Abroad (name)',
            'contact_abroad_phone' => 'Contact Number',
            'contact_kerala_name' => 'Contact in Kerala (name)',
            'contact_kerala_phone' => 'Contact in Kerala (phone)',
            'airport_from' => 'Departure airport',
            'airport_to' => 'Arrival airport',
            'native_address' => 'Native address',
            'cargo_norka_status' => 'NORKA cargo status',
        ]);

        // Merge validated input with extra columns
        $data = array_merge($validated, [
            'application_status' => 1,
        
            'created_by' => Auth::id(),
        ]);

        Application::create($data);

        return redirect()->route('beneficiary.index')->with('status', 'Application submitted successfully!');
    }
   
   public function show($id): View
    {
        $beneficiary = config('customredirects.user_types.beneficiary');
        $offcial = config('customredirects.user_types.official_user');

        $user = Auth::user();

        //enale user to verify /approve the application
        $edit_enable=0;
        $id= Crypt::decrypt($id);
        $application = Application::with('countryRelation')->findOrFail($id);
        return view('beneficiary.application-details', compact('application', 'edit_enable'))
        ->with('user', $user)
        ->with('beneficiary', $beneficiary)
        ->with('offcial', $offcial);
        
    }
}
