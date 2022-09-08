<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    protected $menu = 'siswa';
    public function index()
    {
        if (Auth::user()->roles === 'Guru') {
            $guru = Guru::where('id_user', Auth::user()->id)->get();
            if (count($guru) > 0) {
                $list = Siswa::where('id_kelas', $guru[0]->id_kelas)->get();
            } else {
                $list = [];
            }
            $cek = 1;
        } elseif (Auth::user()->roles === 'Admin') {
            $list = Siswa::all();
            $cek = 0;
        } elseif (Auth::user()->roles === 'Siswa') {
            $list = Siswa::where('id_user', Auth::user()->id)->get();
            $cek = $list->count();
        }
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => $list,
            'cek' => $cek
        ];
        return view('siswa.list')->with($data);
    }
    public function add()
    {
        $user = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('roles', 'Siswa')
            ->whereNotIn('id', DB::table('siswa')->select('id_user')->wherenull('deleted_at'))
            ->get();
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
            'user' => $user,
            'kelas' => Kelas::all(),
        ];
        return view('siswa.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis,' . $request->nis . ',id,deleted_at,NULL',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_tlp' => 'required|numeric|unique:siswa,no_tlp,' . $request->no_tlp . ',id,deleted_at,NULL',
            'id_user' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $siswa = new siswa();
            $siswa->nis = $request->nis;
            $siswa->nama_lengkap = $request->nama_lengkap;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->alamat = $request->alamat;
            $siswa->nama_ayah = $request->nama_ayah;
            $siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
            $siswa->nama_ibu = $request->nama_ibu;
            $siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
            $siswa->no_tlp = $request->no_tlp;
            $siswa->id_kelas = $request->id_kelas;
            $siswa->id_user = $request->id_user;
            $siswa->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/siswa');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
    public function edit(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $data = [
            'menu' => $this->menu,
            'title' => 'edit',
            'list' => siswa::findorfail($id),
            'kelas' => Kelas::all(),
        ];
        return view('siswa.edit')->with($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table siswa, field siswa, where id
            'nis' => 'required|numeric|unique:siswa,nis,' . $request->id . ',id,deleted_at,NULL',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_tlp' => 'required|numeric|unique:siswa,no_tlp,' . $request->id . ',id,deleted_at,NULL',
            'id_user' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $siswa = siswa::findorfail($request->id);
            $siswa->nis = $request->nis;
            $siswa->nama_lengkap = $request->nama_lengkap;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->alamat = $request->alamat;
            $siswa->nama_ayah = $request->nama_ayah;
            $siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
            $siswa->nama_ibu = $request->nama_ibu;
            $siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
            $siswa->no_tlp = $request->no_tlp;
            $siswa->id_kelas = $request->id_kelas;
            $siswa->id_user = $request->id_user;
            $siswa->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/siswa');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
    public function view(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $data = [
            'menu' => $this->menu,
            'title' => 'view',
            'list' => siswa::findorfail($id),
            'kelas' => Kelas::all(),
        ];
        return view('siswa.view')->with($data);
    }
    public function destroy(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        DB::beginTransaction();
        try {
            $siswa = siswa::findorfail($id);
            $siswa->delete();

            DB::commit();
            AlertHelper::deleteAlert(true);
            return back();
        } catch (\Throwable $err) {
            DB::rollBack();
            AlertHelper::deleteAlert(false);
            return back();
        }
    }
}
