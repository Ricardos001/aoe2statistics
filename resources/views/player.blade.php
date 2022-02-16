@extends('layouts.v2.main-layout')

@section('css')
    <link href = "/css/player-page.css" rel = "stylesheet">
@endsection

@section('content')
<div class="main-container">
    <div class="player-head row">
        <div class="player-head-inside row">
            <div class="player-img-container col-md-2">
                @php 
                    $filePath = '/images/players/'.$player->id.'.jpg';
                @endphp
                @if ( \File::exists(public_path($filePath)) ) 
                    <img src="/images/players/{{ $player->id }}.jpg" alt="player-img" class="img-thumbnail player-img player-img-profile">
                @else
                    <img src="/images/players/default-player.jpg" alt="default-player-img" class="img-thumbnail player-img player-img-profile">
                @endif
            </div>
            <div class="player-data col-md-10">
                <div class="player-name">{{ $player->name }} <div class="player-flag-container" ><img src="/images/flags/1.png" class="player-flag" alt="" data-bs-toggle="tooltip" data-bs-placement="top" title="Magyarország"></div>  </div>
                <div class="player-data-elo">Elo: {{ $player->elo }}</div>
                @if (Auth::check()) <a href="/admin/set-player/{{ $player->id }}" class="btn btn-secondary">Szerkesztés</a> @endif
            </div>
        </div>
    </div>
    <div class="player-head-container row">
        <!-- <div class="player-title col-xxl-3 col-lg-4 col-md-6">
            <div class="player-title-inside">
            <div class="player-details-title">Jelenlegi helyezés</div>
            <div class="player-details-content">A/1</div>
            </div>
        </div> -->
        <div class="player-title player-country col-xxl-3 col-lg-4 col-md-6">
            <div class="player-title-inside">
            <div class="player-details-title">Lejátszott meccsek száma</div>
            <div class="player-details-content">{{ count($games); }}</div>
            </div>
        </div>
        <div class="player-title col-xxl-3 col-lg-4 col-md-6">
            <div class="player-title-inside">
            <div class="player-details-title">Győzelmek</div>
            <div class="player-details-content">{{ $gyozelmekSzama }}</div>
            </div>
        </div>
        <div class="player-title col-xxl-3 col-lg-4 col-md-6">
            <div class="player-title-inside">
            <div class="player-details-title">Győzelmi arány</div>
            <div class="player-details-content">{{ $winRate }}%</div>
            </div>
        </div>
        <div class="player-title player-elo col-xxl-3 col-lg-4 col-md-6">
            <div class="player-title-inside">
            <div class="player-details-title">Legtöbbet játszott civilizáció</div>
            <div class="player-details-content">@if ($mostPlayedCiv == "-") - @else {{ array_key_first($mostPlayedCiv) }} @endif</div>
            </div>
        </div>
        <!-- <div class="player-title col-xxl-3 col-lg-4 col-md-6">
            <div class="player-title-inside">
            <div class="player-details-title">Legmagasabb Elo pontszám</div>
            <div class="player-details-content">2890</div>
            </div>
        </div> -->
    </div>

    <div class="page-smart-title">Top civilizáció <span class="page-braces">(győzelmi arány)</span></div>
    <div class="page-gametime-stats-container row">
        @foreach($topCivs as $topCiv)
        @if ($loop->iteration == 4)
            @break
        @endif
        <div class="col-md-4 player-title">
            <div class="page-gametime-stat-container player-title-inside">
                <div class="page-gametime-title">{{ $topCiv[1] }}</div>
                <div class="page-gametime-stat-content player-details-content">{{ $topCiv[0] }}% ({{ $topCiv[2] }}/{{ $topCiv[3] }})</div>
            </div>
        </div>
        @endforeach
        
    </div>

    <div class="page-smart-title">Top civilizáció <span class="page-braces">(játszott)</span></div>
    <div class="page-gametime-stats-container row">
        @foreach($topPlayedCivs as $topCiv)
        @if ($loop->iteration == 4)
            @break
        @endif
        <div class="col-md-4 player-title">
            <div class="page-gametime-stat-container player-title-inside">
                <div class="page-gametime-title">{{ $topCiv[1] }}</div>
                <div class="page-gametime-stat-content player-details-content">{{ $topCiv[3] }}% ({{ $topCiv[2] }}/{{ $topCiv[0] }})</div>
            </div>
        </div>
        @endforeach
        
    </div>

    <div class="page-smart-title">Top térkép <span class="page-braces">(győzelmi arány)</span></div>
    <div class="page-gametime-stats-container row">
        @foreach ($bestWinrateMaps as $game)
        @if ($loop->iteration == 4)
            @break
        @endif
        <div class="col-md-4 player-title">
            <div class="page-gametime-stat-container player-title-inside">
                <div class="page-gametime-title">{{ $game[1] }}</div>
                <div class="page-gametime-stat-content player-details-content">{{ $game[0] }}% ({{ $game[3] }}/{{ $game[2] }})</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="page-smart-title">Top térkép <span class="page-braces">(játszott)</span></div>
    <div class="page-gametime-stats-container row">
        @foreach ($mostPlayedMaps as $game)
        <div class="col-md-4 player-title">
            <div class="page-gametime-stat-container player-title-inside">
                <div class="page-gametime-title">{{ $game[0] }} ({{ $game[1] }})</div>
                <div class="page-gametime-stat-content player-details-content">{{ $game[3] }}% ({{ $game[2] }}/{{ $game[1] }})</div>
            </div>
        </div>
        @endforeach
    </div>

    {{--<a href="/player/{{ $player->id + 1 }}">Tovább</a> --}}
    <div class="page-smart-title">Győzelmi arány a mérkőzés hossza alapján </div>
    <div class="page-gametime-stats-container row">
        @foreach($gameLengthStats as $game)
        <div class="col-md-3 player-title">
            <div class="{{ $game[4] }} page-gametime-stat-container player-title-inside">
                <div class="page-gametime-title">{{ $game[0] }}</div>
                <div class="page-gametime-stat-content player-details-content">{{ $game[3] }}% ({{ $game[1] }}/{{ $game[2] }})</div>
            </div>
        </div>
        @endforeach
    </div>
    {{--
    <div class="page-smart-title">Legutóbbi mérkőzések</div>
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
    --}}
