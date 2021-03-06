@php
/*
$layout_page = shop_profile
*/ 
@endphp

@extends($templatePath.'.layout')

@section('main')
<style>
  .list{
    padding: 5px;
    border-bottom: 1px solid #c5baba;
  }
</style>
<div class="container mb-5 mt-5">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-3">
      @include($templatePath.'.account.nav_customer')
    </div>
    <div class="col-md-9 ">
      <h3 class="title-optoins-customer">{{ $title }}</h3>
      @if (count($addresses) ==0)
      <div class="text-danger">
        {{ trans('account.addresses.empty') }}
      </div>
      @else
          @foreach($addresses as $address)
              <div class="list">
                @if (sc_config('customer_lastname'))
                <b>{{ trans('account.first_name') }}:</b> {{ $address['first_name'] }}<br>
                <b>{{ trans('account.last_name') }}:</b> {{ $address['last_name'] }}<br>
                @else
                <b>{{ trans('account.name') }}:</b> {{ $address['first_name'] }}<br>
                @endif
                
                @if (sc_config('customer_phone'))
                <b>{{ trans('account.phone') }}:</b> {{ $address['phone'] }}<br>
                @endif

                @if (sc_config('customer_postcode'))
                <b>{{ trans('account.postcode') }}:</b> {{ $address['postcode'] }}<br>
                @endif

                @if (sc_config('customer_address2'))
                <b>{{ trans('account.address1') }}:</b> {{ $address['address1'] }}<br>
                <b>{{ trans('account.address2') }}:</b> {{ $address['address2'] }}<br>
                @else
                <b>{{ trans('account.address') }}:</b> {{ $address['first_address1'] }}<br>
                @endif

                @if (sc_config('customer_country'))
                <b>{{ trans('account.country') }}:</b> {{ $countries[$address['country']] ?? $address['country'] }}<br>
                @endif

                <span class="btn">
                  <a title="{{ trans('account.addresses.edit') }}" href="{{ route('member.update_address', ['id' => $address->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </span>
                <span class="btn">
                  <a href="#" title="{{ trans('account.addresses.delete') }}" class="delete-address" data-id="{{ $address->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </span>
                @if ($address->id == auth()->user()->address_id)
                <span class="btn" title="{{ trans('account.addresses.default') }}"><i class="fa fa-university" aria-hidden="true"></i></span>
                @endif
              </div>
          @endforeach
      @endif
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
                     <a href="{{ route('member.index') }}">{{ trans('front.my_account') }}</a>
                    <span>{{ $title }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
  $('.delete-address').click(function(){
    var r = confirm("{{ trans('account.confirm_delete') }}");
    if(!r) {
      return;
    }
    var id = $(this).data('id');
    $.ajax({
            url:'{{ route("member.delete_address") }}',
            type:'POST',
            dataType:'json',
            data:{id:id,"_token": "{{ csrf_token() }}"},
                beforeSend: function(){
                $('#loading').show();
            },
            success: function(data){
              if(data.error == 0) {
                location.reload();
              }
            }
        });
  });
</script>
@endpush