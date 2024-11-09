<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    {{-- Estilos para reseterar los estilos de la aplicacion --}}
    <link rel="stylesheet" href="{{asset('resources/App/css/reset.css')}}">
    {{-- Estilos para la nevegación --}}
    <link rel="stylesheet" href="{{asset('resources/App/components/nav/nav.css')}}">
    {{-- script para la navegación --}}
    <script src="{{asset('resources/App/components/nav/nav.js')}}" defer></script>
    @yield("links_css_js")
</head>
<body>
    
    {{-- Navegacióon que se mostrara en todas las paginas --}}
    @include("App.components.nav.nav")
    <main>
        @yield("content")
    </main>
</body>
</html>