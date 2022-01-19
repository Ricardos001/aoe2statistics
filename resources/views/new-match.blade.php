@extends('layouts.main-layout')
@section('content')
    <div class="page-kereso page-form-store">
        <form action="/admin/new-match" method="POST">
            @csrf
            <label for="name" class="jatekos-store-label">Játékos neve</label>
            <input class="jatekos-store" type="text" placeholder="Játékos neve" name="name" required maxlength="30">
            <label for="civ" class="jatekos-store-label">Játékos civilizációja</label>
            <input class="jatekos-store" type="text" placeholder="Játékos civilizációja" name="civ" required maxlength="30">
            <label for="opponent" class="jatekos-store-label">Játékos ellenfele</label>
            <input class="jatekos-store" type="text" placeholder="Játékos ellenfele" name="opponent" required maxlength="30">
            <label for="opponentCiv" class="jatekos-store-label">Ellenfél civilizációja</label>
            <input class="jatekos-store" type="text" placeholder="Ellenfél civilizációja" name="opponentCiv" required maxlength="30">
            <label for="map" class="jatekos-store-label">Pálya</label>
            <input class="jatekos-store" type="text" placeholder="Pálya" name="map" required maxlength="30">
            <label for="winner" class="jatekos-store-label">Győztes</label>
            <input class="jatekos-store" type="text" placeholder="Győztes neve" name="winner" required maxlength="30">
            <label for="gameTime" class="jatekos-store-label">Játékidő</label>
            <input class="jatekos-store" type="text" placeholder="Játékidő" name="gameTime" required maxlength="30">
            <input class="jatekos-kereso-submit store-submit" type="submit" value="Játékos hozzáadása">
        </form>
    </div>
@endsection