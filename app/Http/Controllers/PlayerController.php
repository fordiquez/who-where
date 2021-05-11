<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Country;
use App\Models\Player;
use App\Models\Position;
use App\Models\Transfer;
use App\Repositories\PlayerRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlayerController extends Controller
{
    private $path = '/assets/images/players';
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function index($clubId = null) {
        $club = Club::find($clubId);
        if ($clubId) {
            $players = Player::where('club_id', $clubId)->orderBy('position_id')->paginate(10);
        } else {
            $players = Player::orderBy('position_id')->paginate(10);
        }
        $countries = Country::orderBy('name')->get();
        $positions = Position::all();
        $clubs = Club::orderBy('league_id')->orderBy('name')->get();
        return view('players.index', [
            'club' => $club,
            'players' => $players,
            'countries' => $countries,
            'positions' => $positions,
            'clubs' => $clubs,
            'playersAge' => $this->playerRepository->playersAge()
        ]);
    }

    public function store(Request $request) {
        $validated_timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y') - 16);
        $validated_birth_date = date("Y-m-d", $validated_timestamp);
        $request->validate([
            'name' => ['required', 'min:3', 'max:50', Rule::unique('players', 'name'),],
            'photo' => ['required', 'file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'number' => ['required', 'integer', 'min:1', 'max:99'],
            'birth_date' => ['required', 'date', 'before_or_equal:' . $validated_birth_date],
            'birth_country_id' => ['required', Rule::exists('countries', 'id')],
            'height' => ['required', 'numeric', 'min:0.00', 'max:2.50'],
            'citizenship_country_id' => ['required', Rule::exists('countries', 'id')],
            'position_id' => ['required', Rule::exists('positions', 'id')],
            'main_position_id' => ['required', Rule::exists('positions', 'id')],
            'foot' => ['required', 'prohibited_unless:foot,Left,Right'],
            'club_id' => ['required', Rule::exists('clubs', 'id')],
            'signed_from_club_id' => ['required', Rule::exists('clubs', 'id'),
                'prohibited_if:club_id,' . $request->input('signed_from_club_id')],
            'joined' => ['required', 'date', 'after:' . $validated_birth_date],
            'contract_expires' => ['required', 'date', 'after:joined'],
            'market_value' => ['required', 'numeric', 'min:0.00']
        ]);
        $name = $request->input('name');
        $photo = $request->file('photo');
        if ($photo->isValid()) {
            $extension = $photo->extension();
            $path = $photo->storeAs($this->path, strtolower(str_replace(' ', '-', $name)) . '.' . $extension);
            $player = new Player();
            $player->name = $name;
            $player->photo = $path;
            $player->number = $request->input('number');
            $player->birth_date = $request->input('birth_date');
            $player->birth_country_id = $request->input('birth_country_id');
            $player->height = $request->input('height');
            $player->citizenship_country_id = $request->input('citizenship_country_id');
            $player->position_id = $request->input('position_id');
            $player->main_position_id = $request->input('main_position_id');
            $player->foot = $request->input('foot');
            $player->club_id = $request->input('club_id');
            $player->signed_from_club_id = $request->input('signed_from_club_id');
            $player->joined = $request->input('joined');
            $player->contract_expires = $request->input('contract_expires');
            $player->market_value = $request->input('market_value');
            $player->saveOrFail();
        }
        return back()->withMessage('The player was added successfully');
    }

    public function show($id) {
        $player = Player::find($id);
        $transfers = Transfer::where('player_id', $player->id)->get();
        return view('players.show', [
            'player' => $player,
            'transfers' => $transfers,
            'playerAge' => $this->playerRepository->playerAge($player->id)
        ]);
    }

    public function edit($id) {
        $player = Player::find($id);
        $countries = Country::orderBy('name')->get();
        $positions = Position::all();
        $clubs = Club::orderBy('league_id')->orderBy('name')->get();
        return view('players.edit', [
            'player' => $player,
            'countries' => $countries,
            'positions' => $positions,
            'clubs' => $clubs
        ]);
    }

    public function update($id, Request $request) {
        $player = Player::find($id);
        $validated_timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y') - 16);
        $validated_birth_date = date("Y-m-d", $validated_timestamp);
        $request->validate([
            'name' => ['required', 'min:3', 'max:50', Rule::unique('players', 'name')->ignore($player->id)],
            'photo' => ['file', 'mimes:svg,png,jpg,jpeg,bmp,webp'],
            'number' => ['required', 'integer', 'min:1', 'max:99'],
            'birth_date' => ['required', 'date', 'before_or_equal:' . $validated_birth_date],
            'birth_country_id' => ['required', Rule::exists('countries', 'id')],
            'height' => ['required', 'numeric', 'min:0.00', 'max:2.50'],
            'citizenship_country_id' => ['required', Rule::exists('countries', 'id')],
            'position_id' => ['required', Rule::exists('positions', 'id')],
            'main_position_id' => ['required', Rule::exists('positions', 'id')],
            'foot' => ['required', 'prohibited_unless:foot,Left,Right'],
            'club_id' => ['required', Rule::exists('clubs', 'id')],
            'signed_from_club_id' => ['required', Rule::exists('clubs', 'id'),
                'prohibited_if:club_id,' . $request->input('signed_from_club_id')],
            'joined' => ['required', 'date', 'after:' . $validated_birth_date],
            'contract_expires' => ['required', 'date', 'after:joined'],
            'market_value' => ['required', 'numeric', 'min:0.00']
        ]);
        $name = $request->input('name');
        if ($request->file('photo')) {
            $photo = $request->file('logo');
            if ($photo->isValid()) {
                $extension = $photo->extension();
                $path = $photo->storeAs($this->path, strtolower(str_replace(' ', '-', $name)) . '.' . $extension);
                $player->photo = $path;
            }
        }
        $player->name = $name;
        $player->number = $request->input('number');
        $player->birth_date = $request->input('birth_date');
        $player->birth_country_id = $request->input('birth_country_id');
        $player->height = $request->input('height');
        $player->citizenship_country_id = $request->input('citizenship_country_id');
        $player->position_id = $request->input('position_id');
        $player->main_position_id = $request->input('main_position_id');
        $player->foot = $request->input('foot');
        $player->club_id = $request->input('club_id');
        $player->signed_from_club_id = $request->input('signed_from_club_id');
        $player->joined = $request->input('joined');
        $player->contract_expires = $request->input('contract_expires');
        $player->market_value = $request->input('market_value');
        $player->save();
        return back()->withMessage('The player was updated successfully');
    }
}
