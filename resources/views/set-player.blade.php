@extends('layouts.v2.main-layout')
@section('css')
    <link href = "/css/submit-form.css" rel = "stylesheet">
@endsection
@section('content')
{{--
    <div class="main-container">
    <div class="page-kereso page-form-store">
        <form action="/admin/set-player/{{ $player->id }}" method="POST">
            @csrf
            @if(isset($errors) && $errors->count() != 0) @php dd($errors); @endphp @endif 
            <label for="name" class="jatekos-store-label">Játékos neve</label>
            <input class="jatekos-store" type="text" placeholder="Játékos neve" name="name" value="{{ $player->name }}" disabled maxlength="30">
            <label for="elo" class="jatekos-store-label">Játékos pontszáma</label>
            <input class="jatekos-store" type="text" placeholder="Játékos pontszáma" name="elo" value="{{ $player->elo }}" required maxlength="30">
            <label for="country" class="jatekos-store-label">Játékos országa</label>
            <input class="jatekos-store" type="text" placeholder="Játékos országa" name="country" value="{{ $player->country }}" required  maxlength="30">
            <label for="winRate" class="jatekos-store-label">Játékos győzelmi aránya</label>
            <input class="jatekos-store" type="text" placeholder="Játékos győzelmi aránya" name="winRate" value="%" disabled  maxlength="30">
            <label for="mostPlayedCiv" class="jatekos-store-label">Játékos legtöbbet játszott civiliációja</label>
            <input class="jatekos-store" type="text" placeholder="Játékos legtöbbet játszott civiliációja" name="mostPlayedCiv" value="{{ $player->mostPlayedCiv }}" disabled  maxlength="30">
            <input class="jatekos-kereso-submit store-submit" type="submit" value="Játékos adatainak módosítása">
        </form>
        <br>
        <form action="/admin/delete-player/{{ $player->id }}" method="POST">
            @csrf
            <input class="jatekos-kereso-submit store-submit submit-delete" type="submit" value="Játékos törlése">
        </form>
    </div>
</div>
--}}

<form class="page-submit-form row" action="/admin/set-player/{{ $player->id }}" method="POST">
    @csrf
    <div class="col-lg-4 col-md-6">
        <label for="name" class="jatekos-store-label">Játékos neve: </label>
        <input class="jatekos-store" type="text" placeholder="Játékos neve" value="{{ $player->name }}" name="name" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
        <label for="elo" class="jatekos-store-label">Játékos pontszáma: </label>
        <input class="jatekos-store" type="text" placeholder="Játékos pontszáma" name="elo" value="{{ $player->elo }}" required maxlength="30">
    </div>
    <div class="col-lg-4 col-md-6">
        <label for="country" class="jatekos-store-label">Játékos országa: </label>
        <input class="jatekos-store" type="text" placeholder="Játékos országa" value="Magyarország" name="country" required maxlength="30">
    </div>
    <div class="page-submit col-12"><input class="jatekos-kereso-submit store-submit" type="submit" value="Játékos szerkesztése"></div>
</form>

@endsection