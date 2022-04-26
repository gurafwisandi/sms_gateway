<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Kelas;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    protected $menu = 'kelas';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => Kelas::all(),
        ];
        return view('kelas.list')->with($data);
    }
    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
            'sekolah' => Sekolah::all(),
        ];
        return view('kelas.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'sekolah' => 'required',
            'kelas' => 'required|unique:kelas',
        ]);
        DB::beginTransaction();
        try {
            $kelas = new kelas();
            $kelas->kelas = $request->kelas;
            $kelas->id_sekolah = $request->sekolah;
            $kelas->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/kelas');
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
            $kelas = kelas::findorfail($id);
            $kelas->delete();

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
            'sekolah' => Sekolah::all(),
            'list' => kelas::findorfail($id)
        ];
        return view('kelas.edit')->with($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table, field, where id
            'kelas' => 'required|unique:kelas,kelas,' . $request->id . ',id,deleted_at,NULL',
            'sekolah' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $kelas = kelas::findorfail($request->id);
            $kelas->id_sekolah = $request->sekolah;
            $kelas->kelas = $request->kelas;
            $kelas->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/kelas');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
}
