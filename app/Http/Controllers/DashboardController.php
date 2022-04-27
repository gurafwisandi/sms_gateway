<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $menu = 'dashboard';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'submenu' => 'dashboard',
            'akun' => User::all(),
            'guru' => Guru::all(),
            'siswa' => Siswa::all(),
        ];
        return view('dashboard')->with($data);
    }
}
