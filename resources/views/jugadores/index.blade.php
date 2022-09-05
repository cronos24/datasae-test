@extends('layouts.app')

@section('template_title')
    Jugadores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <jugadores-component :jugadores="{{ json_encode($jugadores) }}"></jugadores-component>                
            </div>
        </div>
    </div>
@endsection
