@extends('base')

@section('title', 'Tous nos produits')

@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <form action="" method="get" class="container d-flex gap-2">
            <input type="number" placeholder="RAM Minimum" class="form-control" name="memory" value="{{ $input['memory'] ?? '' }}">
            <input type="number" placeholder="Taille Ecran Min" class="form-control" name="screen_size" value="{{ $input['screen_size'] ?? '' }}">
            <input type="number" placeholder="Budget max" class="form-control" name="price" value="{{ $input['price'] ?? '' }}">
            <input placeholder="Mot clef" class="form-control" name="title" value="{{ $input['title'] ?? '' }}">
            <button class="btn btn-primary btn-sm flex-grow-0">
                Rechercher
            </button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            @forelse($products as $product)
                <div class="col-3 mb-4">
                    @include('product.card')
                </div>
            @empty
                <div class="col">
                    Aucun bien ne correspond à votre recherche
                </div>
            @endforelse
        </div>

        <div class="my-4">
            {{ $products->links() }}
        </div>
    </div>


@endsection
