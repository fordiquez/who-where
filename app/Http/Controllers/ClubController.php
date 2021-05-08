<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Club;
use App\Models\Country;
use App\Models\League;
use App\Models\Player;
use App\Models\Season;
use App\Repositories\ClubRepository;
use App\Repositories\PlayerRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClubController extends Controller
{
    private $path = '/assets/images/clubs';
    private $clubRepository;
    private $playerRepository;

    public function __construct(ClubRepository $clubRepository, PlayerRepository $playerRepository)
    {
        $this->clubRepository = $clubRepository;
        $this->playerRepository = $playerRepository;
    }

    public function index($leagueId = null) {
        $league = League::find($leagueId);
        if ($leagueId) {
            $clubs = Club::where('league_id', $leagueId)->get();
        } else {
            $clubs = Club::orderBy('league_id')->get();
        }
        $countries = Country::all();
        $leagues = League::all();
        $seasons = Season::orderByDesc('year')->get();
        return view('clubs.index', [
            'league' => $league,
            'clubs' => $clubs,
            'countries' => $countries,
            'leagues' => $leagues,
            'seasons' => $seasons,
            'totalPlayers' => $this->clubRepository->getTotalPlayers(),
            'avgAge' => $this->clubRepository->getAvgAge(),
            'foreigners' => $this->clubRepository->getForeigners(),
            'totalMarketValue' => $this->clubRepository->getTotalMarketValue(),
            'avgMarketValue' => $this->clubRepository->getAvgMarketValue()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', Rule::unique('clubs', 'name'), 'min:3', 'max:50'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'league_id' => ['required', Rule::exists('leagues', 'id')],
            'logo' => ['required', 'file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'founded' => ['required', 'integer', 'min:1857'],
            'stadium' => ['required', 'min:1', 'max:50'],
            'address' => ['required', 'min:1', 'max:50'],
            'city' => ['required', 'min:1', 'max:50',],
            'capacity' => ['required', 'integer', 'min:0', 'max:110000'],
            'head_coach' => ['required', 'min:1', 'max:50'],
            'championships_number' => ['numeric', 'nullable', 'min:0', 'max:255',
                Rule::requiredIf($request->input('last_championship_season_id'))],
            'last_championship_season_id' => [Rule::exists('seasons', 'id'),
                Rule::requiredIf($request->input('championships_number') != null),
                Rule::unique('championships', 'last_championship_season_id')->where('league_id', $request->input('league_id'))
            ]
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
            $club->save();

            if ($request->input('last_championship_season_id')) {
                $championship = new Championship();
                $championship->league_id = $request->input('league_id');
                $championship->club_id = $club->id;
                $championship->championships_number = $request->input('championships_number');
                $championship->last_championship_season_id = $request->input('last_championship_season_id');
                $championship->save();
            }
        }
        return back()->withMessage('The club was added successfully');
    }

    public function show($id) {
        $club = Club::find($id);
        $championships = Championship::where('club_id', $club->id)->get();
        $players = Player::where('club_id', $club->id)->orderBy('position_id')->get();
        return view('clubs.show', [
            'club' => $club,
            'championships' => $championships,
            'players' => $players,
            'totalPlayers' => $this->clubRepository->getTotalPlayers(),
            'avgAge' => $this->clubRepository->getAvgAge(),
            'foreigners' => $this->clubRepository->getForeigners(),
            'totalMarketValue' => $this->clubRepository->getTotalMarketValue(),
            'avgMarketValue' => $this->clubRepository->getAvgMarketValue(),
            'mostValuablePlayer' => $this->clubRepository->getMostValuablePlayer($club->id),
            'playersAge' => $this->playerRepository->playersAge(),
            'youngestPlayer' => $this->playerRepository->YoungestPlayer($club->id),
            'oldestPlayer' => $this->playerRepository->OldestPlayer($club->id)
        ]);
    }

    public function edit($id) {
        $club = Club::find($id);
        $countries = Country::all();
        $leagues = League::all();
        $championships = Championship::where([
            ['club_id', $club->id],
            ['league_id', $club->league_id]
        ])->get();
        $seasons = Season::orderByDesc('year')->get();
        return view('clubs.edit', [
            'club' => $club,
            'countries' => $countries,
            'leagues' => $leagues,
            'championships' => $championships,
            'seasons' => $seasons
        ]);
    }

    public function update($id, Request $request) {
        $club = Club::find($id);
        $request->validate([
            'name' => ['required', 'min:3', 'max:50', Rule::unique('clubs', 'name')->ignore($club->id)],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'league_id' => ['required', Rule::exists('leagues', 'id')],
            'logo' => ['file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'founded' => ['required', 'integer', 'min:1857'],
            'stadium' => ['required', 'min:1', 'max:50'],
            'address' => ['required', 'min:1', 'max:50'],
            'city' => ['required', 'min:1', 'max:50',],
            'capacity' => ['required', 'integer', 'min:1', 'max:110000'],
            'head_coach' => ['required', 'min:1', 'max:50'],
            'championships_number' => ['numeric', 'nullable', 'min:0', 'max:255',
                Rule::requiredIf($request->input('last_championship_season_id'))],
            'last_championship_season_id' => [Rule::exists('seasons', 'id'),
                Rule::requiredIf($request->input('championships_number') != null)]
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

        if ($request->input('last_championship_season_id')) {
            $championships = Championship::where([
                ['club_id', $club->id],
                ['league_id', $club->league_id]
            ])->get();
            if (count($championships) > 0) {
                foreach ($championships as $championship) {
                    $request->validate([
                        'last_championship_season_id' => [
                            Rule::unique('championships', 'last_championship_season_id')->where('league_id', $request->input('league_id'))->ignore($championship->id)
                        ]
                    ]);
                    $championship->championships_number = $request->input('championships_number');
                    $championship->last_championship_season_id = $request->input('last_championship_season_id');
                    $championship->save();
                }
            } else {
                $championship = new Championship();
                $championship->league_id = $club->league_id;
                $championship->club_id = $club->id;
                $championship->championships_number = $request->input('championships_number');
                $championship->last_championship_season_id = $request->input('last_championship_season_id');
                $championship->save();
            }
        }
        return back()->withMessage('The club was updated successfully');
    }
}
