@extends('movil')

@section('extra-css')

@stop

@section('contenido')

    @foreach($ofertas as $oferta)
        <p>{{$oferta->oferta}}</p>
    @endforeach

@stop