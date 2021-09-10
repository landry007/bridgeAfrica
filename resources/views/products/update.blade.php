<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Product') }}
        </h2>
    </x-slot>

    <div class="container">
        <img class="m-3" height="250" width="250" src="{{ $product->image_url }}">

        <form method="post" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <input name="name" type="text" value="{{$product->name}}" class="form-control" id="name"
                       aria-describedby="emailHelp"
                       placeholder="Product Name">
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
                <input type="number" name="price" value="{{$product->price}}" class="form-control" id="price"
                       placeholder="Price">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control" id="quantity"
                       placeholder="Price">
            </div>

            <div class="form-group">
                <label for="categoryId">Product Category</label>
                <select name="category" class="form-control" id="categoryId">
                    @foreach( $categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name  }}</option>
                        @if(  $category->id == $product->id )
                            <option value="{{ $category->id }}" selected>{{ $product->name  }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="validity">Validity</label>
                <input type="datetime-local" value="{{$product->validity}}" class="form-control" name="validity"
                       id="validity" placeholder="Validity">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>