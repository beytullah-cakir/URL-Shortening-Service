<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $urls=Url::where("user_id",Auth::id())->get();

        $totalLinks = count($urls);

        return view('dashboard', compact('urls', 'totalLinks'));
    }
}
