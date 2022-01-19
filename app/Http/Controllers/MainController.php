<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;
use App\Models\Games;

class MainController extends Controller
{   
    public function getMostPlayedCiv($playerName){
        if (Players::where('name', $playerName)->get()->isEmpty()){
            return "";
        }
        return Games::where('name', $playerName)
            ->select(Games::raw('civ'), Games::raw('count(*) as count'))
            ->groupBy('civ')
            ->orderBy('count', 'desc')
            ->take(1)
            ->get()[0]->civ;
        
    }
    public function index(){
        $players = Players::latest()->get();
        $games = Games::latest()->get();
        // foreach($players as $player){
        //     $player->winRate = $this->getPlayerWinrate($player->id)."%";
        //     $player->mostPlayedCiv = $this->getMostPlayedCiv($player->name);
        //     $player->save();
        // }

        return view('index', [
            'players' => $players,
            'games' => $games,
            'noPlayer' => '',
        ]);
    }

    

    public function getPlayerWinrate($id){
        $player = Players::findOrFail($id);

        $sum = count(Games::where('name', $player->name)->get()) + count(Games::where('opponent', $player->name)->get());
        if ($sum == 0){
            return 0;
        }
        $win = count(Games::where('winner', $player->name)->get());
        return $playerWinRate = number_format($win/$sum*100, 2, '.', '');
    }

    public function getMostPlayedCivStat($games, $name){
        
        if ($games->isEmpty()){
            return "-";
        }
        
        $gameList = array();
        foreach($games as $game){
            if ($game->name == $name){
                array_push($gameList, $game->civ);
            }else if($game->opponent == $name){
                array_push($gameList, $game->opponentCiv);
            }
        }
        $values = array_count_values($gameList);
        arsort($values);
        //dd($values);
        return $values;
    }

    public function getTopCiv($games, $name){
        if ($games->isEmpty()){
            return array();
        }
        $gameList = array();
        foreach($games as $game){
            if ($game->name == $name){
                if ($game->winner == $name){
                    array_push($gameList, $game->civ);
                }
            }else if($game->opponent == $name){
                if ($game->winner == $name){
                    array_push($gameList, $game->opponentCiv);
                }
            }
        }
        $gameList = array_count_values($gameList);
        //dd($gameList);
        $gameListOsszes = $this->getMostPlayedCivStat($games, $name);
        $finalList = array();

        foreach($gameListOsszes as $gLOName => $gLONumber){
            $empty = true;
            foreach($gameList as $gLName => $gLNumber){
                if ($gLOName == $gLName){
                    $empty = false;
                    array_push($finalList, [number_format($gLNumber/$gLONumber*100, 2, '.', ''), $gLOName, $gLNumber, $gLONumber]);
                    break;
                }
            }
            if ($empty){
                array_push($finalList, [0, $gLOName, 0, $gLONumber]);
            }
        }
        arsort($finalList);
        //dd($finalList);
        //dd($gameList);
        // $values = array_count_values($gameList);
        // arsort($values);
        return $finalList;
    }

    public function getTopPlayedCiv($games, $name){
        if ($games->isEmpty()){
            return array();
        }
        $gameList = array();
        foreach($games as $game){
            if ($game->name == $name){
                if ($game->winner == $name){
                    array_push($gameList, $game->civ);
                }
            }else if($game->opponent == $name){
                if ($game->winner == $name){
                    array_push($gameList, $game->opponentCiv);
                }
            }
        }
        $gameList = array_count_values($gameList);
        //dd($gameList);
        $gameListOsszes = $this->getMostPlayedCivStat($games, $name);
        $finalList = array();

        foreach($gameListOsszes as $gLOName => $gLONumber){
            $empty = true;
            foreach($gameList as $gLName => $gLNumber){
                if ($gLOName == $gLName){
                    $empty = false;
                    array_push($finalList, [$gLONumber, $gLOName, $gLNumber, number_format($gLNumber/$gLONumber*100, 2, '.', '')]);
                    break;
                }
            }
            if ($empty){
                array_push($finalList, [$gLONumber, $gLOName, 0, 0]);
            }
        }
        arsort($finalList);
        // $values = array_count_values($gameList);
        // arsort($values);
        return $finalList;
    }

    public function getColorClass($number){
        if($number < 30){
            return "page-color-1";
        }else if($number < 50){
            return "page-color-2";
        }else if($number < 70){
            return "page-color-3";
        }else{
            return "page-color-4";
        }
        
    }

