@extends('base')
@section('title')Bienvenue sur la boutique @endsection
@section('content')
@if (session('mustbeadmin'))
    <div class="alert alert-danger">{{ session('mustbeadmin') }}</div>
@endif
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif



    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Bienvenue sur InnovShop</h1>
            <p>Bienvenue dans notre boutique spécialisée dans les produits high-tech de pointe. Nous proposons un vaste assortiment d'appareils électroniques innovants, allant des derniers smartphones et ordinateurs portables aux gadgets les plus tendances. Que vous soyez un passionné de technologie ou simplement à la recherche du dernier équipement, notre équipe d'experts sera ravie de vous guider et de vous conseiller pour trouver le produit parfait répondant à vos besoins et à votre budget.</p>

        </div>
    </div>
    <div class="container" style="margin-bottom: 20px;">
    <h2>Nos produits en vedette</h2>
    <div class="row">
        @foreach($starredProducts as $starredProduct)
        <div class="col-4 mb-3">
            @include('product.starredCard')
        </div>
        @endforeach
    </div>
</div>
    <div class="container">
        <h2>Nos derniers produits</h2>
        <div class="row">
            @foreach($products as $product)
            <div class="col-4 mb-3">
                @include('product.card')
            </div>
            @endforeach
        </div>
    </div>




@endsection
