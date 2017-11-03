<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(Categories $category){
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(!hasPermission('add_product', true)) return redirect('categories');
        return view('categories.create');
    }

}
