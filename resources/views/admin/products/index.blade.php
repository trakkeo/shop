@extends('admin.admin')

@section('title', 'Tous les produits')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Ajouter un produit</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Surface</th>
            <th>Prix</th>
            <th>Ville</th>
            <th class="text-end">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->cpu }}</td>
                <td>{{ $product->price }}€</td>
                <td>{{ $product->memory }}</td>
                <td>
                    <div class="d-flex gap-2 w-100 justify-content-end">
                        <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-primary">Editer</a>
                        <form action="{{ route('admin.product.destroy', $product) }}" method="post">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

@endsection
