@extends('layouts.admin')
@section('title', 'Orders Panel')
@section('body')

<h1>Orders Panel</h1>

@if(session('orderDeletionStatus'))
<div class="alert alert-danger"> {{session('orderDeletionStatus')}} </div>
@endif



<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#order_id</th>
            <th>Date</th>
            <th>Delivery Date</th>
            <th>Price</th>
            <th>user_id</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)  
        <tr>
            <td>{{$order->order_id}}</td>
          
            <td>{{$order->date}}</td>
            <td>{{$order->del_date}}</td>
            <td>{{$order->price}}</td>
            <td>{{$order->user_id}}</td>
            <td>{{$order->status}}</td>

            <td><a href="{{ route('adminEditOrderForm',['id' => $order->order_id ])}}" class="btn btn-primary">Edit Order</a></td>

            @if(Auth::user()->admin_level == 'O')
            <td><a href="{{route('adminDeleteOrder', ['id'=>$order->order_id ])}}" onclick="return confirm('Are you sure you want to delete this order?')" class="btn btn-warning">Remove</a></td>
            @else
            <td><a href="{{route('adminDeleteOrder', ['id'=>$order->order_id ])}}" class="btn btn-warning disabled">Remove</a></td>
            @endif


        </tr>

        @endforeach

        </tbody>
    </table>
    {{$orders->links()}}

@endsection



