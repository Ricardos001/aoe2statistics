<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;
use App\Models\Games;

class MainController2 extends Controller
{
    //controllers for v2 views

    //MAIN FUNCTIONS
    public function index(){
        $players = Players::latest()->get();

        return view('index', [
            'players' => $players
        ]);
    }

    //PLAYER FUNCTIONS
    public function players(){
        $players = Players::all();
        return view('players', [
            'players' => $players,
        ]);
    }
    public function searchPlayer(){
        $player = Players::where('name', request('name'))->get();
        if (!$player->isEmpty() && count($player)!=0){
            $playerId = Players::where('name', request('name'))->first()->id;
            return redirect("/player"."/".$playerId);
        }else{
            $players = Players::latest()->get();
            $games = Games::latest()->get();
            return view('index', [
                'players' => $players,
                'games' => $games,
                'noPlayer' => 'Nincs '.request('name').' nevű játékos',
            ]);
        }
    }

}
