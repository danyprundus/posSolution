@extends('app')

@section('content')
    <div class="col-md-12 content-header" >
        <h1><i class="fa fa-cogs"></i> {{trans('application.system_settings')}}</h1>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                @include('settings.partials._menu')
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body">
                        @if (count($errors) > 0)
                            {!! form_errors($errors) !!}
                        @endif
                        @if($setting)
                            {!! Form::model($setting, ['route' => ['settings.email.update', $setting->uuid], 'method'=>'PATCH']) !!}
                        @else
                            {!! Form::open(['route' => ['settings.email.store']]) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('protocol', trans('application.protocol')) !!}
                            {!! Form::select('protocol',array('smtp'=>'SMTP','php_mail'=>'PHP Mail'), null, ['class' => "form-control input-sm", 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('smtp_host', trans('application.smtp_host')) !!}
                            {!! Form::text('smtp_host', null, ['class' => "form-control input-sm", 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('smtp_username', trans('application.smtp_username')) !!}
                            {!! Form::input('email', 'smtp_username', null, ['class' => "form-control input-sm", 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('smtp_password', trans('application.smtp_password')) !!}
                            {!! Form::text('smtp_password', null, ['class' => "form-control input-sm", 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('smtp_port', trans('application.smtp_port')) !!}
                            {!! Form::text('smtp_port', null, ['class' => "form-control input-sm", 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit(trans('application.save_settings'), ['class' => "btn btn-primary btn-sm"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection