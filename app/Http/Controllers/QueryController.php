<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientQuery;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'requirement' => 'required|string',
        ]);

        $query = new ClientQuery();
        $query->company_name = $request->company_name;
        $query->name = $request->name;
        $query->email = $request->email;
        $query->phone = $request->phone;
        $query->whatsapp = $request->whatsapp;
        $query->requirement = $request->requirement;
        
        if (Auth::check()) {
            $query->user_id = Auth::id();
        }
        
        $query->save();

        return redirect()->back()->with('success', 'Your appointment request/query has been submitted successfully.');
    }
}
