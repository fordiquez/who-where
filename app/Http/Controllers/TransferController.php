<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Transfer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function show($id) {
        $transfer = Transfer::find($id);
        return view('transfers.show', [
            'transfer' => $transfer,
        ]);
    }

    public function store(Request $request)
    {
        $transfer = new Transfer();
        $transfer->player_id = $request->player_id;
        $transfer->season_id = $request->season_id;
        $transfer->transfer_date = $request->transfer_date;
        $transfer->transfer_window = $request->transfer_window;
        $transfer->contract_expires = $request->contract_expires;
        $left_club_id = Player::find($request->player_id);
        $transfer->left_club_id = $left_club_id->club_id;
        $transfer->joined_club_id = $request->joined_club_id;
        $transfer->fee = $request->fee;
        $transfer->loan = $request->loan;
        $transfer->save();
        return back()->withMessage('Transfer was added successfully');
    }

    public function edit($id) {
        $transfer = Transfer::find($id);
        return view('transfers.edit', [
            'transfer' => $transfer,
        ]);
    }

    public function update($id, Request $request)
    {
        $transfer = Transfer::find($id);
        $transfer->transfer_date = $request->transfer_date;
        $transfer->transfer_window = $request->transfer_window;
        $transfer->contract_expires = $request->contract_expires;
        $transfer->fee = $request->fee;
        $transfer->loan = $request->loan;
        $transfer->save();
        return back()->withMessage('Transfer was updated successfully');
    }

    public function delete($id): RedirectResponse
    {
        $transfer = Transfer::find($id);
        $transfer->delete();
        return back()->withMessage('Transfer was deleted successfully');
    }
}
