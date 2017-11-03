<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Inventory;
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
          $response = $this->inventory->groupBy('uuid')->get();
        return response()->json(['messages' => $response],200);
    }

}
