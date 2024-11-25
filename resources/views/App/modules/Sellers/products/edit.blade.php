@extends('App.layouts.app')

@section('title')
    Editar product
@endsection


@section('links_css_js')
    <link rel="stylesheet" href="{{ asset('resources/App/modules/sellers/products/formulario_create.css') }}">
@endsection

@section('content')
    <div class="contenido">

        <h2>Formulario de Producto</h2>
       
        <a href="{{ route('seller.products.index') }}">Cancelar</a>
        <form action="{{ route('seller.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method("put")
            <input hidden type="text" name="user_id" value="{{ Auth::User()->id }}">

            <div class="informacion_producto">


                <label for="category_id">Categoría:</label>
                <select name="category_id" id="category_id" required>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    
                    @endforeach
                </select>


                <label for="name">Nombre del Producto:</label>
                <input type="text" name="name" id="name" value="{{$product->name}}" required>

                <label for="description">Descripción:</label>
                <textarea name="description" id="description" required>{{$product->description}}</textarea>

                <label for="price">Precio:</label>
                <input type="number" name="price" id="price" value="{{$product->price}}"  step="0.01" required>

                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" value="{{$product->stock}}"  required>


            </div>


            <div class="foto_produco">
                <label for="image"><svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960"
                        width="48px" fill="#FFFFFF">
                        <path
                            d="M480-480ZM180-120q-24 0-42-18t-18-42v-600q0-24 18-42t42-18h365v60H180v600h600v-365h60v365q0 24-18 42t-42 18H180Zm60-162h480L576-474 449-307l-94-124-115 149Zm453-323v-87h-88v-60h88v-88h60v88h87v60h-87v87h-60Z" />
                    </svg>
                    
                </label>
                <input hidden type="file" name="image" id="image" accept="image/*" value="{{$image[0]->image_path}}">

           
                <img id="preview-image" name="image" src="{{ asset('storage/' . $image[0]->image_path ) }}" alt="Vista previa de la imagen">
                

            </div>  



            <button type="submit">Editar Producto</button>
        </form>
    </div>

    

    <script>


        document.getElementById('image').addEventListener('change', function(event) {
            const preview = document.getElementById('preview-image');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
    
@endsection
