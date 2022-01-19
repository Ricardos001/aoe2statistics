@extends('layouts.v2.main-layout')
@section('content')
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
@endsection