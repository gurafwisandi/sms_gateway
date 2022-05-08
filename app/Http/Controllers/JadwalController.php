<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    protected $menu = 'Jadwal';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => Jadwal::all(),
        ];
        return view('jadwal.list')->with($data);
    }


















    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
            'sekolah' => Jadwal::all(),
        ];
        return view('jadwal.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'sekolah' => 'required',
            'jadwal' => 'required|unique:jadwal',
        ]);
        DB::beginTransaction();
        try {
            $jadwal = new jadwal();
            $jadwal->jadwal = $request->jadwal;
            $jadwal->id_sekolah = $request->sekolah;
            $jadwal->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/jadwal');
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
            'sekolah' => Jadwal::all(),
            'list' => jadwal::findorfail($id)
        ];
        return view('jadwal.edit')->with($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table, field, where id
            'jadwal' => 'required|unique:jadwal,jadwal,' . $request->id . ',id,deleted_at,NULL',
            'sekolah' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $jadwal = jadwal::findorfail($request->id);
            $jadwal->id_sekolah = $request->sekolah;
            $jadwal->jadwal = $request->jadwal;
            $jadwal->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/jadwal');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
}
