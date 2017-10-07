@extends('layouts.app')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Coupons </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('coupon.create') }}"> Create New coupon</a>
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
            <th>Coupon code</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($coupons as $key => $coupon)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $coupon->coupon_code }}</td>
        <td>{{ $coupon->description }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('coupon.show',$coupon->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('coupon.edit',$coupon->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['coupon.destroy', $coupon->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $coupons->render() !!}

@endsection