</div>
@endsection

@section('content1')
<div class="main-container">
    <div class="player-head-container">
        <div class="player-title player-name">
            <div class="player-details-title">Név</div>
            <div class="player-details-content">{{ $player->name }}</div>
        </div>
        <div class="player-title player-elo">
            <div class="player-details-title">Elo</div>
            <div class="player-details-content">{{ $player->elo }}</div>
        </div>
        <div class="player-title player-country">
            <div class="player-details-title">Ország</div>
            <div class="player-details-content">{{ $player->country }}</div>
        </div>
    </div>
    <div class="player-head-container">
        <div class="player-title player-name">
            <div class="player-details-title">Győzelmi rarány</div>
            <div class="player-details-content">{{ $winRate }}%</div>
        </div>
        <div class="player-title player-elo">
            <div class="player-details-title">Legtöbbet játszott civilizáció</div>
            <div class="player-details-content">{{ $player->mostPlayedCiv }}</div>
        </div>
        <div class="player-title player-country">
            <div class="player-details-title">Lejátszott meccsek száma</div>
            <div class="player-details-content">{{ count($games); }}</div>
        </div>
    </div>
    <br>
    <br>
    <a href="/admin/set-player/{{ $player->id }}" class="jatekos-szerkesztese">Játékos szerkesztése</a>
    <br>
    <br>
    <div class="page-jatekosok">
        <div class="page-jatekosok-title">Játékos mérkőzései</div>
        <div class="page-jatekosok-lista">
            <div class="page-jatekos jatekos-title-container">
                <div class="jatekos-title jatekos-both jatekos-nev page-ageof-red">Név</div>
                <div class="jatekos-title jatekos-both jatekos-helyezes">Ellenfél</div>
                <div class="jatekos-title jatekos-both jatekos-orszag">Civilizáció</div>
                <div class="jatekos-title jatekos-both jatekos-winrate">Pálya</div>
                <div class="jatekos-title jatekos-both jatekos-civ">Győztes</div>
            </div>
            @foreach ( $games as $game)
            
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
@section('scripts')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection