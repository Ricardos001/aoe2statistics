<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;
use App\Models\Games;
use App\Models\User;

class AdminController extends Controller
{   
    //users
    public function users(){
        dd(User::all());
    }
    //player
    public function newPlayerGet(){
        return view('new-player');
    }
    public function players(){
        $players = Players::all();
        return view('admin.players',
            ['players' => $players]
        );
    }
    public function newPlayerPost(){
        $player = new Players();

        $player->name = request('name');
        $player->elo = request('elo');
        $player->country = request('country');
        $player->winRate = "0%";
        $player->mostPlayedCiv = "";
        $player->matchNumber = 0;
        $player->wins = 0;
        $player->localElo = 0;
        $player->games20Sum = 0;
        $player->games2030Sum = 0;
        $player->games3040Sum = 0;
        $player->games40Sum = 0;
        $player->games20Win = 0;
        $player->games2030Win = 0;
        $player->games3040Win = 0;
        $player->games40Win = 0;
        
        $player->save();

        dd($player);
    }
    public function deletePlayer($id){
        $player = Players::find($id);
        $player->delete();
        return redirect('/admin/players');
    }
    //match
}
