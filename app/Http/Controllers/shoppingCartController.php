<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
