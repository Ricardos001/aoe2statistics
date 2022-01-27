@extends('layouts.v2.main-layout')

@section('css')
    <link href = "/css/fooldal.css" rel = "stylesheet">
@endsection

@section('content')
<div class="row" id="jatekosok">
    <div class="page-jatekosok-title col-md-12">Játékosok</div>
        @foreach ( $players as $player)
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 hover-zoom2 player-container">
                <div class="player-container-inside" >
                    <div class="jatekos-kep-container"><img src="/images/players/default-player.jpg" alt="player-img-{{ $player->name }}" class="img-thumbnail player-img"></div>
                    <div class="jatekos-both jatekos-nev">{{ $player->name }}</div>
                    <div class="jatekos-both jatekos-helyezes">{{ $player->elo }}</div>
                    <form action="/admin/delete-player/{{ $player->id }}" class="d-flex justify-content-center"  method="POST">
                        @csrf
                        <input type="submit" value="Törlés">
                    </form>
                </div>
            </div>
            
        @endforeach
    </div>
</div>
@endsection