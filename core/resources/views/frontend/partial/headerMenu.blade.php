<header>
    <div class="header_in">
        <div class="logo">
            <a href="#"><figure><img src="{{ asset('assets/img/logo.png') }}" alt="img"></figure></a>
        </div>
        <div class="head_lt flt_lt">
            <ul>
                <li><a href="#"><img src="{{ asset('assets/img/menu.png') }}" alt="img"><span>{{trans('ro_frontend.meniu')}}</span></a></li>
                <li><a href="#"><img src="{{ asset('assets/img/translator.png') }}" alt="img"><span>{{trans('ro_frontend.tastatura')}}</span></a></li>
                <li><a href="#"><img src="{{ asset('assets/img/messages.png') }}" alt="img"><span>{{trans('ro_frontend.info_sms')}}</span></a></li>
                <li><a href="#"><img src="{{ asset('assets/img/printer.png') }}" alt="img"><span >{{trans('ro_frontend.conectat')}}</span></a></li>
            </ul>
        </div>
        <div class="head_rt flt_rt">
            <ul>
                <li><a href="#" class="text-right"><img src="{{ asset('assets/img/user_icon.png') }}" alt="img">Adrian.B, Stefan.A<br>{{trans('ro_frontend.gestiune')}}: Iasi, Palas Mall</a></li>
                <li><a href="#"><strong>{{ date('H:i') }}</strong> {{ date('d.m.Y') }}</a></li>
                <li><a href="#"><strong>1</strong>{{trans('ro_frontend.pos_no')}}</a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

</header>