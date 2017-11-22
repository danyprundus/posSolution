<div class="main_rt_rt flt_rt">

    <div class="main_bk_in">
        <div class="main_bk main_bk_adjst">
            <div class="bk_one bk_one1 text-cen1">
                <a><b>{{trans('ro_frontend.nume')}} {{ucfirst(strtolower(trans('ro_frontend.produs')))}}</b>
                    {{trans('ro_frontend.nume')}} {{trans('ro_frontend.categorie')}} / {{trans('ro_frontend.cod_de_bare')}}</a>
            </div>
            <div class="bk_one bk_one2">
                <a><b>{{trans('ro_frontend.cantitate')}}</b>({{trans('ro_frontend.unitate_masura')}})</a>
            </div>
            <div class="bk_one bk_one3">
                <a><b>{{trans('ro_frontend.pret')}}</b>({{trans('ro_frontend.tva')}})</a>
            </div>
            <div class="bk_one bk_one4">
                <a><b>{{trans('ro_frontend.valoare')}}</b>({{trans('ro_frontend.tva')}})</a>
            </div>
            <div class="bk_one bk_one5 border_in">
                <a href="#"><img src="{{ asset('assets/img/delete_img.png') }}" alt="img"></a>
            </div>
        </div>
        <div class="scroll mCustomScrollbar" id="billProductList">
        </div>
    </div>
    <div class="main_rt_bt">
        <div class="bt_rt_lt flt_lt">
            <ul>
                <li><a href="#">{{trans('ro_frontend.nr_produse')}} : <b> 1</b></a></li>
                <li><a href="#">{{trans('ro_frontend.cui')}} :<b> RO 34052721</b></a></li>
                <li><a href="#">{{trans('ro_frontend.client')}} :<b> Stefan Alexandru</b></a></li>
                <li class="no_bor"><a href="#">{{trans('ro_frontend.puncte_fidelitate')}} :<b> 65 </b></a></li>
            </ul>
        </div>
        <div class="bt_rt_rt flt_rt" id="billCalculations">
        </div>
        <div  class="clear"></div>
    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>