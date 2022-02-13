@extends('layouts.v2.main-layout')
@section('css')
@endsection
@section('content')
    <div class="d-flex justify-content-around align-items-center pt-3">
    <a href="/admin/new-player" class="btn btn-secondary">Új játékos</a>
    <a href="/admin/new-match" class="btn btn-secondary">Új mérkőzés</a>
    <a href="/admin/players" class="btn btn-secondary">Játékosok</a>
    <a href="/admin/matches" class="btn btn-secondary">Mérkőzések</a>
    </div>
@endsection