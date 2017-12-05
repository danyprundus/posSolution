@php
    $c = true
@endphp
        @if(is_null($results))

        @else
            @foreach($results as $item)

        <div class="main_bk main_bk1 {{(($c = !$c)?'col_bg':'')}}" >
            <div class="bk_one bk_one1 text-cen1">
                <b class="col_in">{{$item['name']}}</b>

            </div>
            <div class="bk_one bk_one2">
                <b>{{$item['category']}}</b>
            </div>
            <div class="bk_one bk_one3">
                <b class="text-cen1 col_in">{{$item['price']}}</b>
            </div>
            <div class="bk_one bk_one4 border_in">
                <b class="col_in">{{$item['qty']}}</b>
            </div>
        </div>
@endforeach
@endif
