@extends('layouts.app')

@section('template_title')
    Ruletas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <ruletas-component :ruletas="{{ json_encode($ruletas) }}"></ruletas-component>                
            </div>
        </div>
    </div>
@endsection
