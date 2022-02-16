<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;
use App\Models\Games;
use App\Models\User;
use File;

class AdminController extends Controller
{   


    //users
    public function adminIndex(){
        return view('admin.admin');
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

        return redirect('/admin/players');

    }
    public function setPlayerGet($id){
        $player = Players::findOrFail($id);
        return view('set-player', [
            'player' => $player
        ]);
    }
    public function setPlayerPost(Request $request,$id){
        $this->validate($request, [
            'elo' => 'required',
            'country' => 'required',
        ]); 
        $player = Players::find($id);
        $player->name = $request->input('name');
        $player->elo = $request->input('elo');
        $player->country = $request->input('country');
        $player->save();
        return redirect("/admin/players");
    }
    public function deletePlayer($id){
        $player = Players::find($id);
        $player->delete();
        return redirect('/admin/players');
    }
    //match
    public function matches(){
        $matches = Games::paginate(10);
        return view('admin.matches',
            ['matches' => $matches]
        );
    }
    public function newMatchGet(){
        return view('new-match');   
    }
    public function newMatchPost(){
        $game = new Games();

        $game->name = request('name');
        $game->civ = request('civ');
        $game->opponent = request('opponent');
        $game->opponentCiv = request('opponentCiv');
        $game->map = request('map');
        $game->winner = request('winner');
        $game->gameTime = request('gameTime');

        $game->save();

        return redirect('/admin/players');
    }
    public function setMatchGet($id){
        $game = Games::findOrFail($id);
        
        return view('set-match', [
            'game' => $game]);
    }
    public function setMatchPost(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'civ' => 'required',
            'opponent' => 'required',
            'map' => 'required',
            'winner' => 'required',
            'gameTime' => 'required',
        ]); 
        $game = Games::find($id);

        $game->name = $request->name;
        $game->civ = $request->civ;
        $game->opponent = $request->opponent;
        $game->opponentCiv = $request->opponentCiv;
        $game->map = $request->map;
        $game->winner = $request->winner;
        $game->gameTime = $request->gameTime;

        $game->save();
        return redirect("/admin");
    }
    public function deleteMatch($id){
        $game = Games::find($id);
        $game->delete();
        return redirect("/admin");
    }

    //images uploading
    public function setPlayerImagePost(Request $request, $id){
        $validatedData = $request->validate([
            'profilePicture' => 'required',
        ]);
        //$path = $request->file('profilePicture')->store('public/images/players');
        // $path = $request->file('profilePicture')->store('/','public');
        // $md5Name = md5_file($request->file('profilePicture')->getRealPath());
        // $guessExtension = $request->file('profilePicture')->guessExtension();
        // $file = $request->file('profilePicture')->storeAs('public/images/players', $md5Name.'.'.$guessExtension  ,'your_disk');
        $image = $request->file('profilePicture');
        $input['imagename'] = $id . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/players');
        $image->move($destinationPath, $input['imagename']);
        return redirect('/admin/players');
    }
    //delete images
    public function deletePlayerImagePost($id)
    {
        if(File::exists(public_path('images/players/'.$id.'.jpg'))){
            File::delete(public_path('images/players/'.$id.'.jpg'));
        }else{
            dd('File does not exists.');
        }
        return redirect('/admin/players');
    }
}
