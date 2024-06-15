<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
class HomeController extends Controller
{    public function index()
    {
        $products = Todo::all(); // Fetch all products from the database
        return view('welcome', ['products' => $products]); 
    }
}
