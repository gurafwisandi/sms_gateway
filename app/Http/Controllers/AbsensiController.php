<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Matpel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    protected $menu = 'Absensi';
    public function index()
    {
        if (Auth::user()->roles === 'Guru') {
            $guru = Guru::where('id_user', Auth::user()->id)->get();
            $list = Jadwal::where('id_guru', $guru[0]->id)->get();
        } elseif (Auth::user()->roles === 'Admin') {
            $list = Jadwal::all();
        } elseif (Auth::user()->roles === 'Siswa') {
            $siswa = Siswa::where('id_user', Auth::user()->id)->get();
            $list = Jadwal::where('id_kelas', $siswa[0]->id_kelas)->get();
        }
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => $list,
        ];
        return view('absensi.list')->with($data);
    }


















    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
            'kelas' => Kelas::all(),
            'guru' => Guru::all(),
            'matpel' => Matpel::all(),
        ];
        return view('absensi.add')->with($data);
    }
    public function store(Request $request)
    {
        $id_kelas = $request->id_kelas;
        $id_matpel = $request->id_matpel;
        $id_guru = $request->id_guru;
        $jam_mulai = $request->jam_mulai;
        $jam_selesai = $request->jam_selesai;
        $hari = $request->hari;

        $cek = DB::table('jadwal')
            ->selectRaw('count(id) as jml')
            ->where('id_kelas', $id_kelas)
            ->where('id_matpel', $id_matpel)
            ->where('id_guru', $id_guru)
            ->where('jam_mulai', $jam_mulai)
            ->where('jam_selesai', $jam_selesai)
            ->where('hari', $hari)
            ->whereNull('deleted_at')
            ->get();
        if ($cek[0]->jml > 0) {
            return response()->json([
                'code' => 404,
                'message' => 'Jadwal sudah ada',
            ]);
        }

        DB::beginTransaction();
        try {
            $jadwal = new Jadwal;
            $jadwal->id_kelas = $id_kelas;
            $jadwal->id_matpel = $id_matpel;
            $jadwal->id_guru = $id_guru;
            $jadwal->jam_mulai = $jam_mulai;
            $jadwal->jam_selesai = $jam_selesai;
            $jadwal->hari = $hari;
            $jadwal->save();

            DB::commit();
            // all good
            return response()->json([
                'code' => 200,
                'message' => 'berhasil',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'code' => 404,
                'message' => 'Gagal disimpan',
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        DB::beginTransaction();
        try {
            $jadwal = jadwal::findorfail($id);
            $jadwal->delete();

            DB::commit();
            AlertHelper::deleteAlert(true);
            return back();
        } catch (\Throwable $err) {
            DB::rollBack();
            AlertHelper::deleteAlert(false);
            return back();
        }
    }
    public function edit(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $data = [
            'menu' => $this->menu,
            'title' => 'edit',
            'kelas' => Kelas::all(),
            'guru' => Guru::all(),
            'matpel' => Matpel::all(),
            'list' => jadwal::findorfail($id)
        ];
        return view('absensi.edit')->with($data);
    }
    public function update(Request $request)
    {
        $id_kelas = $request->id_kelas;
        $id_matpel = $request->id_matpel;
        $id_guru = $request->id_guru;
        $jam_mulai = $request->jam_mulai;
        $jam_selesai = $request->jam_selesai;
        $hari = $request->hari;

        $cek = DB::table('jadwal')
            ->selectRaw('count(id) as jml')
            ->where('id_kelas', $id_kelas)
            ->where('id_matpel', $id_matpel)
            ->where('id_guru', $id_guru)
            ->where('jam_mulai', $jam_mulai)
            ->where('jam_selesai', $jam_selesai)
            ->where('hari', $hari)
            ->whereNull('deleted_at')
            ->get();
        if ($cek[0]->jml > 0) {
            return response()->json([
                'code' => 404,
                'message' => 'Jadwal sudah ada',
            ]);
        }

        DB::beginTransaction();
        try {
            $jadwal = jadwal::findorfail($request->id);
            $jadwal->id_kelas = $id_kelas;
            $jadwal->id_matpel = $id_matpel;
            $jadwal->id_guru = $id_guru;
            $jadwal->jam_mulai = $jam_mulai;
            $jadwal->jam_selesai = $jam_selesai;
            $jadwal->hari = $hari;
            $jadwal->save();

            DB::commit();
            // all good
            return response()->json([
                'code' => 200,
                'message' => 'berhasil',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'code' => 404,
                'message' => 'Gagal disimpan',
            ]);
        }
    }
}
