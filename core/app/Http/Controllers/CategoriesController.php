<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(Categories $category)
    {
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
        if (!hasPermission('add_product', true)) {
            return redirect('categories');
        }
        return view('categories.create');
    }

    public function importCSV()
    {
        if (($handle = fopen('public/1.csv', 'r')) !== false) {
            $allintests = [];
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if (!Categories::where('name', $data[0])->exists()) {
                    $inventory = new Categories();
                    $inventory->name = $data [0];
                    $inventory->save();

                }
            }
        }

        fclose($handle);
    }

}
