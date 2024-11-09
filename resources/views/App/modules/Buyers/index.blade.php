@extends("App.layouts.app")

@section("title")
    QuickShop
@endsection
    
@section("links_css_js")
    {{-- recursos para la parte basica de la interfas compradores  --}}
    <link rel="stylesheet" href="{{asset('resources/App/modules/buyers/buyers.css')}}">
    {{-- recuross para los prodcutos --}}
    <link rel="stylesheet" href="{{asset('resources/App/components/products/products.css')}}">
    {{-- recursos pra las categorias --}}
    <link rel="stylesheet" href="{{asset('resources/App/components/categories/categories.css')}}">
@endsection

@section("content")
    <div class="content">

        {{-- categorias --}}
        @include("App.components.categories.categories")
        {{-- productos --}}
        @include("App.components.products.products")
    </div>
@endsection