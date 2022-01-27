@extends('layouts.v2.main-layout')
@section('css')
    <link href = "/css/submit-form.css" rel = "stylesheet">
@endsection
@section('content')
    <form class="page-submit-form row" action="/admin/new-player" method="POST">
        @csrf
        <div class="col-lg-4 col-md-6">
            <label for="name" class="jatekos-store-label">Játékos neve: </label>
            <input class="jatekos-store" type="text" placeholder="Játékos neve" name="name" required maxlength="30">
        </div>
        <div class="col-lg-4 col-md-6">
            <label for="elo" class="jatekos-store-label">Játékos pontszáma: </label>
            <input class="jatekos-store" type="text" placeholder="Játékos pontszáma" name="elo" required maxlength="30">
        </div>
        <div class="col-lg-4 col-md-6">
            <label for="country" class="jatekos-store-label">Játékos országa: </label>
            <input class="jatekos-store" type="text" placeholder="Játékos országa" value="Magyarország" name="country" required maxlength="30">
        </div>
        <div class="page-submit col-12"><input class="jatekos-kereso-submit store-submit" type="submit" value="Játékos hozzáadása"></div>
    </form>
    {{--
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="page-kereso page-form-store">
        <form action="/admin/new-player" method="POST" class="row">
            @csrf
            <div class="col-md-6">
            <label for="name" class="jatekos-store-label">Játékos neve: </label>
            <input class="jatekos-store" type="text" placeholder="Játékos neve" name="name" required maxlength="30">
            </div>
            <div class="col-md-6">
            <label for="elo" class="jatekos-store-label">Játékos pontszáma: </label>
            <input class="jatekos-store" type="text" placeholder="Játékos pontszáma" name="elo" required maxlength="30">
            </div>
            <div class="col-md-6">
            <label for="country" class="jatekos-store-label">Játékos országa: </label>
            <input class="jatekos-store" type="text" placeholder="Játékos országa" name="country" required maxlength="30">
            </div>
            <div class="col-md-12">
            <input class="jatekos-kereso-submit store-submit" type="submit" value="Játékos hozzáadása">
            </div>
        </form>
    </div>
    --}}
@endsection