@extends('layouts.admin')
@section('title', 'Product Catalog')
@section('body')

<?php use Illuminate\Support\Facades\Storage; ?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Product Id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Type</th>
            <th>Price</th>
            <th>Edit Image</th>
            <th>Edit</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
        <tr>
            <td>{{$product['id']}}</td>
             <td><img src="{{asset ('storage')}}/product_images/{{$product['image']}}" alt="{{asset ('storage')}}/product_images/{{$product['image']}}" width="100" height="100" style="max-height:220px" ></td>
           <!-- <td>  <img src="{{ Storage::url('product_images/'.$product['image'])}}"
                       alt="<?php echo Storage::url($product['image']); ?>" width="100" height="100" style="max-height:220px" >   </td> -->
            <td>{{$product['name']}}</td>
            <td>{{$product['category']}}</td>
            <td>{{$product['description']}}</td>
            <td>{{$product['type']}}</td>
            <td>${{$product['price']}}</td>

            <td><a href="{{route('adminUploadImage', ['id'=>$product['id']])}}" class="btn btn-primary">Edit Image</a></td>
            <td><a href="{{route('adminEditProducts', ['id'=>$product['id']])}}" class="btn btn-primary">Edit</a></td>
            @if(Auth::user()->admin_level == 'O')
            <td><a href="{{route('adminRemoveProduct', ['id'=>$product['id']])}}" onclick="return confirm('Are you sure you want to delete this order?')" class="btn btn-warning">Remove</a></td>
            @else
            <td><a href="{{route('adminRemoveProduct', ['id'=>$product['id']])}}" class="btn btn-warning disabled">Remove</a></td>
            @endif
        </tr>

        @endforeach

        </tbody>
    </table>

    {{$products->links()}}

</div>
@endsection