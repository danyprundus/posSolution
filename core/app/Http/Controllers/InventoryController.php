<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class InventoryController extends Controller
{
    private $inventory;

    public function __construct(Inventory $inventory){
        $this->inventory = $inventory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $inventory = $this->inventory->groupBy('uuid')->get();
        return view('inventory.index', compact('inventory'));
    }
    public function getALL()
    {
        $responses = $this->inventory->groupBy('uuid')->get();
        //print_r($responses);
        $return=array();
        foreach ($responses as $response){

            $return[]['uuid'] = $response->uuid;
            $return[]['name'] = $response->product->name;
            $return[]['category'] = $response->product->categoryList->name;
            $return[]['qty'] = $response->groupBy('uuid')->where('uuid' , '=' , $response->uuid )->sum('qty');
        }
        //$response = $products->all;
        return response()->json(['messages' => $return],200);
    }

}
