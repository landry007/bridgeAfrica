<x-guest-layout>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <div class="row">
                @forelse ($products as $product)
                <div class="col-md-3 ml-4 mb-3 mt-2" style="margin-right: 5rem;">
                    <div class="card " style="width: 18rem;">
                        <img style="height: 10em;" src="{{ $product->image_url }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}
                                @if($product->trashed())
                                <span class="badge
                                badge-danger">Is deleted</span>
                                @endif
                            </h5>
                            <p class="card-text"> Price {{ $product->price }} </p>
                            <p class="card-text"> Quantity {{ $product->quantity }} </p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View
                                Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-dark" role="alert">
                    <h1>No Products in Store, Please create a product. <a class="nav-link" href="{{route
                        ('product.create')}}">Create product</a></h1>
                </div>
                @endforelse
            </div>
            <div class=" m-3">
                {{ $products->links() }}

            </div>
        </div>
    </div>
</x-guest-layout>