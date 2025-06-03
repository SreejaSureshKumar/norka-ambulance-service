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

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(): View
    {
        $applications = Application::latest()->get();
   
        return view('beneficiary.application-list', compact('applications'));
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

        Application::create($validated);

        return redirect()->route('beneficiary.index')->with('status', 'Application submitted successfully!');
    }
   
}
