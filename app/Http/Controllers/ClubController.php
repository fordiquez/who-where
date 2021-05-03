<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\League;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class ClubController extends Controller
{
    private $path = '/assets/images/clubs';

    public function index($leagueId = null) {
        $league = League::find($leagueId);
        if ($leagueId) {
            $clubs = Club::where('league_id', $leagueId)->get();
        } else {
            $clubs = Club::all();
        }
        $countries = Country::all();
        $leagues = League::all();
        return view('clubs.index', [
            'league' => $league,
            'clubs' => $clubs,
            'countries' => $countries,
            'leagues' => $leagues
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', Rule::unique('clubs', 'name'), 'min:3', 'max:50'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'league_id' => ['required', Rule::exists('leagues', 'id')],
            'logo' => ['required', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'founded' => ['required', 'integer', 'min:1857'],
            'stadium' => ['required', 'min:1', 'max:100'],
            'address' => ['required', 'min:1', 'max:100'],
            'city' => ['required', 'min:1', 'max:50',],
            'capacity' => ['required', 'integer', 'min:1', 'max:110000'],
            'head_coach' => ['required', 'min:1', 'max:50']
        ]);
        $name = $request->input('name');
        $logo = $request->file('logo');
        if ($logo->isValid()) {
            $extension = $logo->extension();
            $path = $logo->storeAs($this->path, strtolower(str_replace(' ', '-', $name)) . '.' . $extension);
            $club = new Club();
            $club->name = $name;
            $club->country_id = $request->input('country_id');
            $club->league_id = $request->input('league_id');
            $club->logo = $path;
            $club->founded = $request->input('founded');
            $club->stadium = $request->input('stadium');
            $club->address = $request->input('address');
            $club->city = $request->input('city');
            $club->capacity = $request->input('capacity');
            $club->head_coach = $request->input('head_coach');
            $club->saveOrFail();
        }
        return back()->withMessage('The club was added successfully');
    }

    public function show($id) {
        $club = Club::find($id);
        $players = Player::where('club_id', $club->id)->get();
        return view('clubs.show', [
            'club' => $club,
            'players' => $players
        ]);
    }

    public function edit($id) {
        $club = Club::find($id);
        $countries = Country::all();
        $leagues = League::all();
        return view('clubs.edit', [
            'club' => $club,
            'countries' => $countries,
            'leagues' => $leagues
        ]);
    }

    public function update($id, Request $request) {
        $club = Club::find($id);
        $request->validate([
            'name' => ['required', Rule::unique('clubs', 'name')->ignore($club->id), 'min:3', 'max:50'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'league_id' => ['required', Rule::exists('leagues', 'id')],
            'logo' => ['mimes:svg,png,jpg,jpeg,bmp,webp'],
            'founded' => ['required', 'integer', 'min:1857'],
            'stadium' => ['required', 'min:1', 'max:100'],
            'address' => ['required', 'min:1', 'max:100'],
            'city' => ['required', 'min:1', 'max:50',],
            'capacity' => ['required', 'integer', 'min:1', 'max:110000'],
            'head_coach' => ['required', 'min:1', 'max:50']
        ]);
        $name = $request->input('name');
        if ($request->file('logo')) {
            $logo = $request->file('logo');
            if ($logo->isValid()) {
                $extension = $logo->extension();
                $path = $logo->storeAs($this->path, strtolower(str_replace(' ', '-', $name)) . '.' . $extension);
                $club->logo = $path;
            }
        }
        $club->name = $name;
        $club->country_id = $request->input('country_id');
        $club->league_id = $request->input('league_id');
        $club->founded = $request->input('founded');
        $club->stadium = $request->input('stadium');
        $club->address = $request->input('address');
        $club->city = $request->input('city');
        $club->capacity = $request->input('capacity');
        $club->head_coach = $request->input('head_coach');
        $club->save();
        return back()->withMessage('The club was updated successfully');
    }
}
