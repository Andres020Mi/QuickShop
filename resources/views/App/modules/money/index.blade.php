@extends('App.layouts.app')

@section('title')
    Cartera
@endsection

@section('links_css_js')
    <link rel="stylesheet" href="{{asset('resources/App/modules/money/style.css')}}">
@endsection

@section('content')
    <div class="contenido">
        <div class="card">
            <form name="retirar" action="{{route('withdraw_money')}}" method="post" class="retirar">
                @csrf
                @method("POST")
                <input type="number" step="0.01" min="10" max="1000" name="cantidad" required>
                <input type="submit" value="Retirar dinero">
            </form>

            <form name="agregar" action="{{route('deposit_money')}}" method="post" class="agregar">
                @csrf
                @method("POST")
                <input type="number" step="0.01" min="10" max="1000" name="cantidad" required>
                <input type="submit" value="Agregar dinero">
            </form>
        </div>
    </div>
@endsection
