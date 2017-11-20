<?php

namespace App\Http\Controllers;

use App\BillProducts;
use Illuminate\Http\Request;

use App\Http\Requests;

class BillProductsController extends Controller
{
    /**
     * @var $billProduct
     */
    private $billProduct;

    /**
     * Bill constructor.
     * @param \App\Models\BillProducts $billProduct
     */
    public function __construct(\App\Models\BillProducts $billProduct){
        $this->billProduct = $billProduct;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string $productUUID
     * @param  int $user
     */
    public function store($productUUID,$user)
    {
        $data = array(
            'productUUID'      => $productUUID,
            'user'      => $user,
        );
        $this->billProduct->create($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return null;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return null;
    }
}
