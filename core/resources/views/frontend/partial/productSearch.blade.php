<!--capta_bk start-->
<div class="cauta_in">
    <div class="cauta_lt flt_lt" id="menuWraper">
        <input type="text" name="productName"  id="productName" placeholder="{{trans('ro_frontend.cauta')}}">
        <input type="hidden" name="productID"  id="productID" >
        <span><a href="# " id="resetSearch"><img src="{{ asset('assets/img/capta.png') }}" alt="img"></a></span>
        @yield('buyList')
        <div class="pop_up5" >
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
                <div class="scroll mCustomScrollbar" id="searchResponseScroll">

                </div>


                </div>
        </div>
    </div>
    <div class="cauta_rt flt_rt">
        <ul>
            <li>
                <div class="blk_in">
                    <div class="bk_lt flt_lt">
                        <a href="#"><img src="{{ asset('assets/img/vehicle.png') }}" alt="img"></a>
                    </div>
                    <div class="bk_rt flt_rt">
                        <p>{{trans('ro_frontend.produs')}} {{trans('ro_frontend.nou')}}<br><strong>{{trans('ro_frontend.cerere')}}</strong></p>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <li>
                <div class="blk_in red">
                    <div class="bk_lt flt_lt">
                        <a href="#"><img src="{{ asset('assets/img/van.png') }}" alt="img"></a>
                    </div>
                    <div class="bk_rt flt_rt">
                        <p>{{trans('ro_frontend.produs')}}<br><strong>{{trans('ro_frontend.stricat')}}</strong></p>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<!--capta_bk end-->