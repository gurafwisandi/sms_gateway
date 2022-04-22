<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatpelController extends Controller
{
    protected $menu = 'Mata Pelajaran';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'list' => 'List',
        ];
        return view('matpel.list')->with($data);
    }
    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'list' => 'Tambah',
        ];
        return view('matpel.add')->with($data);
    }
    public function edit()
    {
        $data = [
            'menu' => $this->menu,
            'list' => 'edit',
        ];
        return view('matpel.edit')->with($data);
    }
}
