@extends('layouts.main-layout')
@section('content')
<div class="main-container">
    <div class="page-kereso">
        
        <form action="/matches" method="POST">
            @csrf
            <input class="jatekos-kereso" type="text" placeholder="Keresés" name="name" maxlength="30">
            <select name="filter" id="filter" class="filter">
                <option value="name">Név</option>
                <option value="opponent">Ellenfél</option>
                <option value="civ">Civilizáció</option>
                <option value="map">Pálya</option>
                <option value="winner">Győztes</option>
            </select>
            <div class="no-player">{{ $noGames }}</div>
            <input class="jatekos-kereso-submit" type="submit" value="Keresés">
        </form>
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
            @foreach ( $matches as $game)
            
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