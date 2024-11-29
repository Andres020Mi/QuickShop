<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BuyersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        
        // Obtener todas las categorias
        $categories = Category::all();
       

        $categoryIdUrl = request()->query("c");
        

        if($categoryIdUrl){
            $products = Product::where("category_id",$categoryIdUrl)->with('productImages')->get(); 
        } else{
            $products = Product::where("category_id",1)->with('productImages')->get();
        }
      
        
        $List_products_shop = Session::get('List_products_shop', []);
        $cart_count = count($List_products_shop);
        // Crear un array con los productos y sus imagenes para poder colocar eso en el listado de carrito de compras
        if ($cart_count > 0) {
            $cartProducts = Product::whereIn('id', $List_products_shop)
                ->with('productImages') // Obtener imágenes asociadas
                ->get();
        }else{
            $cartProducts = [];     
            $cart_count = 0;  
        }

        $precioTotal = 0;
        foreach($cartProducts as $product){
            $precioTotal+=$product->price;
        }
        
        return view("App.modules.Buyers.index",compact("products","categories","cart_count","cartProducts","precioTotal"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
