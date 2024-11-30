@extends('App.layouts.app')
@section('title')
    Cart Shop
@endsection

@section('links_css_js')
    <link rel="stylesheet" href="{{ asset('resources/App/modules/buyers/comprados.css') }}">
@endsection

@section('content')
    <div class="contenido">
        <h1>Historial de Compras de {{ $user->name }}</h1>

        @if ($purchaseHistory->isEmpty())
            <p>No hay compras registradas.</p>
        @else
            <div class="facturas">

                @foreach ($purchaseHistory as $order)
                    <div class="factura">
                        <div class="cabesera">
                            <div class="numero_orden">
                                Compra N° {{ $order['order_id'] }}
                            </div>
                            <div class="precio_total">
                                Coste total: $ {{ $order['total'] }}
                            </div>
                        </div>
                        <div class="items">

                            @foreach ($order['items'] as $item)
                                <div class="item">
                                    <div class="name">
                                        {{ $item['product_name'] }}
                                    </div>
                                    <div class="price">
                                         ${{ $item['price'] }}
                                    </div>
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $item['images'][0]) }}" alt="" width="50px"
                                            height="50px">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                

            </div>
        @endif
    </div>
@endsection
