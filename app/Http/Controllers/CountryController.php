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
        $uefaCountries = Country::where('uefa_position', '!=', null)->orderBy('uefa_position')->get();
        $otherCountries = Country::where('uefa_position', null)->orderBy('name')->get();
        $leagues = League::all();
        return view('countries.index', [
            'uefaCountries' => $uefaCountries,
            'otherCountries' => $otherCountries,
            'leagues' => $leagues,
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
            'name' => ['required', 'unique:countries', 'min:3', 'max:30'],
            'code' => ['required', 'unique:countries', 'min:2', 'max:6'],
            'flag' => ['required', 'file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'uefa_position' => ['numeric', 'nullable', 'min:1', 'max:255'],
            'uefa_coefficient_points' => ['numeric', 'nullable', 'min:0.000', 'max:150.000']
        ]);
        $code = $request->input('code');
        $flag = $request->file('flag');
        if ($flag->isValid()) {
            $extension = $flag->extension();
            $path = $flag->storeAs($this->path, strtolower($code) . '.' . $extension);
            $country = new Country();
            $country->name = $request->input('name');
            $country->code = $code;
            $country->flag = $path;
            if ($request->input('uefa_position')) {
                $country->uefa_position = $request->input('uefa_position');
            }
            if ($request->input('uefa_coefficient_points')) {
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
            'name' => ['required', Rule::unique('countries', 'name')->ignore($country->id), 'min:3', 'max:30'],
            'code' => ['required', Rule::unique('countries', 'code')->ignore($country->id), 'min:2', 'max:6'],
            'flag' => ['file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'first_tier_league_id' => [Rule::unique('countries', 'first_tier_league_id')->ignore($country->id)],
            'uefa_position' => ['numeric', 'nullable', 'min:1', 'max:255'],
            'uefa_coefficient_points' => ['numeric', 'nullable', 'min:0.000', 'max:150.000']
        ]);
        $country->name = $request->input('name');
        $country->code = $request->input('code');
        if ($request->file('flag')) {
            $flag = $request->file('flag');
            if ($flag->isValid()) {
                $extension = $flag->extension();
                $path = $flag->storeAs($this->path, strtolower($request->input('code')) . '.' . $extension);
                $country->flag = $path;
            }
        }
        if ($request->input('first_tier_league_id')) {
            $country->first_tier_league_id = $request->input('first_tier_league_id');
        }
        $country->uefa_position = $request->input('uefa_position');
        $country->uefa_coefficient_points = $request->input('uefa_coefficient_points');
        $country->saveOrFail();
        return back()->withMessage('The country was updated successfully');
    }
}
