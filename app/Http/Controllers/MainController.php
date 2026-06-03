<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome()
    {
        return response()->json([
            'message' => 'Welcome to the API!'
        ]);
    }

    public function currentTime()
    {
        return response()->json([
            'current_time' => 'Hora Atual do Servidor: ' . now()
        ]);
    }

    public function currentDate()
    {
        return response()->json([
            'current_date' => 'Data Atual do Servidor: ' . today()
        ]);
    }
}
