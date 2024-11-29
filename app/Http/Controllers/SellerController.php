<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::User()->id;

        // Cargar productos con las imágenes asociadas usando eager loading
        $products_user = Product::where('user_id', $user_id)->with('productImages')->get();
      
        $categories = Category::all();

        $List_products_shop = Session::get('List_products_shop', []);
        $cart_count = count($List_products_shop);
        // Crear un array con los productos y sus imagenes para poder colocar eso en el listado de carrito de compras
        if ($cart_count > 0) {
            $cartProducts = Product::whereIn('id', $List_products_shop)
                ->with('productImages') // Obtener imágenes asociadas
                ->get();
        }else{
            $cartProducts = [];     
              
        }

        
        $precioTotal = 0;
        foreach($cartProducts as $product){
            $precioTotal+=$product->price;
        }

        return view('App.modules.Sellers.products.index', compact('products_user', 'categories',"cartProducts","cart_count","precioTotal"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        $List_products_shop = Session::get('List_products_shop', []);
        $cart_count = count($List_products_shop);
        // Crear un array con los productos y sus imagenes para poder colocar eso en el listado de carrito de compras
        if ($cart_count > 0) {
            $cartProducts = Product::whereIn('id', $List_products_shop)
                ->with('productImages') // Obtener imágenes asociadas
                ->get();
        }else{
            $cartProducts = [];     
              
        }

        $precioTotal = 0;
        foreach($cartProducts as $product){
            $precioTotal+=$product->price;
        }
        return view("App.modules.Sellers.products.create", compact("categories","cartProducts","cart_count","precioTotal"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validación de imagen
        ]);

        // Crear el producto
        $product = Product::create([
            'user_id' => $validated['user_id'],
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ]);

        // Si se ha subido una imagen, procesarla
        if ($request->hasFile('image')) {
            // Subir la imagen al almacenamiento
            $imagePath = $request->file('image')->store('product_images', 'public'); // Guardado en 'storage/app/public/product_images'

            // Guardar la ruta de la imagen en la tabla product_images
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('seller.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $image = ProductImage::where("product_id", $product->id)->get();

        $List_products_shop = Session::get('List_products_shop', []);
        $cart_count = count($List_products_shop);
        // Crear un array con los productos y sus imagenes para poder colocar eso en el listado de carrito de compras
        if ($cart_count > 0) {
            $cartProducts = Product::whereIn('id', $List_products_shop)
                ->with('productImages') // Obtener imágenes asociadas
                ->get();
        }else{
            $cartProducts = [];     
              
        }
        
        $precioTotal = 0;
        foreach($cartProducts as $product){
            $precioTotal+=$product->price;
        }

        return view("App.modules.Sellers.products.edit", compact("categories", "product", "image","cartProducts","cart_count","precioTotal"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos recibidos del formulario

        $product = Product::find($id);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();


          // Si se ha subido una imagen, procesarla
          if ($request->hasFile('image')) {


               // Buscar el producto por ID, incluyendo sus imágenes
        $product = Product::with('productImages')->findOrFail($id);

        // Verificar si el producto pertenece al usuario autenticado
        if ($product->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este producto.');
        }

        // Eliminar las imágenes asociadas
        foreach ($product->productImages as $image) {
            // Eliminar físicamente la imagen del almacenamiento usando unlink
            $imagePath = storage_path('app/public/' . $image->image_path);

            if (file_exists($imagePath)) {
                unlink($imagePath); // Elimina la imagen del sistema de archivos
            }

            // Eliminar la imagen de la base de datos
            $image->delete();
        }


            // Subir la imagen al almacenamiento
            $imagePath = $request->file('image')->store('product_images', 'public'); // Guardado en 'storage/app/public/product_images'

            // Guardar la ruta de la imagen en la tabla product_images
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }


     
      

        return redirect()->route('seller.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el producto por ID, incluyendo sus imágenes
        $product = Product::with('productImages')->findOrFail($id);

        // Verificar si el producto pertenece al usuario autenticado
        if ($product->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este producto.');
        }

        // Eliminar las imágenes asociadas
        foreach ($product->productImages as $image) {
            // Eliminar físicamente la imagen del almacenamiento usando unlink
            $imagePath = storage_path('app/public/' . $image->image_path);

            if (file_exists($imagePath)) {
                unlink($imagePath); // Elimina la imagen del sistema de archivos
            }

            // Eliminar la imagen de la base de datos
            $image->delete();
        }

        // Eliminar el producto
        $product->delete();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('seller.products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
