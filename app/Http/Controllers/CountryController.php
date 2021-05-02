<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class CountryController extends Controller
{
    private $path = '/assets/images/countries';

    public function index() {
        $countries = Country::all();
        $leagues = League::all();
        return view('countries.index', [
            'countries' => $countries,
            'leagues' => $leagues
        ]);
    }

    public function show($id) {
        $country = Country::find($id);
        $leagues = League::all();
        return view('countries.show', [
            'country' => $country,
            'leagues' => $leagues
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'unique:countries', 'min:3', 'max:50'],
            'code' => ['required', 'unique:countries', 'min:2', 'max:6'],
            'flag' => ['required', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
        ]);
        $name = $request->input('name');
        $code = $request->input('code');
        $flag = $request->file('flag');
        if ($flag->isValid()) {
            $extension = $flag->extension();
            $path = $flag->storeAs($this->path, strtolower($code) . '.' . $extension);
            $country = new Country();
            $country->name = $name;
            $country->code = $code;
            $country->flag = $path;
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
            'name' => ['required', Rule::unique('countries', 'name')->ignore($country->id), 'min:3', 'max:50'],
            'code' => ['required', Rule::unique('countries', 'code')->ignore($country->id), 'min:2', 'max:6'],
            'flag' => ['mimes:svg,png,jpg,jpeg,bmp,webp'],
            'first_tier_league_id' => [Rule::unique('countries', 'first_tier_league_id')->ignore($country->id)]
        ]);
        $country->name = $request->input('name');
        $country->code = $request->input('code');
        if ($request->input('first_tier_league_id')) {
            $country->first_tier_league_id = $request->input('first_tier_league_id');
        }
        if ($request->file('flag')) {
            $flag = $request->file('flag');
            if ($flag->isValid()) {
                $extension = $flag->extension();
                $path = $flag->storeAs($this->path, strtolower($request->input('code')) . '.' . $extension);
                $country->flag = $path;
            }
        }
        $country->saveOrFail();
        return back()->withMessage('The country was updated successfully');
    }
}
