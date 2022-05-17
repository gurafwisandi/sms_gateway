<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    protected $menu = 'guru';
    public function index()
    {
        if (Auth::user()->roles === 'Admin') {
            $list = Guru::all();
        } else {
            $list = Guru::where('id_user', Auth::user()->id)->get();
        }
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => $list,
            'cek' => $list->count()
        ];
        return view('guru.list')->with($data);
    }
    public function add()
    {
        $user = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('roles', 'Guru')
            ->whereNotIn('id', DB::table('guru')->select('id_user')->wherenull('deleted_at'))
            ->get();
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
            'user' => $user,
            'kelas' => Kelas::all(),
        ];
        return view('guru.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:guru,nis',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'id_user' => 'required',
        ]);
        // validasi kelas tidak bisa duplicat dan kecuali sudah deleted_at
        $cek_kelas = Guru::where('id_kelas', $request->id_kelas)->count();
        if ($cek_kelas > 0) {
            $request->validate([
                'nis' => 'required|numeric|unique:guru,nis',
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'id_user' => 'required',
                'id_kelas' => 'unique:guru,id_kelas'
            ]);
        }
        DB::beginTransaction();
        try {
            $guru = new guru();
            $guru->nis = $request->nis;
            $guru->nama = $request->nama_lengkap;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->alamat = $request->alamat;
            $guru->id_user = $request->id_user;
            $guru->id_kelas = $request->id_kelas;
            $guru->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/guru');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
    public function edit(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $list = guru::findorfail($id);
        $user = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('roles', 'Guru')
            ->whereNotIn('id', DB::table('guru')->select('id_user')->where('id_user', '!=', $list->id_user)->wherenull('deleted_at'))
            ->get();
        $data = [
            'menu' => $this->menu,
            'title' => 'edit',
            'list' => $list,
            'user' => $user,
            'kelas' => Kelas::all(),
        ];
        return view('guru.edit')->with($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table guru, field guru, where id
            'nis' => 'required|numeric|unique:guru,nis,' . $request->id,
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'id_user' => 'required',
        ]);
        // validasi kelas tidak bisa duplicat dan kecuali sudah deleted_at
        if (isset($request->id_kelas) and $request->id_kelas_old != $request->id_kelas) {
            $cek_kelas = Guru::where('id_kelas', $request->id_kelas)->count();
            if ($cek_kelas > 0) {
                $request->validate([
                    'nis' => 'required|numeric|unique:guru,nis,' . $request->id,
                    'nama_lengkap' => 'required',
                    'jenis_kelamin' => 'required',
                    'alamat' => 'required',
                    'id_user' => 'required',
                    'id_kelas' => 'unique:guru,id_kelas'
                ]);
            }
        }
        DB::beginTransaction();
        try {
            $guru = guru::findorfail($request->id);
            $guru->nis = $request->nis;
            $guru->nama = $request->nama_lengkap;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->alamat = $request->alamat;
            $guru->id_user = $request->id_user;
            $guru->id_kelas = $request->id_kelas;
            $guru->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/guru');
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
            'list' => guru::findorfail($id),
            'kelas' => Kelas::all(),
            'user' => User::all(),
        ];
        return view('guru.view')->with($data);
    }
    public function destroy(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        DB::beginTransaction();
        try {
            $guru = guru::findorfail($id);
            $guru->delete();

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
