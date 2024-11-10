@extends("App.layouts.app")

@section("title")
    Seller
@endsection

@section("links_css_js")
    <link rel="stylesheet" href="{{asset('resources/App/modules/sellers/index/index.css')}}">
@endsection

@section("content")
<div class="contenido">
    <h2>Tus productos</h2>
    <a href="{{route("seller.products.create")}}">Crear producto</a>

<div class="products">

    @forelse ( $products_user as $product)
    {{$product}}
    <img src="{{asset(' /'. $product->image_path)}}" alt="a">
    @empty
        <p>No se encontraron productos</p>
    @endforelse

    
    
@endsection