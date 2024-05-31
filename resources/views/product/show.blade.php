@extends('base')

@section('title', $product->title)

@section('content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-8">

                <div id="carousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 800px;">
                    <div class="carousel-inner">
                        @foreach($product->pictures as $k => $picture)
                            <div class="carousel-item {{ $k === 0 ? 'active' : '' }}">
                                <img src="{{ $picture->getImageUrl(800, 530) }}" alt="">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="color: lightgrey;"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="color: lightgrey;"></span>

                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-4">

                <h1>{{ $product->name }}</h1>
                <h2>{{ $product->cpu }} - {{ $product->memory }} Go</h2>

                <div class="text-primary fw-bold" style="font-size: 4rem;">
                    {{ $product->price }} €
                </div>

                <hr>

                <div class="col-12">
                    <h2>Caractéristiques</h2>
                    <table class="table table-striped">
                        <tr>
                            <td>Processeur</td>
                            <td>{{ $product->cpu }}</td>
                        </tr>
                        <tr>
                            <td>Mémoire Vive</td>
                            <td>{{ $product->memory }} Go</td>
                        </tr>
                        <tr>
                            <td>Écran</td>
                            <td>{{ $product->screen_size }} pouces</td>
                        </tr>
                    </table>
                </div>
                <h3>Options disponibles</h3>
            <div class="row">
                <div class="col-5">
                    <h4>Couleurs</h4>
                    <div class="form-group">
                        @foreach($product->options->where('type', 'Couleur') as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="color" id="{{ $option->id }}" value="{{ $option->id }}">
                            <label class="form-check-label" for="{{ $option->id }}">{{ $option->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-5">
                    <h4>RAM</h4>
                    <ul class="list-group">
                        @foreach($product->options->where('type', 'RAM') as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ram" id="{{ $option->id }}" value="{{ $option->id }}">
                            <label class="form-check-label" for="{{ $option->id }}">{{ $option->name }}</label>
                        </div>
                        @endforeach
                    </ul>
                </div>


            </div>

    </div>

        <div class="mt-4">
            <p>{!! nl2br($product->description) !!}</p>
            <div class="row">

                
            </div>
        </div>

    </div>

@endsection
