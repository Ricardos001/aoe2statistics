<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;
use App\Models\Games;

class MainController2 extends Controller
{
    //controllers for v2 views

    public function getPlayerWinrate($id){
        $player = Players::findOrFail($id);

        $sum = count(Games::where('name', $player->name)->get()) + count(Games::where('opponent', $player->name)->get());
        if ($sum == 0){
            return 0;
        }
        $win = count(Games::where('winner', $player->name)->get());
        return $playerWinRate = number_format($win/$sum*100, 2, '.', '');
    }

    public function player($id){

        $player = Players::findOrFail($id);
        $games = Games::where('name', $player->name)->get();
        
        return view('player', [
            'player' => $player,
            'winRate' => $this->getPlayerWinrate($id),
            'games' => $games,
        ]);
    }

}
