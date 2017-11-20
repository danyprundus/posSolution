<div class="main_bk main_bk1" id="{{$product->code}}">
    <div class="bk_one bk_one1 text-cen1">
        <a><b>{{$product->name}}<br>{{$product->categoryList->name}} / {{$product->code}}</b>
        </a>
    </div>
    <div class="bk_one bk_one2">
        <a><b class="text-cen">1</b>({{trans('ro_frontend.bucati')}})</a>
    </div>
    <div class="bk_one bk_one3">
        <a><b>{{$product->price}}</b>({{$product->vat}})</a>
    </div>
    <div class="bk_one bk_one4">
        <a><b>{{$product->price}}</b>({{$product->vat}})</a>
    </div>
    <div class="bk_one bk_one5 border_in">
        <a href="javascript:removeProductfromBill('{{$product->code}}')"><img src="{{ asset('assets/img/cross_icon.png') }}" alt="img"></a>
    </div>
</div>