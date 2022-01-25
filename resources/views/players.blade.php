@extends('layouts.v2.main-layout')

@section('css')
    <link href = "{{asset('css/players.css')}}" rel = "stylesheet">
@endsection

@section('content')
<div class="main-container">

    <div class="row" id="jatekosok">
        <div class="page-jatekosok-title col-md-12">Játékosok</div>
            @foreach ( $players as $player)
                <a class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 hover-zoom2 player-container" href="/player/{{ $player->id }}">
                    <div class="player-container-inside" >
                        <div class="jatekos-kep-container"><img src="/images/players/default-player.jpg" alt="player-img-{{ $player->name }}" class="img-thumbnail player-img"></div>
                        <div class="jatekos-both jatekos-nev">{{ $player->name }}</div>
                        <div class="jatekos-both jatekos-helyezes">{{ $player->elo }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    
</div>
@endsection