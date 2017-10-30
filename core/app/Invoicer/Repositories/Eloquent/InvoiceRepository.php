<?php namespace App\Invoicer\Repositories\Eloquent;

use App\Invoicer\Repositories\Contracts\InvoiceInterface;

class InvoiceRepository extends BaseRepository implements InvoiceInterface{
    /**
     * @return string
     */

    public function model() {
        return 'App\Models\Invoice';
    }

    /**
     * @return string
     */

    public function generateInvoiceNum($start = 0){
        $invoice = $this->model();
        $last = $invoice::orderBy('increment_num', 'desc')->first();

        if($last){
            $next_id = $last->increment_num+1;
        }else{
            $next_id = $start;
        }
        return $start != $next_id ? $start : $next_id;
    }

    public function next_increment_num(){
        $invoice = $this->model();
        $last = $invoice::orderBy('increment_num', 'desc')->first();
        if($last){
            $next_id = $last->increment_num+1;
        }else{
            $next_id = 1;
        }
        return $next_id;
    }

    /**
     * @param $id
     * @return array
     */
    public function invoiceTotals($uuid){
        $invoice = $this->with('items', 'payments')->getById($uuid);
        $items = $invoice->items;
        $payments =  $invoice->payments;

        $totals     = array();
        $subTotal   = 0;
        $taxTotal   = 0;
        $paid       = 0;
        $discount    = $invoice->discount;
        foreach($items as $item){
            $tax = $item->tax;
            $itemTotal = $item->quantity * $item->price;
            $itemTax = $tax ? $itemTotal * $tax->value/100 : 0;
            $totals[$item->uuid]['itemTotal'] = $itemTotal;
            $totals[$item->uuid]['tax']       = $itemTax ;
            $subTotal += $itemTotal;
            $taxTotal += $itemTax;
        }
        foreach($payments as $payment){
            $paid += $payment->amount;
        }

        $totals['subTotal']         = $subTotal;
        $totals['taxTotal']         = $taxTotal;
        $totals['discount']         = $discount > 0 ? $discount : 0 ;
        $totals['paidFormatted']    = $paid;
        $totals['paid']             = $paid;
        $totals['grandTotalUnformatted'] = $subTotal + $taxTotal - $discount;
        $totals['grandTotal']       = $subTotal + $taxTotal - $discount;
        $totals['amountDue']        = $subTotal + $taxTotal - $discount - $paid;

       return $totals;
    }

    /**
     * @return int|mixed
     */
    public function totalUnpaidAmount(){
        $invoices = $this->all();
        $unpaidTotal = 0;
        foreach($invoices as $invoice){
            $invoiceTotals = $this->invoiceTotals($invoice->uuid);
            $unpaidTotal += str_replace(',','',$invoiceTotals['amountDue']);
        }
        return $unpaidTotal;
    }

    /**
     * @return array
     */
    public function ajaxSearch(){
        $term = \Input::get('data')['q'];
        $invoices = $this->where('number', '%'.$term.'%','LIKE')->with('client')->get();
        $results = array();
        foreach($invoices as $invoice){
            $totals  = $this->invoiceTotals($invoice->uuid);
            $record = [
                'id'     => $invoice->uuid,
                'text'   => $invoice->number.' ('.$invoice->currency.$totals['grandTotal'].') - '.strtoupper($invoice->client->name)
            ];
            array_push($results, $record);
        }
        return $results;
    }

    /**
     * @param $id
     */

    public function changeStatus($id){
        $invoice = $this->with('items', 'payments')->getById($id);
        $items = $invoice->items;
        $payments =  $invoice->payments;

        $totals     = array();
        $subTotal   = 0;
        $taxTotal   = 0;
        $paid       = 0;
        $discount    = $invoice->discount;
        foreach($items as $item){
            $tax = $item->tax;
            $itemTotal = $item->quantity * $item->price;
            $itemTax = $tax ? $itemTotal * $tax->value/100 : 0;
            $totals[$item->uuid]['itemTotal'] = number_format($itemTotal,2);
            $totals[$item->uuid]['tax']       = $itemTax ;
            $subTotal += $itemTotal;
            $taxTotal += $itemTax;
        }
        foreach($payments as $payment){
            $paid += $payment->amount;
        }
        $grandTotal = $subTotal + $taxTotal - $discount;
        $amountDue = $subTotal + $taxTotal - $discount - $paid;

        $due_date = new \DateTime($invoice->due_date);
        $today = new \DateTime();

        if($paid <= 0){ //invoice is unpaid
            $status = getStatus('status', 'unpaid');
        }
        elseif($paid > 0 && $paid < $grandTotal && $amountDue > 0 && $due_date > $today){// Invoice is partially paid
            $status =  getStatus('status', 'partially_paid');
        }
        elseif($paid >= $grandTotal && $amountDue <= 0){//Invoice is fully paid
            $status =  getStatus('status', 'paid');
        }
        elseif(($paid <= 0 || $paid > 0 && $paid < $grandTotal && $amountDue > 0) && $due_date < $today  ){//Invoice is overdue
            $status =  getStatus('status', 'overdue');
        }
        else{
            $status =  getStatus('status', 'unpaid');
        }
        $this->updateById($id, array('status' => $status));
    }
}