<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeagueController extends Controller
{
    private $path = '/assets/images/leagues';

    public function index($countryId = null) {
        $country = Country::find($countryId);
        if ($countryId) {
            $leagues = League::where('country_id', $countryId)->get();
        } else {
            $leagues = League::all();
        }
        $countries = Country::all();
        $clubs = Club::all();
        return view('leagues.index', [
            'country' => $country,
            'leagues' => $leagues,
            'countries' => $countries,
            'clubs' => $clubs
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', Rule::unique('leagues', 'name')->where('country_id', $request->input('country_id')), 'min:3', 'max:50'],
            'league_level' => ['required', Rule::unique('leagues', 'league_level')->where('country_id', $request->input('country_id')), 'max:25'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'logo' => ['required', 'file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'record_holding_champion_id' => [Rule::exists('clubs', 'id')],
            'record_holding_times' => ['nullable', 'min:1', 'max:100',],
            'reigning_champion_id' => [Rule::exists('clubs', 'id')],
            'uefa_position' => ['nullable', 'min:1', 'max:255'],
            'uefa_coefficient_points' => ['nullable', 'min:0.000', 'max:99.999']
        ]);
        $name = $request->input('name');
        $country = Country::find($request->input('country_id'));
        $logo = $request->file('logo');
        if ($logo->isValid()) {
            $extension = $logo->extension();
            $path = $logo->storeAs($this->path, strtolower($country->code . '-' . str_replace(' ', '-', $name)) . '.' . $extension);
            $league = new League();
            $league->name = $name;
            $league->league_level = $request->input('league_level');
            $league->country_id = $request->input('country_id');
            $league->logo = $path;
            if ($request->input('record_holding_champion_id')) {
                $league->record_holding_champion_id = $request->input('record_holding_champion_id');
            }
            $league->record_holding_times = $request->input('record_holding_times');
            if ($request->input('reigning_champion_id')) {
                $league->reigning_champion_id = $request->input('reigning_champion_id');
            }
            $league->uefa_position = $request->input('uefa_position');
            $league->uefa_coefficient_points = $request->input('uefa_coefficient_points');
            $league->saveOrFail();
        }
        return back()->withMessage('The league was added successfully');
    }

    public function show($id) {
        $league = League::find($id);
        $clubs = Club::where('league_id', $id)->get();
        return view('leagues.show', [
            'league' => $league,
            'clubs' => $clubs
        ]);
    }

    public function edit($id) {
        $league = League::find($id);
        $countries = Country::all();
        $clubs = Club::all();
        return view('leagues.edit', [
            'league' => $league,
            'countries' => $countries,
            'clubs' => $clubs
        ]);
    }

    public function update($id, Request $request) {
        $league = League::find($id);
        $request->validate([
            'name' => ['required', Rule::unique('leagues', 'name')->where('country_id', $request->input('country_id'))->ignore($league->id), 'min:3', 'max:50'],
            'league_level' => ['required', Rule::unique('leagues', 'league_level')->where('country_id', $request->input('country_id'))->ignore($league->id), 'max:25'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'logo' => ['file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'record_holding_champion_id' => [Rule::exists('clubs', 'id')],
            'record_holding_times' => ['nullable', 'min:1', 'max:100',],
            'reigning_champion_id' => [Rule::exists('clubs', 'id')],
            'uefa_position' => ['nullable', 'min:1', 'max:255'],
            'uefa_coefficient_points' => ['nullable', 'min:0.000', 'max:99.999']
        ]);
        $name = $request->input('name');
        $country = Country::find($request->input('country_id'));
        if ($request->file('logo')) {
            $logo = $request->file('logo');
            if ($logo->isValid()) {
                $extension = $logo->extension();
                $path = $logo->storeAs($this->path, strtolower($country->code . '-' . str_replace(' ', '-', $name)) . '.' . $extension);
                $league->logo = $path;
            }
        }
        if ($request->input('record_holding_champion_id')) {
            $league->record_holding_champion_id = $request->input('record_holding_champion_id');
        }
        $league->record_holding_times = $request->input('record_holding_times');
        if ($request->input('reigning_champion_id')) {
            $league->reigning_champion_id = $request->input('reigning_champion_id');
        }
        $league->name = $name;
        $league->league_level = $request->input('league_level');
        $league->country_id = $request->input('country_id');
        $league->uefa_position = $request->input('uefa_position');
        $league->uefa_coefficient_points = $request->input('uefa_coefficient_points');
        $league->saveOrFail();
        return back()->withMessage('The league was updated successfully');
    }
}
