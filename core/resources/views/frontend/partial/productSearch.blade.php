<!--capta_bk start-->
<div class="cauta_in">
    <div class="cauta_lt flt_lt">
        <input type="text" name="productName"  id="productName" placeholder="{{trans('ro_frontend.cauta')}}">
        <input type="hidden" name="productID"  id="productID" >
        <span><a href="# "><img src="{{ asset('assets/img/capta.png') }}" alt="img"></a></span>
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