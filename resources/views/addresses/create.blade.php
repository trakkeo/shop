@extends('base')

@section('title', 'Ajouter une Adresse')

@section('content')
<div class="container">
    <h1>Ajouter une Adresse</h1>
    <form action="{{ route('addresses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="address1" class="form-label">Adresse 1</label>
            <input type="text" class="form-control" id="address1" name="address1" required>
        </div>
        <div class="mb-3">
            <label for="address2" class="form-label">Adresse 2</label>
            <input type="text" class="form-control" id="address2" name="address2">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="mb-3">
            <label for="postal_code" class="form-label">Code Postal</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Pays</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
