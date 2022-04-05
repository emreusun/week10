<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'app' => 'Fake Spotify',
            'author' => 'Nick Ireland',
            'email' => 'n_ireland@fanshaweonline.ca'
        ]);
    }
}