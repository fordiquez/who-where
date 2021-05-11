<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\League;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    private $path = '/assets/images/countries';
    private $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index() {
        $countries = Country::orderBy('is_european_country', 'desc')->orderBy('uefa_position')->orderBy('name')->paginate(10);
        return view('countries.index', [
            'countries' => $countries,
            'totalLeagues' => $this->countryRepository->getTotalLeagues(),
            'totalClubs' => $this->countryRepository->getTotalClubs(),
            'totalPlayers' => $this->countryRepository->getTotalPlayers()
        ]);
    }

    public function show($id) {
        $country = Country::find($id);
        return view('countries.show', [
            'country' => $country,
            'totalLeagues' => $this->countryRepository->getTotalLeagues(),
            'totalClubs' => $this->countryRepository->getTotalClubs(),
            'totalPlayers' => $this->countryRepository->getTotalPlayers()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30', Rule::unique('countries', 'name')],
            'code' => ['required', 'min:2', 'max:6', Rule::unique('countries', 'code')],
            'flag' => ['required', 'file', 'mimes:svg'],
            'is_european_country' => ['required', 'prohibited_unless:is_european_country,1,0'],
            'uefa_position' => ['numeric', 'nullable', 'min:1', 'max:55',
                Rule::requiredIf($request->input('is_european_country')),
                Rule::requiredIf($request->input('uefa_coefficient_points')),
                Rule::unique('countries', 'uefa_position')],
            'uefa_coefficient_points' => ['numeric', 'nullable', 'min:0.000', 'max:150.000',
                Rule::requiredIf($request->input('is_european_country')),
                Rule::requiredIf($request->input('uefa_position'))]
        ]);
        $code = $request->input('code');
        $flag = $request->file('flag');
        if ($flag->isValid()) {
            $extension = $flag->extension();
            $path = $flag->storeAs($this->path, strtolower($code) . '.' . $extension);
            $country = new Country();
            $country->name = $request->input('name');
            $country->code = strtoupper($code);
            $country->flag = $path;
            $country->is_european_country = $request->input('is_european_country');
            if ($request->input('is_european_country') == 1) {
                $country->uefa_position = $request->input('uefa_position');
                $country->uefa_coefficient_points = $request->input('uefa_coefficient_points');
            }
            $country->saveOrFail();
        }
        return back()->withMessage('The country was added successfully');
    }

    public function edit($id) {
        $country = Country::find($id);
        $leagues = League::where('country_id', $id)->get();
        return view('countries.edit', [
            'country' => $country,
            'leagues' => $leagues
        ]);
    }

    public function update($id, Request $request) {
        $country = Country::find($id);
        $request->validate([
            'name' => ['required', 'min:3', 'max:30',
                Rule::unique('countries', 'name')->ignore($country->id)],
            'code' => ['required', 'min:2', 'max:6',
                Rule::unique('countries', 'code')->ignore($country->id)],
            'flag' => ['file', 'mimes:svg'],
            'is_european_country' => ['required', 'prohibited_unless:is_european_country,1,0'],
            'first_tier_league_id' => [Rule::exists('leagues', 'id'),
                Rule::unique('countries', 'first_tier_league_id')->ignore($country->id)],
            'uefa_position' => ['numeric', 'nullable', 'min:1', 'max:55',
                Rule::requiredIf($request->input('is_european_country')),
                Rule::requiredIf($request->input('uefa_coefficient_points')),
                Rule::unique('countries', 'uefa_position')->ignore($country->id)],
            'uefa_coefficient_points' => ['numeric', 'nullable', 'min:0.000', 'max:150.000',
                Rule::requiredIf($request->input('is_european_country')),
                Rule::requiredIf($request->input('uefa_position'))]
        ]);
        $country->name = $request->input('name');
        $code = $request->input('code');
        $country->code = strtoupper($code);
        if ($request->file('flag')) {
            $flag = $request->file('flag');
            if ($flag->isValid()) {
                $extension = $flag->extension();
                $path = $flag->storeAs($this->path, strtolower($code) . '.' . $extension);
                $country->flag = $path;
            }
        }
        if ($request->input('first_tier_league_id')) {
            $country->first_tier_league_id = $request->input('first_tier_league_id');
        }
        $country->is_european_country = $request->input('is_european_country');
        if ($request->input('is_european_country') == 1) {
            $country->uefa_position = $request->input('uefa_position');
            $country->uefa_coefficient_points = $request->input('uefa_coefficient_points');
        } else {
            $country->uefa_position = null;
            $country->uefa_coefficient_points = null;
        }
        $country->saveOrFail();
        return back()->withMessage('The country was updated successfully');
    }
}
