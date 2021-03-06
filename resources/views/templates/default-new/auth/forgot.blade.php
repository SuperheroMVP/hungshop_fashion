@php
/*
$layout_page = shop_auth
*/
@endphp

@extends($templatePath.'.layout')

@section('main')
<div class="container spad">
    <div class="row justify-content-center">
        <div class="col-md-6 login-form">
            <h2 class="title-page">{{ $title }}</h2>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="group-input form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-12 control-label"><i class="fa fa-envelope" aria-hidden="true"></i>
                        {{ trans('customer.email') }}</label>
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                            required>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        <br />
                        @endif

                        <button type="submit" name="SubmitLogin" class="btn btn-warning mt-3 text-white site-btn login-btn pull-right">
                            <span>
                                <i class="glyphicon glyphicon-wrench"></i>
                                {{ trans('front.submit_form') }}
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i>{{trans('front.home')}}</a>
                    <span>{{ $title }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection