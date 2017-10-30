<?php namespace App\Http\Controllers;

use App\Http\Requests\ExpenseFormRequest;
use App\Invoicer\Repositories\Contracts\ExpenseInterface as Expense;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class ExpensesController extends Controller {

    private $expense;

    public function __construct(Expense $expense){
        $this->expense = $expense;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $expenses = $this->expense->all();
		return view('expenses.index', compact('expenses'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if(!hasPermission('add_expense', true)) return redirect('expenses');
		return view('expenses.create');
	}
    /**
     * Store a newly created resource in storage.
     * @param ExpenseFormRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(ExpenseFormRequest $request)
	{
        if($this->expense->create($request->all())){
            Flash::success(trans('application.record_created'));
            return Response::json(array('success'=>true, 'msg' => trans('application.record_created')), 201);
        }
        return Response::json(array('success'=>false, 'msg' => trans('application.record_creation_failed')), 422);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if(!hasPermission('edit_expense', true)) return redirect('expenses');
        $expense = $this->expense->getById($id);
        return view('expenses.edit', compact('expense'));
	}
    /**
     *  Update the specified resource in storage.
     * @param ExpenseFormRequest $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(ExpenseFormRequest $request, $id)
	{
        if($this->expense->updateById($id,$request->all())){
            Flash::success(trans('application.record_updated'));
            return Response::json(array('success'=>true, 'msg' => trans('application.record_updated')), 201);
        }
        return Response::json(array('success'=>false, 'msg' => trans('application.record_update_failed')), 422);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(!hasPermission('delete_expense', true)) return redirect('expenses');
        if($this->expense->deleteById($id))
            Flash::success(trans('application.record_deleted'));
        else
            Flash::error(trans('application.record_deletion_failed'));
        return redirect('expenses');
	}
}
