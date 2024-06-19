@extends('base')

@section('title', 'Modifier une Adresse')

@section('content')
<div class="container">
    <h1>Modifier une Adresse</h1>
    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
                    <label for="is_active" class="form-label">Adresse préférée</label>
                    <select class="form-control" id="is_active" name="is_active" required>
                        <option value="1" {{ $address->is_active ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$address->is_active ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                
        <div class="mb-3">
            <label for="address1" class="form-label">Adresse 1</label>
            <input type="text" class="form-control" id="address1" name="address1" value="{{ $address->address1 }}" required>
        </div>
        <div class="mb-3">
            <label for="address2" class="form-label">Adresse 2</label>
            <input type="text" class="form-control" id="address2" name="address2" value="{{ $address->address2 }}">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $address->city }}" required>
        </div>
        <div class="mb-3">
            <label for="postal_code" class="form-label">Code Postal</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $address->postal_code }}" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Pays</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ $address->country }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
