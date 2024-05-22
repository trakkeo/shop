@extends('base')

@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence lorem ipsum</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda aut cumque dolore error expedita itaque iure iusto magni, molestiae numquam omnis provident quae repellat sint soluta tempora unde voluptate voluptatibus.</p>
        </div>
    </div>

    <div class="container">
        <h2>Nos derniers produits</h2>
        <div class="row">
            @foreach($products as $product)
            <div class="col">
                @include('product.card')
            </div>
            @endforeach
        </div>
    </div>

@endsection
