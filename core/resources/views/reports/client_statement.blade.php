
<div class="col-md-3">
    <div class="form-group">
        <div class="form-group">
            {!! Form::label('client_id', trans('application.client')) !!}
            {!! Form::select('client',$clients,null, ['class' => 'form-control input-sm chosen', 'id' => 'client_id', 'required']) !!}
        </div>
    </div>
</div>

<div class="col-md-3">
    <label> </label>
    <div class="form-group input-group" style="margin-left:0;">
        <a href="javascript: void(0);" onclick="javascript: client_statement();" class="btn btn-sm btn-success pull-right"  style="margin:6px">
            <i class="fa fa-check"></i> {{trans('application.generate_statement')}}
        </a>
    </div>
</div>

<?php if(isset($stats)){ ?>
<div class="row">
    <div class="col-lg-5">
        <table class="table table-bordered tablesorter">
            <thead>
                <tr class="table_header">
                    <th>{{trans('application.client_pending_balance')}}</th>
                </tr>
            </thead>
            <tbody>
            <tr><td class="statistics_cell">
                    <?php $bal_class = ($stats['pending_balance'] > 0) ? 'pending_bal' : 'over_paid'; ?>
                    <span class="<?php echo $bal_class; ?>"><?php echo format_amount($stats['pending_balance']); ?></span>
                </td></tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-5 pull-right">
        <table class="table  table-bordered ">
            <thead>
                <tr class="table_header">
                    <th colspan="2">{{trans('application.client_statistics')}}</th>
                </tr>
            </thead>
            <tbody>
            <tr class="transaction-row">
                <td width="50%">{{trans('application.total_invoiced_amount')}} </td>
                <td><?php echo (isset($stats)) ? format_amount($stats['total_invoiced']) : ''; ?></td>
            </tr>
            <tr class="transaction-row">
                <td>{{trans('application.total_amount_paid')}}</td>
                <td><?php echo (isset($stats)) ? format_amount($stats['total_received']) : ''; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>

<div class="col-md-12">
    <table class="table table-hover table-striped table-bordered datatable">
        <thead>
        <tr class="table_header">
            <th>{{trans('application.date')}} </th>
            <th>{{trans('application.activity')}}</th>
            <th class="text-right">{{trans('application.invoices')}}</th>
            <th class="text-right">{{trans('application.payments')}}</th>
            <th class="text-right">{{trans('application.balance')}}</th>
        </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach($statement as $record)
                <?php $total = ($record['transaction_type'] == 'payment') ? format_amount($total - $record['amount']) : format_amount($total + $record['amount']); ?>
                <tr>
                    <td>{{ $record['date'] }}</td>
                    <td>{{ $record['activity'] }}</td>
                    <td class="text-right text-red text-bold">{{ $record['transaction_type'] != 'payment' ? format_amount($record['amount']) : '' }}</td>
                    <td class="text-right text-bold text-green">{{ $record['transaction_type'] == 'payment' ? format_amount($record['amount']) : '' }}</td>
                    <td class="text-right">{{ $total }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="text-bold">{{ trans('application.total') }}</td>
                <td class="text-right text-bold text-red" colspan="4">{{ format_amount($total) }}</td>
            </tr>
        </tbody>
    </table>
</div>
