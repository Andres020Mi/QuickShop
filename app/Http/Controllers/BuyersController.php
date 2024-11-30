<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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

// -----------------------------------------------------------------------------------

public function getPurchaseHistory()
{
    // Obtener el usuario con sus órdenes, ítems de órdenes, productos y sus imágenes
    $user = User::with(['orders.orderItems.product.productImages'])->findOrFail(auth()->id());
    
    // Mapear el historial de compras
    $purchaseHistory = $user->orders->map(function ($order) {
        return [
            'order_id' => $order->id,
            'status' => $order->status,
            'total' => $order->total,
            'created_at' => $order->created_at,
            'items' => $order->orderItems->map(function ($item) {
                return [
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'images' => $item->product->productImages->map(function ($image) {
                        return $image->image_path; // Ruta de la imagen
                    }),
                ];
            }),
        ];
    });

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

    // return $purchaseHistory;

    // Retornar datos a la vista
    return view("App.modules.Buyers.cartShop.index", compact('user', 'purchaseHistory', 'cartProducts', 'precioTotal', 'cart_count'));
}
}
