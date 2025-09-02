<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegsitrationController extends Controller
{
    public function index()
    {
        $recs = Registration::orderBy('created_date')
            ->get();

        return response()->json([
            'registrations' => $recs,
        ]);
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'first_name' => 'string|required|max:255',
            'last_name' => 'string|required|max:255',
            'email' => 'string|required|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $reg = Registration::create($valid);

        return response()->json($reg);
    }
}
