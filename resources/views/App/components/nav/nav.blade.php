<nav class="navegation">
    {{-- Logo y titulo de la tienda --}}
    <div class="icon_title">
        <a href="{{ route('buyers.index') }}">
            <img src="{{ asset('resources/img_empresa/logo_quickShop.png') }}" alt="Logo de la empresa">
            <h1>QuickShop</h1>
        </a>

    </div>
    <div class="links">
        @auth


            <div class="shop" id="btn_option_shop">
                <span>
                    {{ $cart_count }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#ff832d">
                    <path
                        d="M286.79-81Q257-81 236-102.21t-21-51Q215-183 236.21-204t51-21Q317-225 338-203.79t21 51Q359-123 337.79-102t-51 21Zm400 0Q657-81 636-102.21t-21-51Q615-183 636.21-204t51-21Q717-225 738-203.79t21 51Q759-123 737.79-102t-51 21ZM235-741l110 228h288l125-228H235Zm-30-60h589.07q22.97 0 34.95 21 11.98 21-.02 42L694-495q-11 19-28.56 30.5T627-453H324l-56 104h491v60H277q-42 0-60.5-28t.5-63l64-118-152-322H51v-60h117l37 79Zm140 288h288-288Z" />
                </svg>
            </div>


            <div class="select_option_shop hidden" id="select_option_shop">
                @forelse ($cartProducts as $cartProduct)
                    <div class="option">
                        <div class="name">
                            {{ $cartProduct->name }}
                        </div>
                        <div class="name">
                            ${{ $cartProduct->price }}
                        </div>
                        <div class="img">
                            <img src="{{ asset('storage/' . $cartProduct->productImages[0]->image_path) }}" alt="img">
                        </div>
                        <div class="eliminar">
                            <a href="{{ route('eliminar_cart_shop', ['id' => $cartProduct->id]) }}">Eliminar</a>
                        </div>

                    </div>
                @empty
                    <div class="option">
                        <div class="name">
                            No hay productos
                        </div>
                    </div>
                @endforelse
                @if ($cart_count > 0)
                <div class="option">
                    
                <div class="comprar">
                    <a href="">
                        Comporar
                    </a>
                </div>
                <div class="option">
                    <div class="name">
                        Precio total ${{ $precioTotal }}
                    </div>
                </div>
                </div>
                    
                @endif
            </div>


            <div class="money">
                <a href="{{ route('money.index') }}">
                    <span>${{ Auth::User()->money }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                        fill="#ff832d">
                        <path
                            d="M451-193h55v-52q61-7 95-37.5t34-81.5q0-51-29-83t-98-61q-58-24-84-43t-26-51q0-31 22.5-49t61.5-18q30 0 52 14t37 42l48-23q-17-35-45-55t-66-24v-51h-55v51q-51 7-80.5 37.5T343-602q0 49 30 78t90 54q67 28 92 50.5t25 55.5q0 32-26.5 51.5T487-293q-39 0-69.5-22T375-375l-51 17q21 46 51.5 72.5T451-247v54Zm29 113q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-156t86-127Q252-817 325-848.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82-31.5 155T763-197.5q-54 54.5-127 86T480-80Zm0-60q142 0 241-99.5T820-480q0-142-99-241t-241-99q-141 0-240.5 99T140-480q0 141 99.5 240.5T480-140Zm0-340Z" />
                    </svg>
                </a>
            </div>

            <div class="btn_option_users" id="btn_option_users">

                <span> {{ Auth::User()->name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                    fill="#ff832d">
                    <path
                        d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z" />
                </svg>

            </div>

            <div class="select_option_users hidden" id="select_option_users">


                <div class="option">
                    <a href="">Perfil</a>
                </div>

                @if (Auth::User()->role == 'admin')
                    <div class="option">
                        <a href="">Panel de administrador </a>
                    </div>
                @endif


                @if (Auth::User()->role == 'seller' || Auth::User()->role == 'admin')
                    <div class="option">
                        <a href="{{ route('seller.products.index') }}">Tus productos</a>
                    </div>
                @endif


                <div class="option">
                    <a href="">Compras</a>
                </div>


                <div class="option">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit" value="Cerrar secion">
                    </form>

                </div>

            </div>
        @else
            <div class="login">
                <a href="{{ route('login') }}">
                    <span>Iniciar secion</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                        fill="#ff832d">
                        <path
                            d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z" />
                    </svg>
                </a>
            </div>

        @endauth
    </div>
</nav>
