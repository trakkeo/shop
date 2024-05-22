@extends('base')

@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Bienvenue sur InnovShop</h1>
            <p>Bienvenue dans notre boutique spécialisée dans les produits high-tech de pointe. Nous proposons un vaste assortiment d'appareils électroniques innovants, allant des derniers smartphones et ordinateurs portables aux gadgets les plus tendances. Que vous soyez un passionné de technologie ou simplement à la recherche du dernier équipement, notre équipe d'experts sera ravie de vous guider et de vous conseiller pour trouver le produit parfait répondant à vos besoins et à votre budget.</p>

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
