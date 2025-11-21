<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
       $chirps = [
        [
            'author' => 'Alice',
            'message' => 'Hello, world!',
            'time' => '4 minutes ago'
        ],        [
            'author' => 'Bob',
            'message' => 'Laravel is awesome!',
            'time' => '10 minutes ago'
        ],
        [
            'author' => 'Alice',
            'message' => 'Hello, world!',
            'time' => '4 minutes ago'
        ],
        [
            'author' => 'Bob',
            'message' => 'Laravel is awesome!',
            'time' => '10 minutes ago'
        ]
    ];
        return view('home', ['chirps' => $chirps]);
    }
}
