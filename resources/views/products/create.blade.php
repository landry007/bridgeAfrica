<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new Product') }}
        </h2>
    </x-slot>

<div class="container">
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row col-lg-6 m-5 offset-lg-3">
    
    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Product Name">
        </div>
        <div class="form-group">
            <label for="nature">Nature of product</label>
            <select name="nature" class="form-control" id="nature">
                <option>Bien</option>
                <option>Service</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="Price">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity">
        </div>

        <div class="form-group">
            <label for="categoryId">Product Category</label>
            <select name="category" class="form-control" id="categoryId">
                @foreach( $categories as $category)
                <option value="{{ $category->id }}">{{ $category->name  }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" class="form-control" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
</x-app-layout>
