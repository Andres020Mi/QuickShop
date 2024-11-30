<div class="products">
    @forelse ($products as $product)
    @if ($product->stock > 0)
    <div class="product">
        <div class="img_start">
            <img id="preview-image" name="image"
                src="{{ asset('storage/' . $product->productImages[0]->image_path) }}" alt="Vista previa de la imagen"
>

        </div>
        <div class="informacion">
            <h3 class="nombre_producto">
                {{ $product->name }}
            </h3>
            <p class="precio">
                $ {{ $product->price }}
            </p>
            <div class="opciones">

                
                <a href="{{route('car_shop',['id'=>$product->id])}}" class="agregar_carrito">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M440-600v-120H320v-80h120v-120h80v120h120v80H520v120h-80ZM280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM40-800v-80h131l170 360h280l156-280h91L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68.5-39t-1.5-79l54-98-144-304H40Z" />
                    </svg>
                </a>
                <a href="" class="mas_informacion">
                  Mas informacion
                </a>
            </div>
        </div>
    </div>
    @endif
   
        
    @empty
        <p>
            No se enocntraron productos en esta categoria
        </p>
    @endforelse
</div>
