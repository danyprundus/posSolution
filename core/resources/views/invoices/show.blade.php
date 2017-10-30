@extends('app')

@section('content')
<div class="col-md-12 content-header" >
    <h1><i class="fa fa-quote-left"></i> {{trans('application.invoices')}}</h1>
</div>
<section class="content">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="row">
                    <div class="col-md-6" style="width:1035px;margin-left:20px"><br/>
                    @if (Session::has('flash_notification.message')) {!! message() !!} @endif
                    <a href="{{ route('invoices.index') }}" class="btn btn-info btn-xs"> <i class="fa fa-chevron-left"></i> {{trans('application.back')}}</a>
                    @if(hasPermission('send_invoice'))
                        <a href="{{ url('invoices/send', $invoice->uuid) }}" class="btn btn-success btn-xs pull-right" style="margin-left: 5px"> <i class="fa fa-share"></i> {{trans('application.send')}}</a>
                    @endif
                    <a href="{{ url('invoices/pdf', $invoice->uuid) }}" target="_blank" class="btn btn-primary btn-xs pull-right" style="margin-left: 5px"> <i class="fa fa-download"></i> {{trans('application.download')}}</a>
                    @if(hasPermission('edit_invoice'))
                        <a href="{{ route('invoices.edit', $invoice->uuid) }}" class="btn btn-warning btn-xs pull-right" > <i class="fa fa-pencil"></i> {{trans('application.edit')}}</a>
                    @endif
                </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="invoice">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="panel-body">
                                        @if($invoiceSettings && $invoiceSettings->logo != '')
                                        <img src="{{ asset('assets/img/'.$invoiceSettings->logo) }}" alt="logo" width="100%"/>
                                        @endif
                                     </div>
                                </div>
                                <div class="col-md-9 text-right">
                                    <div class="panel-body">
                                        <div class="col-xs-12 text-right"> <h1>{{trans('application.invoice')}}</h1></div>
                                        <div class="col-xs-9 text-right invoice_title">{{trans('application.reference')}}</div>
                                        <div class="col-xs-3 text-right">{{ $invoice->number }}</div>
                                        <div class="col-xs-9 text-right invoice_title">{{trans('application.date')}}</div>
                                        <div class="col-xs-3 text-right">{{ $settings ? date($settings->date_format, strtotime($invoice->invoice_date)) : $invoice->invoice_date }}</div>
                                        <div class="col-xs-9 text-right invoice_title">{{trans('application.due_date')}}</div>
                                        <div class="col-xs-3 text-right">{{ $settings ? date($settings->date_format, strtotime($invoice->due_date)) : $invoice->due_date }}</div>
                                        @if($settings && $settings->vat != '')
                                        <div class="col-xs-9 text-right invoice_title">{{trans('application.vat_number')}}</div>
                                        <div class="col-xs-3 text-right">{{ $settings ? $settings->vat : '' }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                        <div class="panel-body">
                                            <h4 class="invoice_title">{{trans('application.our_information')}}</h4><hr class="separator"/>
                                            @if($settings)
                                            <h4>{{ $settings->name }}</h4>
                                            {{ $settings->address1 ? $settings->address1.',' : '' }} {{ $settings->state ? $settings->state : '' }}<br/>
                                            {{ $settings->city ? $settings->city.',' : '' }} {{ $settings->postal_code ? $settings->postal_code.','  : ''  }}<br/>
                                            {{ $settings->country }}<br/>
                                            {{trans('application.phone')}}: {{ $settings->phone }}<br/>
                                            {{trans('application.email')}}: {{ $settings->email }}.
                                            @endif
                                        </div>
                                </div>
                                <div class="col-xs-6">
                                        <div class="panel-body">
                                            <h4 class="invoice_title">{{trans('application.billing_to')}} </h4><hr class="separator"/>
                                            <h4>{{ $invoice->client->name }}</h4>
                                            {{ $invoice->client->address1 ? $invoice->client->address1.',' : '' }} {{ $invoice->client->state ? $invoice->client->state : '' }}<br/>
                                            {{ $invoice->client->city ? $invoice->client->city.',' : '' }} {{ $invoice->client->postal_code ? $invoice->client->postal_code.','  : ''  }}<br/>
                                            {{ $invoice->client->country }}<br/>
                                            {{trans('application.phone')}}: {{ $invoice->client->phone }}<br/>
                                            {{trans('application.email')}}: {{ $invoice->client->email }}.
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <table class="table">
                                <thead style="margin-bottom:30px;background: #2e3e4e;color: #fff;">
                                <tr>
                                    <th style="width:50%">{{trans('application.product')}}</th>
                                    <th style="width:10%" class="text-center">{{trans('application.quantity')}}</th>
                                    <th style="width:15%" class="text-right">{{trans('application.price')}}</th>
                                    <th style="width:10%" class="text-center">{{trans('application.tax')}}</th>
                                    <th style="width:15%" class="text-right">{{trans('application.total')}}</th>
                                </tr>
                                </thead>
                                <tbody id="items">
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td><b>{!! $item->item_name !!}</b><br/>{!! $item->item_description !!}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right">{{ format_amount($item->price) }}</td>
                                    <td class="text-center">{{ $item->tax ? $item->tax->value.'%' : '' }}</td>
                                    <td class="text-right">{{ format_amount($invoice->totals[$item->uuid]['itemTotal']) }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div><!-- /.col -->

                            <div class="col-md-6" style="padding: 7% 12% 0 15%; text-transform: uppercase">
                              <div class="{{ $invoice->status == 2 ? 'invoice_status_paid' : 'invoice_status_cancelled' }}">
                                    {{ statuses()[$invoice->status]['label']  }}
                            </div>

                            </div><!-- /.col -->
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th style="width:50%">{{trans('application.subtotal')}}</th>
                                            <td class="text-right">
                                                <span id="subTotal">{{ $invoice->currency.' '.format_amount($invoice->totals['subTotal']) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{trans('application.tax')}}</th>
                                            <td class="text-right">
                                                <span id="taxTotal">{{ $invoice->currency.' '.format_amount($invoice->totals['taxTotal']) }}</span>
                                            </td>
                                        </tr>
                                        @if($invoice->totals['discount'] > 0)
                                        <tr>
                                            <th>{{trans('application.discount')}}</th>
                                            <td class="text-right">
                                                <span id="taxTotal">{{ $invoice->currency.' '.format_amount($invoice->totals['discount']) }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>{{trans('application.total')}}</th>
                                            <td class="text-right">
                                                <span id="grandTotal">{{ $invoice->currency.' '.format_amount($invoice->totals['grandTotal']) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{trans('application.paid')}}</th>
                                            <td class="text-right">
                                                <span id="grandTotal">{{ $invoice->currency.' '.format_amount($invoice->totals['paidFormatted']) }}</span>
                                            </td>
                                        </tr>
                                        <tr class="amount_due">
                                            <th>{{trans('application.amount_due')}}:</th>
                                            <td class="text-right">
                                                <span id="grandTotal">{{ $invoice->currency.' '.format_amount($invoice->totals['amountDue']) }}</span>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </div>
                            </div><!-- /.col -->

                            <div class="col-md-12">
                                @if($invoice->notes)
                                <h4 class="invoice_title">{{trans('application.notes')}}</h4><hr class="separator"/>
                                {!! e($invoice->notes) !!} <br/><br/>
                                @endif
                                @if($invoice->terms)
                                <h4 class="invoice_title">{{trans('application.terms')}}</h4><hr class="separator"/>
                                {!! $invoice->terms !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="cleafix"></div>
    </div>
</section>

@endsection


