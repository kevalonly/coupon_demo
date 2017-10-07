@extends('layouts.app')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product name:</strong>
                {{ $product->product_name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>price:</strong>
                {{ $product->price }}
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12" id="discounted_price_tag">
            
        </div>
		
    </div>
	
	 @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'cart.store','method'=>'POST')) !!}
    <div class="row">

        {{ Form::hidden('product_id', $product->id, array('id'=>"product_id")) }}
        {{ Form::hidden('coupon_id', '', array('id'=>"coupon_id")) }}
        {{ Form::hidden('total', $product->price, array('id'=>"product_price")) }}
        {{ Form::hidden('user_id',  Auth::user()->id )}}
		
		<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                {!! Form::text('coupon_code', null, array('placeholder' => 'Product code','class' => 'form-control','id'=>"coupon_code")) !!}
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
               <button type="button" class="btn btn-primary apply_code">Apply Coupon</button>
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-6">
			<p class="error text-center alert alert-danger hidden"></p>
			<p class="success text-center alert alert-success hidden"></p>
		</div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center hidden" id="cart_button">
                <button type="submit" class="btn btn-primary">Buy now</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection