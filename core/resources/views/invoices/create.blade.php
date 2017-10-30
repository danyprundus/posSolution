@extends('app')

@section('content')
<div class="col-md-12 content-header" >
    <h1><i class="fa fa-file-pdf-o"></i> {{ trans('application.invoices') }}</h1>
</div>
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
    <div class="row">
        <div class="col-md-6" style="width:1000px;margin-left:20px"><br/>
            <a href="{{ route('invoices.index') }}" class="btn btn-info btn-xs"> <i class="fa fa-chevron-left"></i> {{ trans('application.back') }}</a>
        </div>
    </div>
<div class="panel-body">
<div class="row">
    <div class="invoice">
        {!! Form::open(['route' => ['invoices.store'], 'id' => 'invoice_form', 'data-toggle'=>"validator", 'role' =>"form"]) !!}
        <div class="col-md-12">
          <div class="text-right"><h1>{{ trans('application.invoice') }}</h1></div>
            <div class="col-md-7" style="padding: 0px">
                <div class="contact to">
                    <div class="form-group">
                    {!! Form::label('client', trans('application.client')) !!}
                        <div class="input-group col-md-7">
                            {!! Form::select('client',$clients,null, ['class' => 'form-control chosen input-sm', 'id' => 'client', 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('currency', trans('application.currency')) !!}
                        <div class="input-group col-md-7">
                            {!! Form::select('currency',$currencies,null, ['class' => 'form-control input-sm chosen', 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('number', trans('application.invoice_number')) !!}
                        <div class="input-group col-md-7">
                            <p>{{ $invoice_num }} <span class="btn btn-warning btn-xs pull-right" id="change_invoice_num">{{ trans('application.change') }}</span></p>
                        {!! Form::text('number',$invoice_num, ['class' => 'form-control input-sm hide', 'id' => 'number', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="padding: 0px">

                <div class="form-group">
                    {!! Form::label('invoice_date', trans('application.date')) !!}
                    {!! Form::text('invoice_date',null, ['class' => 'form-control datepicker input-sm' , 'id' => 'invoice_date', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('due_date', trans('application.due_date')) !!}
                    {!! Form::text('due_date',null, ['class' => 'form-control datepicker input-sm' , 'id' => 'due_date', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', trans('application.status')) !!}
                    <select class="form-control chosen required input-sm" name="status" id="status">
                        @foreach($statuses as $key => $status)
                            <option value="{{ $key }}"> {{ strtoupper($status['label']) }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
    </div>
    <div class="col-md-12">
        <table class="table table-striped" id="item_table">
            <thead class="item-table-header">
            <tr>
                <th width="5%"></th>
                <th width="20%">{{ trans('application.product') }}</th>
                <th width="35%">{{ trans('application.description') }}</th>
                <th width="10%" class="text-center">{{ trans('application.quantity') }}</th>
                <th width="10%" class="text-center">{{ trans('application.price') }}</th>
                <th width="15%" class="text-center">{{ trans('application.tax') }}</th>
                <th width="15%"class="text-right">{{ trans('application.amount') }}</th>
            </tr>
            </thead>
            <tbody>
                <tr class="item">
                    <td></td>
                    <td><div class="form-group">{!! Form::text('item_name',null, ['class' => 'form-control input-sm item_name', 'id'=>"item_name" , 'required']) !!}</div></td>
                    <td><div class="form-group">{!! Form::textarea('item_description',null, ['class' => 'form-control item_description input-sm', 'id'=>"item_description" ,'required', 'rows'=>'1' ]) !!}</div></td>
                    <td><div class="form-group">{!! Form::input('number','quantity',null, ['class' => 'form-control calcEvent quantity input-sm', 'id'=>"quantity" , 'required', 'step' => 'any', 'min' => '1']) !!}</div></td>
                    <td><div class="form-group">{!! Form::input('number','price',null, ['class' => 'form-control calcEvent price input-sm', 'id'=>"price", 'required','step' => 'any', 'min' => '1']) !!}</div></td>
                    <td><div class="form-group">{!! Form::customSelect('tax',$taxes,null, ['class' => 'form-control calcEvent tax input-sm', 'id'=>"tax"]) !!}</div></td>
                    <td class="text-right"><span class="currencySymbol"></span><span class="itemTotal">0.00</span></td>
                </tr>
            </tbody>
        </table>
    </div><!-- /.col -->

    <div class="col-md-6">
        <span id="btn_add_row" class="btn btn-xs btn-info "><i class="fa fa-plus"></i> {{ trans('application.add_row') }}</span>
        <span id="btn_product_list_modal" class="btn btn-xs btn-primary "><i class="fa fa-plus"></i> {{ trans('application.add_from_products') }}</span>
    </div><!-- /.col -->
    <div class="col-md-6">
        <table class="table">
            <tbody>
            <tr>
                <th style="width:50%">{{ trans('application.subtotal') }}</th>
                <td class="text-right">
                    <span class="currencySymbol"></span>
                    <span id="subTotal">0.00</span>
                </td>
            </tr>
            <tr>
                <th>Tax</th>
                <td class="text-right">
                    <span class="currencySymbol"></span>
                    <span id="taxTotal">0.00</span>
                </td>
            </tr>
            <tr>
                <th style="vertical-align: middle">{{ trans('application.discount') }}</th>
                <td class="text-right">
                    <div class="form-group">
                    {!! Form::input('number','discount', null,['class' => 'form-control text-right calcEvent input-sm', 'id' => 'discount', 'step'=>'any', 'min'=>'0']) !!}
                   </div>
                </td>
            </tr>
            <tr class="amount_due">
                <th>{{ trans('application.total') }}:</th>
                <td class="text-right">
                    <span class="currencySymbol"></span>
                    <span id="grandTotal">0.00</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- /.col -->

    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('notes', trans('application.notes')) !!}
            {!! Form::textarea('notes',null, ['class' => 'form-control','rows' =>  '2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('terms', trans('application.terms')) !!}
            {!! Form::textarea('terms',$settings ? $settings->terms : '', ['class' => 'form-control', 'id' => 'invoice_terms', 'rows' =>  '2']) !!}
        </div>
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-xs btn-success pull-right" id="saveInvoice"><i class="fa fa-save"></i> {{ trans('application.save_invoice') }}</button>
    </div>
    {!!  Form::close() !!}
    </div>
    </div>
   </div>
  </div>
 </div>
</div>
</section>
@endsection
@section('scripts')
    @include('invoices.partials._invoices_js')
@endsection

