@extends('App.layouts.app')

@section('title')
    Seller
@endsection

@section('links_css_js')
    <link rel="stylesheet" href="{{ asset('resources/App/modules/sellers/index/index.css') }}">
@endsection

@section('content')
    <div class="contenido">
        <h2>Tus productos</h2>
        <a href="{{ route('seller.products.create') }}">Crear producto</a>

        <div class="table">
            <div class="row primal">

                <div class="col">
                    ID
                </div>

                <div class="col">
                    Categoria
                </div>

                <div class="col">
                    Nombre
                </div>


                <div class="col">
                    Descripcion
                </div>


                <div class="col">
                    Precio
                </div>

                <div class="col">
                    stock
                </div>

                <div class="col">
                    Img
                </div>

                <div class="col">
                    Acciones
                </div>

            </div>
            <div class="product">

                @forelse ($products_user as $product)
                <div class="row">
                    <div class="col">
                        <p>
                            {{ $product->id }}
                        </p>
                    </div>

                    
                <div class="col">
                    
                    @foreach ($categories as $caregory )
                
                        @if ($caregory->id == $product->category_id)
                            {{$caregory->name}}
                      
                            @endif
                           
                    @endforeach 
                </div>
                    <div class="col">
                        <p>
                            {{ $product->name }}
                        </p>
                    </div>


                    <div class="col">
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>


                    <div class="col">
                        <p>
                            {{ $product->price }}
                        </p>
                    </div>

                    <div class="col">
                        <p>
                            {{ $product->stock }}
                        </p>
                    </div>

                    <div class="col">
                        @if ($product->productImages->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->productImages[0]->image_path) }}"
                                alt="Imagen del producto">
                        @else
                            <p>Este producto no tiene imágenes</p>
                        @endif

                    </div>

                    
                    <div class="col action">
                        
                        <div class="delete">
                            <form action="{{route('seller.products.delete',$product->id)}}" method="post">
                                @csrf
                                @method("delete")
                                <input type="submit" value="Eliminar">
                            </form>
                        </div>

                        

                        <div class="edit">
                            <form action="{{route('seller.products.edit',$product->id)}}" method="post">
                                @csrf
                                @method("post")
                                <input type="submit" value="Editar">
                            </form>
                        </div>

                    </div>
                      
                </div>


            @empty
                <p>No se encontraron productos</p>
            @endforelse
            </div>
        </div>
    @endsection
