@extends('layouts.v2.main-layout')
@section('css')
    <link href = "/css/submit-form.css" rel = "stylesheet">
@endsection
@section('content')


<form class="page-submit-form row" action="/admin/set-match/{{ $game->id }}" method="POST">
    @csrf
    <div class="col-lg-4 col-md-6">
        <label for="name" class="jatekos-store-label">Játékos neve</label>
        <input class="jatekos-store" type="text" placeholder="Játékos neve" name="name" value="{{ $game->name }}" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
        <label for="civ" class="jatekos-store-label">Játékos civilizációja</label>
        <input class="jatekos-store" type="text" placeholder="Játékos civilizációja" name="civ" value="{{ $game->civ     }}" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
    <label for="opponent" class="jatekos-store-label">Játékos ellenfele</label>
            <input class="jatekos-store" type="text" placeholder="Játékos ellenfele" name="opponent" value="{{ $game->opponent }}" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
        <label for="opponent" class="jatekos-store-label">Ellenfél civilizációja</label>
        <input class="jatekos-store" type="text" placeholder="Játékos ellenfele" name="opponentCiv" value="{{ $game->opponentCiv }}" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
        <label for="map" class="jatekos-store-label">Pálya</label>
        <input class="jatekos-store" type="text" placeholder="Pálya" name="map" value="{{ $game->map }}" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
        <label for="winner" class="jatekos-store-label">Győztes</label>
        <input class="jatekos-store" type="text" placeholder="Győzte" name="winner" value="{{ $game->winner }}" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
        <label for="gameTime" class="jatekos-store-label">Játékidő</label>
        <input class="jatekos-store" type="text" placeholder="Játékidő" name="gameTime" value="{{ $game->gameTime }}" required maxlength="30">
    </div>
    
    <div class="page-submit col-12">
        <input class="jatekos-kereso-submit store-submit" type="submit" value="Mérkőzés szerkesztése"></div>
</form>

<form action="/admin/delete-match/{{ $game->id }}" method="POST" class="page-submit-form row mt-5">
    @csrf
    <input class="jatekos-kereso-submit store-submit bg-danger " type="submit" value="Mérkőzés törlése">
</form>


{{--    
    <div class="main-container">
<div class="page-kereso page-form-store">
        <form action="/admin/set-match/{{ $game->id }}" method="POST">
            @csrf
            <label for="name" class="jatekos-store-label">Játékos neve</label>
            <input class="jatekos-store" type="text" placeholder="Játékos neve" name="name" value="{{ $game->name }}" required maxlength="30">
            <label for="civ" class="jatekos-store-label">Játékos civilizációja</label>
            <input class="jatekos-store" type="text" placeholder="Játékos civilizációja" name="civ" value="{{ $game->civ     }}" required maxlength="30">
            <label for="opponent" class="jatekos-store-label">Játékos ellenfele</label>
            <input class="jatekos-store" type="text" placeholder="Játékos ellenfele" name="opponent" value="{{ $game->opponent }}" required maxlength="30">
            <label for="map" class="jatekos-store-label">Pálya</label>
            <input class="jatekos-store" type="text" placeholder="Pálya" name="map" value="{{ $game->map }}" required maxlength="30">
            <label for="winner" class="jatekos-store-label">Győztes</label>
            <input class="jatekos-store" type="text" placeholder="Győzte" name="winner" value="{{ $game->winner }}" required maxlength="30">
            <label for="gameTime" class="jatekos-store-label">Játékidő</label>
            <input class="jatekos-store" type="text" placeholder="Játékidő" name="gameTime" value="{{ $game->gameTime }}" required maxlength="30">
            <input class="jatekos-kereso-submit store-submit" type="submit" value="Játékos adatainak módosítása">
        </form>
        <br>
        <form action="/admin/delete-match/{{ $game->id }}" method="POST">
            @csrf
            <input class="jatekos-kereso-submit store-submit submit-delete " type="submit" value="Mérkőzés törlése">
        </form>
    </div>
</div>
--}}

@endsection