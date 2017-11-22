<ul>
    <li><a href="#" id="billPlata">{{number_format( $total, 2, ",", "." )}} LEI</a></li>
    <li class="border_in"><a href="#">{{trans('ro_frontend.plata')}}</a></li>
    <li><a href="#" id="billDiscount">-0,00 LEI</a></li>
    <li class="border_in"><a href="#">{{strtoupper(trans('ro_frontend.reducere'))}}</a></li>
    <li><a href="#"><b id="bilTotal">{{number_format( $total, 2, ",", "." )}} LEI</b></a></li>
    <li class="border_in"><a href="#"><strong>{{strtoupper(trans('ro_frontend.total'))}} {{trans('ro_frontend.plata')}}</strong></a></li>
</ul>
<div class="clear"></div>
<div class="btn_bt">
    <a href="javascript:removeProductfromBill('all')" ><img src="{{ asset('assets/img/delete_img.png') }}" alt="img"><span>{{strtoupper( trans('ro_frontend.anulare'))}}<br>{{strtoupper( trans('ro_frontend.bon'))}}BON</span></a>
</div>
