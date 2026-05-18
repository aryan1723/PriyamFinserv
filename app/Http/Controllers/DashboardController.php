<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientQuery;
use App\Models\FileShare;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // If admin, redirect to admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $queries = ClientQuery::where('user_id', $user->id)->latest()->get();
        $files = FileShare::where('user_id', $user->id)->latest()->get();

        return view('dashboard', compact('queries', 'files'));
    }
}
