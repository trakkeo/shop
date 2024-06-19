@extends('admin.admin')

@section('title', 'Liste des Utilisateurs')

@section('content')
<div class="container">
    <h1>Liste des Utilisateurs</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Ajouter un utilisateur</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->address1 }} {{ $user->address2 }}</td>
                <td>{{ $user->postal_code }}</td>
                <td>{{ $user->city }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
