@extends('layouts.admin')
@section('title', 'Edit Products')
@section('body')

<div class="table-responsive">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>

            <li>{!! print_r($errors->all()) !!}</li>

        </ul>
    </div>
    @endif

@if($userData->admin_level== 'O')

<div class="table-responsive">

    <form action="/admin/updateproducts/{{$product->id}}" method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" autocomplete="off" value="{{$product->name}}" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option hidden disabled selected value> -- select an option -- </option>
                <option value="Jersey">Jersey</option>
                <option value="Shoes">Shoes</option>
                <option value="Pants">Pants</option>
                <option value="Jacket">Jacket</option>
                <option value="Other">Other</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="description" autocomplete="off" value="{{$product->description}}" required>
        </div>


        <div class="form-group">
            <label for="type">Type</label>
            <select id="type" name="type" required>
                <option hidden disabled selected value> -- select an option -- </option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Unisex">Unisex</option>
            </select>
                </div>

        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="price" autocomplete="off" value="{{$product->price}}" required>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>

</div>

@else
<div class="alert alert-danger">Only Owner can edit products</div>
@endif




@endsection