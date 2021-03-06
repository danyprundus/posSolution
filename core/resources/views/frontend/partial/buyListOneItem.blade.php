@if(is_null($buyLists))

@else
    @php
        $c = true;
        $count = count($buyLists);

    @endphp

    @foreach($buyLists as $item)
        <div class="main_bk {{(($c = !$c)?'main_bk1':'main_bk3')}}" id="{{$item->productUUID}}">
            <div class="bk_one bk_one1 text-cen1">
                <a><b>{{$item->product->name}}<br>{{$item->product->categoryList->name}} / {{$item->product->code}}</b>
                </a>
            </div>
            <div class="bk_one bk_one2">
                <a><b class="text-cen">{{$item->qty}}</b>({{trans('ro_frontend.bucati')}})</a>
            </div>
            <div class="bk_one bk_one3">
                <a><b>{{number_format( $item->product->price, 2, ",", "." )}}</b>({{number_format( $item->product->vat, 2, ",", "." )}})</a>
            </div>
            <div class="bk_one bk_one4">
                <a><b>{{number_format( $item->product->price, 2, ",", "." )}}</b>({{number_format( $item->product->vat, 2, ",", "." )}})</a>
            </div>
            <div class="bk_one bk_one5 border_in">
                <a href="javascript:removeProductfromBill('{{$item->productUUID}}')"><img src="{{ asset('assets/img/cross_icon.png') }}" alt="img"></a>
            </div>
        </div>
    @endforeach
    @if($count <15)
        @for($i=1;$i<13-$count;$i++)
            <div class="main_bk {{(($c = !$c)?'main_bk1':'main_bk3')}}" >
                <div class="bk_one bk_one1 text-cen1">
                    <a><b>&nbsp;</b>
                    </a>
                </div>
                <div class="bk_one bk_one2">
                    <a><b class="text-cen">&nbsp;</b></a>
                </div>
                <div class="bk_one bk_one3">
                    <a><b>&nbsp;</b></a>
                </div>
                <div class="bk_one bk_one4">
                    <a><b>&nbsp;</b></a>
                </div>
                <div class="bk_one bk_one5 border_in">
                    &nbsp;
                </div>
            </div>
        @endfor
    @endif


@endif
