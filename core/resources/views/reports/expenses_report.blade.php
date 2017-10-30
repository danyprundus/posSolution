<script type="text/javascript">
    $(function() {
        $('.date').pikaday({ firstDay: 1, format:'YYYY-MM-DD', autoclose:true });
        $(".date").pikaday({ firstDay: 1, format:'YYYY-MM-DD', autoclose:true });
        $('.datatable').DataTable({
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            "bLengthChange": false,
            "bInfo" : false,
            "filter" : true,
            "oLanguage": { "sSearch": ""}
        });
        $('div.dataTables_filter input').addClass('form-control input-sm');
    });
</script>
<div class="col-md-3">
    <div class="form-group">
        {!! Form::label('category', trans('application.category')) !!}
        {!! Form::select('category',$categories,null, ['class' => 'form-control input-sm chosen', 'id' => 'category', 'required']) !!}
    </div>
</div>

<div class="col-md-3">
    <label>{{ trans('application.from') }} : </label>
    <div class="form-group input-group">
        <input class="form-control input-sm date" size="16" type="text" name="from_date" readonly id="from_date"/>
        <span class="input-group-addon input-sm add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
    </div>
</div>

<div class="col-md-3">
    <label>{{ trans('application.to') }} : </label>
    <div class="form-group input-group" style="margin-left:0;">
        <input class="form-control input-sm date" size="16" type="text" name="to_date" readonly id="to_date"/>
        <span class="input-group-addon input-sm add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
    </div>
</div>
<div class="col-md-3">
    <label> </label>
    <div class="form-group">
        <a href="javascript: void(0);" onclick="javascript: expenses_report();" class="btn btn-large btn-sm btn-success"  style="margin:6px"><i class="fa fa-check"></i> {{ trans('application.generate_report') }}</a>
    </div>
</div>

<div class="col-md-12">
    <table class="table datatable dataTable table-bordered">
        <thead>
        <tr class="table_header">
            <th>{{trans('application.name')}}</th>
            <th>{{trans('application.date')}}</th>
            <th>{{trans('application.category')}}</th>
            <th>{{trans('application.amount')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->name }} </td>
                <td>{{ $expense->expense_date }} </td>
                <td>{{ $expense->category }} </td>
                <td>{{ format_amount($expense->amount) }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>