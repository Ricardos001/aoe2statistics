@extends('layouts.v2.main-layout')
@section('content')
<div class="main-container">
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
</div>

@endsection