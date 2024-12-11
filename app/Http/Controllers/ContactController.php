<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts',
            'telephone' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($data);
        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $data = $request->validate([
            'nom' => 'string|max:255',
            'email' => 'email|unique:contacts,email,' . $contact->id,
            'telephone' => 'nullable|string',
            'message' => 'string',
        ]);

        $contact->update($data);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Contact supprimé']);
    }
}
