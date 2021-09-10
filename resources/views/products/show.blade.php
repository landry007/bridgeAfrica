<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <img class="m-3" height="150" width="250" src="{{ $product->image_url }}">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <h4> {{ $product->name }}</h4>
                        </div>
                        <div class="col-md-4">
                            Last updated {{ $product->updated_at }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nature
                            <span class="badge badge-primary badge-pill"> {{ $product->nature }} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Category
                            <span class="badge badge-primary badge-pill"> {{ $product->category->name }} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Quantity
                            <span class="badge badge-primary badge-pill"> {{ $product->quantity }} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Price
                            <span class="badge badge-primary badge-pill">{{ $product->price }} CFA</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Validity
                            <span class="badge badge-primary badge-pill">{{ $product->validity }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Created at
                            <span class="badge badge-primary badge-pill">{{ $product->created_at }}</span>
                        </li>
                        @if($product->trashed())
                        <li class="list-group-item list-group-item-danger  d-flex justify-content-between
                            align-items-center">
                            deleted_at
                            <span class="badge badge-primary badge-pill">{{ $product->deleted_at }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="card-footer">


                    <div class="row">
                        @if(!$product->trashed())

                        <div class="col-md-7">
                            <form method="get" action="{{route('product.edit', $product->id )}}">
                                @method('GET')
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary mr-4">Update</button>
                            </form>
                        </div>
                        @endif
                        @if(!$product->trashed())

                        <div class="col-md-4">
                            <form method="POST" action="{{route('product.delete', $product->id )}}">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        @endif

                        @if($product->trashed())

                        <div class="col-md-4">
                            <a href="{{route('product.restore', $product->id )}}" class="btn btn-primary btn-lg
                                active" role="button" aria-pressed="true">Restore product</a>

                        </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>