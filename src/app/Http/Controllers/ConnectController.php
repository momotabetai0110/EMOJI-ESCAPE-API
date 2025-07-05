<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnectController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'ok']);
    }
}
