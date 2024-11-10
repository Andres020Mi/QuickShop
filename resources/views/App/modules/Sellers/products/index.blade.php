@extends("App.layouts.app")

@section("title")
    Seller
@endsection

@section("links_css_js")
    
@endsection

@section("content")
    <a href="{{route("seller.products.create")}}">Crear producto</a>
@endsection