@extends('layouts.v2.main-layout')
@section('content')
<div class="main-container">
    <div class="page-kereso">
        
        <form action="/player" method="POST">
            @csrf
            <input class="jatekos-kereso" type="text" placeholder="Játékos neve" name="name" maxlength="30">
            <div class="no-player">{{ $noPlayer }}</div>
            <input class="jatekos-kereso-submit" type="submit" value="Keresés">
        </form>
    </div>
    <div class="page-jatekosok">
        <div class="page-jatekosok-title">Játékosok</div>
        <div class="page-jatekosok-lista">
            <div class="page-jatekos jatekos-title-container">
                <div class="jatekos-title jatekos-both jatekos-nev page-ageof-red">Név</div>
                <div class="jatekos-title jatekos-both jatekos-helyezes">Elo pontszám</div>
                <div class="jatekos-title jatekos-both jatekos-orszag">Ország</div>
                <div class="jatekos-title jatekos-both jatekos-winrate">Győzelmi arány</div>
                <div class="jatekos-title jatekos-both jatekos-civ">Legtöbbet játszott civilizáció</div>
            </div>
            @foreach ( $players as $player)
            @if ($loop->iteration == 11)
                @break
            @endif
                <a class="page-jatekos hover-zoom" href="/player/{{ $player->id }}">
                    <div class="jatekos-both jatekos-nev page-ageof-red">{{ $player->name }}</div>
                    <div class="jatekos-both jatekos-helyezes">{{ $player->elo }}</div>
                    <div class="jatekos-both jatekos-orszag">{{ $player->country }}</div>
                    <div class="jatekos-both jatekos-winrate">{{ $player->winRate }}</div>
                    <div class="jatekos-both jatekos-civ">{{ $player->mostPlayedCiv }}</div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="page-jatekosok">
        <div class="page-jatekosok-title">Mérkőzések</div>
        <div class="page-jatekosok-lista">
            <div class="page-jatekos jatekos-title-container">
                <div class="jatekos-title jatekos-both jatekos-nev page-ageof-red">Név</div>
                <div class="jatekos-title jatekos-both jatekos-helyezes">Ellenfél</div>
                <div class="jatekos-title jatekos-both jatekos-orszag">Civilizáció</div>
                <div class="jatekos-title jatekos-both jatekos-winrate">Pálya</div>
                <div class="jatekos-title jatekos-both jatekos-civ">Győztes</div>
            </div>
            @foreach ( $games as $game)
            @if ($loop->iteration == 11)
                @break
            @endif
                <a class="page-jatekos hover-zoom" href="/admin/set-match/{{ $game->id }}">
                    <div class="jatekos-both jatekos-nev page-ageof-red">{{ $game->name }}</div>
                    <div class="jatekos-both jatekos-helyezes">{{ $game->opponent }}</div>
                    <div class="jatekos-both jatekos-orszag">{{ $game->civ }}</div>
                    <div class="jatekos-both jatekos-winrate">{{ $game->map }}</div>
                    <div class="jatekos-both jatekos-civ">{{ $game->winner }}</div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection