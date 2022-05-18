<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $menu = 'dashboard';
    public function index(Request $request)
    {
        if (Auth::user()->roles === 'Siswa') {
            $id_user = Auth::user()->id;
            $siswa = Siswa::where('id_user', $id_user)->get();
            $id = $siswa[0]->id;
            $absensi = DB::table('absensi')
                ->select('kelas.kelas', 'matpel.matpel', 'absensi.created_at', 'hari', 'jam_mulai', 'jam_selesai', 'guru.nama')
                ->selectRaw('count(case when kehadiran = "Hadir" and id_siswa = "' . $id . '"  then kehadiran END) as hadir')
                ->selectRaw('count(case when kehadiran = "Tidak Hadir" and id_siswa = "' . $id . '" then kehadiran END) as tidak_hadir')
                ->join('jadwal', 'jadwal.id', '=', 'absensi.id_jadwal')
                ->join('kelas', 'kelas.id', '=', 'jadwal.id_kelas')
                ->join('matpel', 'matpel.id', '=', 'jadwal.id_matpel')
                ->join('guru', 'guru.id', '=', 'jadwal.id_guru')
                ->where('absensi.created_at', 'LIKE', '%' . date("Y-m-d") . '%')
                ->where('absensi.id_siswa', $id)
                ->groupBy(DB::raw('DATE_FORMAT(absensi.created_at, "%y-%m-%d")'))
                ->groupBy(DB::raw('id_jadwal'))
                ->orderBy('absensi.created_at', 'DESC')
                ->get();
        } elseif (Auth::user()->roles === 'Guru') {
            $id_user = Auth::user()->id;
            $guru = Guru::where('id_user', $id_user)->get();
            $id = $guru[0]->id;
            $absensi = DB::table('absensi')
                ->select('kelas.kelas', 'matpel.matpel', 'absensi.created_at', 'hari', 'jam_mulai', 'jam_selesai', 'guru.nama')
                ->selectRaw('count(case when kehadiran = "Hadir"  then kehadiran END) as hadir')
                ->selectRaw('count(case when kehadiran = "Tidak Hadir" then kehadiran END) as tidak_hadir')
                ->join('jadwal', 'jadwal.id', '=', 'absensi.id_jadwal')
                ->join('kelas', 'kelas.id', '=', 'jadwal.id_kelas')
                ->join('matpel', 'matpel.id', '=', 'jadwal.id_matpel')
                ->join('guru', 'guru.id', '=', 'jadwal.id_guru')
                ->where('absensi.created_at', 'LIKE', '%' . date("Y-m-d") . '%')
                ->where('jadwal.id_guru', $id)
                ->groupBy(DB::raw('DATE_FORMAT(absensi.created_at, "%y-%m-%d")'))
                ->groupBy(DB::raw('id_jadwal'))
                ->orderBy('absensi.created_at', 'DESC')
                ->get();
        } else {
            $absensi = DB::table('absensi')
                ->select('kelas.kelas', 'matpel.matpel', 'absensi.created_at', 'hari', 'jam_mulai', 'jam_selesai', 'guru.nama')
                ->selectRaw('count(case when kehadiran = "Hadir"  then kehadiran END) as hadir')
                ->selectRaw('count(case when kehadiran = "Tidak Hadir" then kehadiran END) as tidak_hadir')
                ->join('jadwal', 'jadwal.id', '=', 'absensi.id_jadwal')
                ->join('kelas', 'kelas.id', '=', 'jadwal.id_kelas')
                ->join('matpel', 'matpel.id', '=', 'jadwal.id_matpel')
                ->join('guru', 'guru.id', '=', 'jadwal.id_guru')
                ->where('absensi.created_at', 'LIKE', '%' . date("Y-m-d") . '%')
                ->groupBy(DB::raw('DATE_FORMAT(absensi.created_at, "%y-%m-%d")'))
                ->groupBy(DB::raw('id_jadwal'))
                ->orderBy('absensi.created_at', 'DESC')
                ->get();
        }
        $data = [
            'menu' => $this->menu,
            'submenu' => 'dashboard',
            'akun' => User::all(),
            'guru' => Guru::all(),
            'siswa' => Siswa::all(),
            'absensi' => $absensi
        ];
        return view('dashboard')->with($data);
    }
}
