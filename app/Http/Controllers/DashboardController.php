<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $menu = 'dashboard';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'submenu' => 'dashboard',
        ];
        // return view('layouts.main')->with($data);
        return view('dashboard')->with($data);
    }
}
