@extends('layouts.admin')
@section('title', 'Insert Products')
@section('body')


<div class="table-responsive">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>

            <li>{!! print_r($errors->all()) !!}</li>

        </ul>
    </div>
    @endif


    <h2>Create New Product</h2>

    <form action="{{ route('adminSendInsertProducts')}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="{{old('name')}}" placeholder="Product Name" required>
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
            <input type="text" class="form-control" name="description" id="description" autocomplete="off" value="{{old('description')}}" placeholder="description" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="image" name="image" id="image" required>
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
            <input type="text" class="form-control" name="price" id="price" autocomplete="off" placeholder="XX.XX" value="{{old('price')}}" placeholder="price" required>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>

</div>
@endsection