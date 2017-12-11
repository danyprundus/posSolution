<?php namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Categories;
use Illuminate\Support\Facades\Request;
use App\Invoicer\Repositories\Contracts\ProductInterface as Product;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class ProductsController extends Controller {

    /**
     * @var Product
     */
    private $product;

    /**
     * ProductsController constructor.
     * @param Product $product
     */
    public function __construct(Product $product){
        $this->product = $product;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = $this->product->all();
        return view('products.index', compact('products'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if(!hasPermission('add_product', true)) return redirect('products');
		return view('products.create');
	}
    /**
     * Store a newly created resource in storage.
     * @param ProductFormRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(ProductFormRequest $request)
	{
        $data = array(
                    'code'      => Request::get('code'),
                    'name'      => Request::get('name'),
                    'category'  => Request::get('category'),
                    'description'=> Request::get('description'),
                    'price'      => Request::get('price'),
        );

		if($this->product->create($data)){
            Flash::success(trans('application.record_created'));
            return Response::json(array('success'=>true, 'msg' => trans('application.record_created')), 201);
        }
        return Response::json(array('success'=>false, 'msg' => trans('application.record_creation_failed')), 422);
	}
	/**
	 * Show the form for editing the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if(!hasPermission('edit_product', true)) return redirect('products');
        $product = $this->product->getById($id);
		return view('products.edit', compact('product'));
	}
    /**
     * Update the specified resource in storage.
     * @param ProductFormRequest $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(ProductFormRequest $request, $id)
	{
        $data = array(
            'code'      => Request::get('code'),
            'name'      => Request::get('name'),
            'category'  => Request::get('category'),
            'description'=> Request::get('description'),
            'price'      => Request::get('price'),
        );
		if($this->product->updateById($id,$data)){
            Flash::success('Product has been updated');
            return Response::json(array('success'=>true, 'msg' => trans('application.record_updated')), 201);
        }
        return Response::json(array('success'=>false, 'msg' =>  trans('application.record_update_failed')), 422);
	}
	/**
	 * Remove the specified resource from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(!hasPermission('delete_product', true)) return redirect('products');
		if($this->product->deleteById($id))
            Flash::success(trans('application.record_deleted'));
        else
            Flash::error(trans('application.record_deletion_failed'));

        return redirect('products');
	}
    /**
     * @return \Illuminate\View\View
     */
    public function products_modal(){
        $products = $this->product->all();
        return view('products.products_modal', compact('products'));
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function process_products_selections(){
        $selected = Request::get('products_lookup_ids');
        $products = $this->product->whereIn('uuid', $selected)->get();
        return Response::json(array('success'=>true, 'products' => $products), 200);
    }
    public function importCSV(){
        if (($handle = fopen ('public/products.csv', 'r' )) !== FALSE) {
            while ( ($data = fgetcsv ( $handle, 1000, ';' )) !== FALSE ) {
                $save = array(
                    'code'      => $data [3],
                    'name'      => $data [0],
                    'category'  => Categories::where('name',$data [2])->first()->id,
                    'description'=> '',
                    'price'      => $data [1],
                );
                $this->product->create($save);
        }
            fclose ( $handle );
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function autocomplete(){
        $results = array();
        $term = Request::get('term');
        $queries = \App\Models\Product::where('name','LIKE', '%'.$term.'%')->orderBy('name', 'DESC')->take(13)->get();
       // $queries = $this->product->all();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->uuid, 'name' => $query->name ,'price' => $query->price , 'category' => $query->categoryList->name ,
                'qty' => $query->qty->sum( 'qty' ) ];
        }
        return view('frontend.partial.searchResponse', compact('results'));
        //return Response::json($results);
    }
}
