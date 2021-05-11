<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\League;
use App\Repositories\ClubRepository;
use App\Repositories\LeagueRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeagueController extends Controller
{
    private $path = '/assets/images/leagues';
    private $leagueRepository;
    private $clubRepository;

    public function __construct(LeagueRepository $leagueRepository, ClubRepository $clubRepository)
    {
        $this->leagueRepository = $leagueRepository;
        $this->clubRepository = $clubRepository;
    }

    public function index($countryId = null) {
        $country = Country::find($countryId);
        if ($countryId) {
            $leagues = League::where('country_id', $countryId)->orderBy('league_level')->paginate(5);
        } else {
            $leagues = League::orderBy('league_level')->orderBy('country_id')->paginate(10);
        }
        $countries = Country::orderBy('name')->get();
        return view('leagues.index', [
            'country' => $country,
            'leagues' => $leagues,
            'countries' => $countries,
            'totalClubs' => $this->leagueRepository->getTotalClubs(),
            'totalPlayers' => $this->leagueRepository->getTotalPlayers(),
            'avgAge' => $this->leagueRepository->getAvgAge(),
            'foreigners' => $this->leagueRepository->getForeigners(),
            'totalMarketValue' => $this->leagueRepository->getTotalMarketValue(),
            'avgMarketValue' => $this->leagueRepository->getAvgMarketValue()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50',
                Rule::unique('leagues', 'name')
                    ->where('country_id', $request->input('country_id'))],
            'league_level' => ['required', 'min:3', 'max:50',
                Rule::unique('leagues', 'league_level')
                    ->where('country_id', $request->input('country_id'))],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'logo' => ['required', 'file', 'mimes:svg,png,jpg,jpeg,bmp,webp']
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
            $league->saveOrFail();
        }
        return back()->withMessage('The league was added successfully');
    }

    public function show($id) {
        $league = League::find($id);
        $clubs = Club::where('league_id', $id)->get();
        return view('leagues.show', [
            'league' => $league,
            'clubs' => $clubs,
            'totalClubs' => $this->leagueRepository->getTotalClubs(),
            'totalPlayers' => $this->leagueRepository->getTotalPlayers(),
            'avgAge' => $this->leagueRepository->getAvgAge(),
            'foreigners' => $this->leagueRepository->getForeigners(),
            'totalMarketValue' => $this->leagueRepository->getTotalMarketValue(),
            'avgMarketValue' => $this->leagueRepository->getAvgMarketValue(),
            'recordHoldingChampions' => $this->leagueRepository->getRecordHoldingChampions($league->id),
            'reigningChampion' => $this->leagueRepository->getReigningChampion($league->id),
            'mostValuablePlayer' => $this->leagueRepository->getMostValuablePlayer($league->id),
            'totalClubsPlayers' => $this->clubRepository->getTotalPlayers(),
            'totalClubsAvgAge' => $this->clubRepository->getAvgAge(),
            'totalClubsForeigners' => $this->clubRepository->getForeigners(),
            'totalClubsMarketValue' => $this->clubRepository->getTotalMarketValue(),
            'avgClubsMarketValue' => $this->clubRepository->getAvgMarketValue()
        ]);
    }

    public function edit($id) {
        $league = League::find($id);
        $countries = Country::orderBy('name')->get();
        return view('leagues.edit', [
            'league' => $league,
            'countries' => $countries
        ]);
    }

    public function update($id, Request $request) {
        $league = League::find($id);
        $request->validate([
            'name' => ['required', 'min:3', 'max:50',
                Rule::unique('leagues', 'name')
                    ->where('country_id', $request->input('country_id'))->ignore($league->id)],
            'league_level' => ['required', 'min:3', 'max:50',
                Rule::unique('leagues', 'league_level')
                    ->where('country_id', $request->input('country_id'))->ignore($league->id)],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'logo' => ['file', 'mimes:svg,png,jpg,jpeg,bmp,webp']
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
        $league->name = $name;
        $league->league_level = $request->input('league_level');
        $league->country_id = $request->input('country_id');
        $league->saveOrFail();
        return back()->withMessage('The league was updated successfully');
    }
}
