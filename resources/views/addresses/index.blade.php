@extends('base')

@section('title', 'Mes Adresses')

@section('content')
<div class="container">
    <h1>Mes Adresses</h1>
    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">Ajouter une adresse</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Adresse préférée</th>
                <th>Adresse 1</th>
                <th>Adresse 2</th>
                <th>Ville</th>
                <th>Code Postal</th>
                <th>Pays</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($addresses as $address)
            <tr>
                <td>{{ $address->is_active ? 'Oui' : 'Non' }}</td>

                <td>{{ $address->address1 }}</td>
                <td>{{ $address->address2 }}</td>
                <td>{{ $address->city }}</td>
                <td>{{ $address->postal_code }}</td>
                <td>{{ $address->country }}</td>
                <td>
                    <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette adresse ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