    public function getGameLengthStats($games, $name){
        $finalList = array();
        $list20 = array();
        $list20Wins = array();
        $list2030 = array();
        $list2030Wins = array();
        $list3040 = array();
        $list3040Wins = array();
        $list40 = array();
        $list40Wins = array();

        foreach ($games as $game){
            if (intval($game->gameTime) < 20){
                if ($game->winner == $name){
                    array_push($list20, 1);
                    array_push($list20Wins, 1);
                }else{
                    array_push($list20, 1);
                }
            }
            if (intval($game->gameTime) >= 20 && intval($game->gameTime) < 30){
                if ($game->winner == $name){
                    array_push($list2030, 1);
                    array_push($list2030Wins, 1);
                }else{
                    array_push($list2030, 1);
                }
            }
            if (intval($game->gameTime) >= 30 && intval($game->gameTime) < 40){
                if ($game->winner == $name){
                    array_push($list3040, 1);
                    array_push($list3040Wins, 1);
                }else{
                    array_push($list3040, 1);
                }
            }
            if (intval($game->gameTime) >= 40){
                if ($game->winner == $name){
                    array_push($list40, 1);
                    array_push($list40Wins, 1);
                }else{
                    array_push($list40, 1);
                }
            }

        }

        if (count($list20) > 0){
            array_push($finalList, ["Kevesebb mint 20 perc", count($list20Wins), count($list20), number_format(count($list20Wins)/count($list20)*100, 2, '.', ''), $this->getColorClass(number_format(count($list20Wins)/count($list20)*100, 2, '.', ''))]);
        }else{
            array_push($finalList, ["Kevesebb mint 20 perc", 0, 0, 0, ""]);
        }
        if (count($list2030) > 0){
            array_push($finalList, ["20 és 30 perc között", count($list2030Wins), count($list2030), number_format(count($list2030Wins)/count($list2030)*100, 2, '.', ''), $this->getColorClass(number_format(count($list2030Wins)/count($list2030)*100, 2, '.', ''))]);
        }else{
            array_push($finalList, ["20 és 30 perc között", 0, 0, 0, ""]);
        }
        if (count($list3040) > 0){
            array_push($finalList, ["30 és 40 perc között", count($list3040Wins), count($list3040), number_format(count($list3040Wins)/count($list3040)*100, 2, '.', ''), $this->getColorClass(number_format(count($list3040Wins)/count($list3040)*100, 2, '.', ''))]);
        }else{
            array_push($finalList, ["30 és 40 perc között", 0, 0, 0, ""]);
        }
        if (count($list40) > 0){
            array_push($finalList, ["Több mint 40 perc", count($list40Wins), count($list40), number_format(count($list40Wins)/count($list40)*100, 2, '.', ''), $this->getColorClass(number_format(count($list40Wins)/count($list40)*100, 2, '.', ''))]);
        }else{
            array_push($finalList, ["Több mint 40 perc", 0, 0, 0, ""]);
        }
        
        return $finalList;

    }

    public function getMostPlayedMaps($games, $name){
        $allGames = Games::where('name', $name)
            ->orWhere('opponent', $name)
            ->select(Games::raw('map'), Games::raw('count(*) as count'))
            ->groupBy('map')
            ->orderBy('count', 'desc')
            ->take(3)
            ->get();
        
        $mostPlayesMapList = array();
        foreach($allGames as $mGame){
            $wins = count(Games::where('winner', $name)->where('map', $mGame->map)->get());
            array_push($mostPlayesMapList, [$mGame->map, $mGame->count, $wins, number_format($wins/$mGame->count*100, 2, '.', '')]);
        }
        return $mostPlayesMapList;
    }

    public function getBestWinrateMaps($games, $name){
        $allGames = Games::where('name', $name)
            ->orWhere('opponent', $name)
            ->select(Games::raw('map'), Games::raw('count(*) as count'))
            ->groupBy('map') 
            ->orderBy('count', 'desc')
            ->get();
        
        $bestWinrateList = array();
        foreach($allGames as $mGame){
            $wins = count(Games::where('winner', $name)->where('map', $mGame->map)->get());
            array_push($bestWinrateList, [number_format($wins/$mGame->count*100, 2, '.', ''), $mGame->map, $mGame->count, $wins]);
        }
        arsort($bestWinrateList);
        return $bestWinrateList;
    }

