<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatpelController extends Controller
{
    protected $menu = 'pengaturan';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
        ];
        return view('matpel.list')->with($data);
    }
}
