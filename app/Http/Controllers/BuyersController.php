<?php

namespace App\Http\Controllers;

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
      
        
        
        return view("App.modules.Buyers.index",compact("products","categories"));
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
