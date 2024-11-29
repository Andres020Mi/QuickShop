<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;

class moneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        
        return view("App.modules.money.index",compact("cartProducts","cart_count","precioTotal"));
    }


    public function deposit_money(Request $request)
    {
        
        $money = $request->cantidad;
        $user =  User::find(auth()->id());
        $user->money = $user->money + $money;
        $user->save();
        $user =  User::find(auth()->id());
        return redirect()->route("buyers.index");
    }

    
    public function withdraw_money(Request $request)
    {
        $money = $request->cantidad;
        $user =  User::find(auth()->id());
         if($user->money - $money < 0 ){
            
            return redirect()->route("buyers.index");
         } 
         $user->money = $user->money - $money;
         $user->save();
        $user =  User::find(auth()->id());
        return redirect()->route("buyers.index");
        
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
