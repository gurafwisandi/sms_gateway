<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Api;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
{
    protected $menu = 'sekolah';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => Sekolah::all(),
        ];
        return view('sekolah.list')->with($data);
    }
    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
            'notifikasi' => Api::all(),
        ];
        return view('sekolah.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:sekolah,kode,' . $request->anak_karyawan . ',id,deleted_at,NULL',
            'sekolah' => 'required|unique:sekolah,sekolah,' . $request->sekolah . ',id,deleted_at,NULL',
            'alamat' => 'required',
            'notifikasi' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $sekolah = new Sekolah();
            $sekolah->kode = $request->kode;
            $sekolah->sekolah = $request->sekolah;
            $sekolah->alamat = $request->alamat;
            $sekolah->id_api = $request->notifikasi;
            $sekolah->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/sekolah');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
    public function destroy(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        DB::beginTransaction();
        try {
            $sekolah = Sekolah::findorfail($id);
            $sekolah->delete();

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
            'list' => Sekolah::findorfail($id),
            'notifikasi' => Api::all(),
        ];
        return view('sekolah.edit')->with($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table, field, where id
            'kode' => 'required|unique:sekolah,kode,' . $request->id . ',id,deleted_at,NULL',
            'sekolah' => 'required|unique:sekolah,sekolah,' . $request->id . ',id,deleted_at,NULL',
            'alamat' => 'required',
            'notifikasi' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $sekolah = Sekolah::findorfail($request->id);
            $sekolah->kode = $request->kode;
            $sekolah->sekolah = $request->sekolah;
            $sekolah->alamat = $request->alamat;
            $sekolah->id_api = $request->notifikasi;
            $sekolah->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/sekolah');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
}