    public function player($id){

        $player = Players::findOrFail($id);
        $games = Games::where('name', $player->name)->orWhere('opponent', $player->name)->get();
        $gyozelmek = Games::where('winner', $player->name)->get();
        $gyozelmekSzama = count($gyozelmek);
        $mostPlayedCiv = $this->getMostPlayedCivStat($games, $player->name);
        $topCivs = $this->getTopCiv($games, $player->name);
        $topPlayedCivs = $this->getTopPlayedCiv($games, $player->name);
        $gameLengthStats = $this->getGameLengthStats($games, $player->name);
        $mostPlayedMaps = $this->getMostPlayedMaps($games, $player->name);
        $bestWinrateMaps = $this->getBestWinrateMaps($games, $player->name);
        
        return view('player')->with('mostPlayedCiv', $mostPlayedCiv)
        ->with('player', $player)
        ->with('winRate', $this->getPlayerWinrate($id))
        ->with('games', $games)
        ->with('gyozelmekSzama', $gyozelmekSzama)
        ->with('topCivs', $topCivs)
        ->with('gameLengthStats', $gameLengthStats)
        ->with('mostPlayedMaps', $mostPlayedMaps)
        ->with('bestWinrateMaps', $bestWinrateMaps)
        ->with('topPlayedCivs', $topPlayedCivs);
    }

    public function players(){
        $players = Players::all();
        return view('players', [
            'players' => $players,
            'noPlayer' => '',
        ]);
    }

    public function matches(){
        $matches = Games::all();
        return view('matches', [
            'matches' => $matches,
            'noGames' => '',
        ]);
    }

    public function searchMatches(){
        $matches = Games::where(request('filter'), request('name'))->get();
        
        return view('matches', [
            'matches' => $matches,
            'noGames' => $matches->isEmpty() ? 'Nincs ilyen találat' : '',
        ]);
    }

    public function newPlayer(){

        return view('new-player');
    }

    public function newMatch(){

        return view('new-match');   
    }

    public function searchPlayer(){

        $player = Players::where('name', request('name'))->get();
        
        if (!$player->isEmpty()){
            $playerId = Players::where('name', request('name'))->first()->id;
            return redirect("/player"."/".$playerId); //$this->player($player->get('id'));
            
            // return view('searching-result', [
            //     'player' => $player,
            // ]);
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

    public function storeNewPlayer(){

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

        //CIV SAVE
        $player = Players::where('name', request('name'))->first();
        $player->mostPlayedCiv = $this->getMostPlayedCiv($player->name);
        $player->save();

        return $this->index();

    }

    public function storeNewMatch(){
        
        $game = new Games();

        $game->name = request('name');
        $game->civ = request('civ');
        $game->opponent = request('opponent');
        $game->opponentCiv = request('opponentCiv');
        $game->map = request('map');
        $game->winner = request('winner');
        $game->gameTime = request('gameTime');

        $game->save();

        $game2 = new Games();

        $game2->name = request('opponent');
        $game2->civ = request('opponentCiv');
        $game2->opponent = request('name');
        $game2->opponentCiv = request('civ');
        $game2->map = request('map');
        $game2->winner = request('winner');
        $game2->gameTime = request('gameTime');

        $game2->save();

        return $this->index();

    }

    //sets

    public function setPlayerIndex($id){
        $player = Players::findOrFail($id);
        
        return view('set-player', [
            'player' => $player,
            'winRate' => $this->getPlayerWinrate($id),
        ]);
    }

    public function setPlayerStore(Request $request,$id){
        
        $this->validate($request, [
            // 'name' => 'required',
            'elo' => 'required',
            'country' => 'required',
            /*'winRate' => 'required',
            'mostPlayedCiv' => 'required',*/
        ]); 
        //dd(2);
        $player = Players::find($id);

        //$player->name = $request->input('name');// vagy $player->name = $request->name;
        $player->elo = $request->input('elo');
        $player->country = $request->input('country');
        /*$player->winRate = $request->input('winRate');
        $player->mostPlayedCiv = $request->input('mostPlayedCiv');*/

        $player->save();

        //\Session::flash("error","Sajnáljuk, de erre a kampányra csak az új felhasználók jogosultak.");
        return redirect("/");
    }

    public function deletePlayer($id){
        
        $player = Players::find($id);

        $player->delete();

        return redirect("/");
    }


    public function setMatchIndex($id){
        $game = Games::findOrFail($id);
        
        return view('set-match', [
            'game' => $game]);
    }

    public function setMatchStore(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'civ' => 'required',
            'opponent' => 'required',
            'map' => 'required',
            'winner' => 'required',
            'gameTime' => 'required',
        ]); 
        //dd(2);
        $game = Games::find($id);

        $game->name = $request->name;
        $game->civ = $request->civ;
        $game->opponent = $request->opponent;
        $game->map = $request->map;
        $game->winner = $request->winner;
        $game->gameTime = $request->gameTime;

        $game->save();

        return redirect("/");
    } 
    
    public function deleteMatch($id){
        
        $game = Games::find($id);

        $game->delete();

        return redirect("/");
    }
}
