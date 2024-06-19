<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
        ]);

        auth()->user()->addresses()->create($request->all());

        return redirect()->route('addresses.index')->with('success', 'Adresse ajoutée avec succès.');
    }

    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);
            // Si l'adresse est définie comme active, désactiver les autres adresses de l'utilisateur
    if ($request->is_active) {
        Address::where('user_id', $address->user_id)
            ->where('id', '!=', $address->id)
            ->update(['is_active' => false]);
    }

        

        $address->update($request->all());

        return redirect()->route('addresses.index')->with('success', 'Adresse mise à jour avec succès.');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Adresse supprimée avec succès.');
    }
}