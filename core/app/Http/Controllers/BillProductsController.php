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
            'user'      => 1,
            'qty'      => 1,
            'IsProcessed'      => false,
        );
        $billProductList=$this->billProduct->where('productUUID', '=' ,$productUUID)->where('user', '=' ,$user)->first();
        if(is_null($billProductList)){
            $this->billProduct->create($data);
        }
        else{
            $billProductList->increment('qty', 1);
            }
    }


    /**
     * @param  integer $user
     * @return \App\Models\BillProducts
     */
    public  static function getBillProductsList($user){
        $billProductsList=\App\Models\BillProducts::where('user', '=' ,$user)->where('isProcessed','=',false)->get();
        return $billProductsList;

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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @param string $uuid
     * @param integer $user
     */
    public function getProductbyUUID( $uuid,$user){
        //store data
        if($uuid <>0){
            $this->store($uuid,$user);
        }
        $buyLists = BillProductsController::getBillProductsList($user);
        return view('frontend.partial.buyListOneItem', compact('buyLists'));
    }

}
