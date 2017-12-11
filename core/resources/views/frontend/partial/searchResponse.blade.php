<div class="main_bk_in">
    <div class="main_bk main_bk_adjst main_bk_adjst1">
        <div class="bk_one bk_one1 text-cen1">
            <a><b>Nume Produs</b></a>
        </div>
        <div class="bk_one bk_one2">
            <a><b>Departament</b></a>
            <span>Cerere</span>
            <div class="clear"></div>
        </div>
        <div class="bk_one bk_one3">
            <a><b>Pret</b></a>
        </div>
        <div class="bk_one bk_one4 border_in">
            <a><b>Stoc</b></a>
        </div>
    </div>
    <div class="scroll mCustomScrollbar" >

    @if(is_null($results))

        @else
            @php
             $c = true;
            $count = count($results);
            @endphp
            @foreach($results as $item)

        <div class="main_bk main_bk1 {{(($c = !$c)?'col_bg':'')}} " onclick="addProductToBillbyUUID('{{$item["id"]}}')" >
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
            @if($count <15)
                @for($i=1;$i<15-$count;$i++)
                    <div class="main_bk main_bk1 {{(($c = !$c)?'col_bg':'')}} " >
                        <div class="bk_one bk_one1 text-cen1">
                            <b class="col_in">&nbsp</b>

                        </div>
                        <div class="bk_one bk_one2">
                            <b>&nbsp</b>
                        </div>
                        <div class="bk_one bk_one3">
                            <b class="text-cen1 col_in">&nbsp</b>
                        </div>
                        <div class="bk_one bk_one4 border_in">
                            <b class="col_in">&nbsp</b>
                        </div>
                    </div>
                @endfor
            @endif


@endif
    </div>


</div>
