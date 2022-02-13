@extends('layouts.v2.main-layout')

@section('css')
    <link href = "/css/fooldal.css" rel = "stylesheet">
@endsection

@section('content')
<div class="row" id="jatekosok">
    <div class="page-jatekosok-title col-md-12">Játékosok (admin)</div>
        @foreach ( $players as $player)
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 hover-zoom2 player-container">
                <div class="player-container-inside" >
                    <a class="jatekos-kep-container" href="/player/{{ $player->id }}"><img src="/images/players/default-player.jpg" alt="player-img-{{ $player->name }}" class="img-thumbnail player-img"></a>
                    <div class="jatekos-both jatekos-nev">{{ $player->name }}</div>
                    <div class="jatekos-both jatekos-helyezes">{{ $player->elo }}</div>
                    <form action="/admin/delete-player/{{ $player->id }}" class="d-flex justify-content-center pt-2"  method="POST" onsubmit="return validate(this);">
                        @csrf
                        <input type="submit" value="Törlés" >
                    </form>
                    <a href="/admin/set-player/{{ $player->id }}" class="d-flex justify-content-center pt-2">Szerkesztés</a>
                </div>
            </div>
            
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<script>
function validate(form) {
    
    return confirm('Biztosan törölni akarod a játékost?');
}
</script>
@endsection
