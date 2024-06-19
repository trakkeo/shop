@extends('admin.admin')

@section('title', $product->exists ? "Editer un produit" : "Créer un produit")

@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{ route($product->exists ? 'admin.product.update' : 'admin.product.store', $product) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method($product->exists ? 'put' : 'post')

        <div class="row">
            <div class="col vstack gap-2" style="flex: 100">
                <div class="row">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nom', 'name' => 'name', 'value' => $product->name])
                    <div class="col row">
                        @include('shared.input', ['class' => 'col', 'name' => 'price', 'label' => 'Prix', 'value' => $product->price])
                    </div>
                </div>
                @include('shared.input', ['type' => 'textarea', 'name' => 'description', 'value' => $product->description])
                <div class="row">
                    @include('shared.input', ['class' => 'col', 'name' => 'cpu', 'label' => 'Processeur', 'value' => $product->cpu])
                    @include('shared.input', ['class' => 'col', 'name' => 'memory', 'label' => 'RAM', 'value' => $product->memory])
                    @include('shared.input', ['class' => 'col', 'name' => 'screen_size', 'label' => 'Taille Ecran', 'value' => $product->screen_size])
                </div>
                <div class="row">

                </div>
                @include('shared.select', ['name' => 'options', 'label' => 'Options', 'value' => $product->options()->pluck('id'), 'multiple' => true])
                @include('shared.checkbox', ['class' => 'col', 'name' => 'status', 'label' => 'Actif', 'value' => $product->status])
                @include('shared.checkbox', ['class' => 'col', 'name' => 'starred', 'label' => 'En Vedette', 'value' => $product->starred])
                <div>
                    <button class="btn btn-primary">
                        @if($product->exists)
                            Modifier
                        @else
                            Créer
                        @endif
                    </button>
                </div>
            </div>
        <div class="col vstack gap-3" style="flex: 25; margin-top: 5px;">
                @foreach($product->pictures as $picture)
                    <div id="picture{{ $picture->id }}" class="position-relative" style="margin-top: 35px;">
                        <img src="{{ $picture->getImageUrl() }}" alt="" class="w-100 d-block">
                        <button type="button"
                                class="btn btn-danger position-absolute bottom-0 w-100 start-0"
                            hx-delete="{{ route('admin.picture.destroy', $picture) }}"
                            hx-target="#picture{{ $picture->id }}"
                            hx-swap="delete"
                        >
                            <span class="htmx-indicator spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Supprimer
                        </button>
                    </div>
                @endforeach
                @include('shared.upload', ['name' => 'pictures', 'label' => 'Images', 'multiple' => true])
            </div>
        </div>

    </form>

@endsection
