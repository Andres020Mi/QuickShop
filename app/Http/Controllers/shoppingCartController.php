<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class shoppingCartController extends Controller
{


    public function addProduct(string $id)
    {
        $ids = Session::get('List_products_shop', []);
        // Agregar el nuevo ID si no está ya en la lista
        if (!in_array($id, $ids)) {
            $ids[] = $id;
            Session::put('List_products_shop', $ids); // Actualizar la sesión
        }

        return redirect()->route("buyers.index");
    }
    /**
     * comprar los productos.
     */
    public function index()
    {

    


        $List_products_shop = Session::get('List_products_shop', []);

        $cart_count = count($List_products_shop);
        if ($cart_count > 0) {
            $cartProducts = Product::whereIn('id', $List_products_shop)
                ->with('productImages') // Obtener imágenes asociadas
                ->get();
        } else {
            $cartProducts = [];
        }



        // Restare el dinero al comprador

        $precioTotal = 0;
        foreach ($cartProducts as $product) {
            $precioTotal += $product->price;
        }

        $user = User::find(auth()->id());
        if($user->money == 0){
            return redirect()->route("buyers.index");
        }

        if($user->money >= $precioTotal){
            
        }else{
            return redirect()->route("buyers.index");
        }



        $user = User::find(auth()->id());
        
            if ($user->money - $precioTotal > -1) {
                $user->money = $user->money - $precioTotal;
                $user->save();
            } else {
               return redirect()->route("buyers.index");
            }
       







        // Crear la orden
        $order = new Order();
        $order->user_id = auth()->id();
        $order->status = "completed";
        $order->total = $precioTotal;

        $order->save(); // Guardar la orden en la base de datos

        // Crear registros en la tabla order_items
        foreach ($cartProducts as $product) {
            OrderItem::create([
                'order_id' => $order->id, // ID de la orden creada
                'product_id' => $product->id, // ID del producto
                'quantity' => 1, // Puedes ajustar esto según tus necesidades
                'price' => $product->price,
            ]);
        }

        foreach ($cartProducts as $product) {
            $product = Product::find($product->id);
            if ($product->stock - 1 > -1) {
                $product->stock = $product->stock - 1;
                $product->save();
            } else {
                return redirect()->route("buyers.index");
            }

            $seller = User::find($product->user_id);
            $seller->money = $seller->money + $product->price;
            $seller->save();
        }

        Session::put('List_products_shop', []);

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
        // Obtener el array actual de la sesión
        $ids = Session::get('List_products_shop', []);

        // Buscar y eliminar el ID del array si existe
        if (($key = array_search($id, $ids)) !== false) {
            unset($ids[$key]); // Eliminar el ID del array
            $ids = array_values($ids); // Reindexar el array
            Session::put('List_products_shop', $ids); // Actualizar la sesión
        }

        return redirect()->route("buyers.index");
    }
}
