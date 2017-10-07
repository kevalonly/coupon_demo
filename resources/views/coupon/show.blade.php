@extends('layouts.app')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show coupon</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('coupon.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Coupon code:</strong>
                {{ $coupon->coupon_code }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $coupon->description }}
            </div>
        </div>
		
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>From date:</strong>
                {{ $coupon->from_date }}
            </div>
        </div>

		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>To date:</strong>
                {{ $coupon->to_date }}
            </div>
        </div>
		
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Discount:</strong>
                {{ $coupon->discount }}%
            </div>
        </div>
		
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Max redeem:</strong>
                {{ $coupon->max_redeem }}
            </div>
        </div>
		
    </div>

@endsection