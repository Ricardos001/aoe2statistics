@extends('layouts.v2.main-layout')
@section('css')
    <link href = "/css/admin-matches.css" rel = "stylesheet">
    
@endsection
@section('content')
<div class="pt-2 pb-2 ps-4 pe-4">
{{ $matches->links() }}
    @foreach($matches as $match)
    <a class="row match-box" href="/admin/set-match/{{ $match->id }}">
        <div class="col-md-4 match-box-inside">
            <div class="">Játékos</div>
            <div class="">{{$match->name}}</div>
            <div class="">{{$match->civ}}</div>
        </div>
        <div class="col-md-4 match-box-inside">
            <div class="">Ellenfél</div>
            <div class="">{{$match->opponent}}</div>
            <div class="">{{$match->opponentCiv}}</div>
        </div>
        <div class="col-md-4 match-box-inside">
            <div class="">Egyéb</div>
            <div class="">Pálya: {{$match->map}}</div>
            <div class="">Játékidő: {{$match->gameTime}}</div>
        </div>
    </a>
        
    @endforeach

    {{ $matches->links() }}
</div>
@endsection