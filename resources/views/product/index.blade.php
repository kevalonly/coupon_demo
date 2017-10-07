@extends('layouts.app')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.create') }}"> Create New product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($coupons as $key => $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('product.show',$product->id) }}">Buy now</a>
            <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $product->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $coupons->render() !!}

@endsection