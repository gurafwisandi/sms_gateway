<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Matpel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MatpelController extends Controller
{
    protected $menu = 'Mata Pelajaran';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => Matpel::all(),
        ];
        return view('matpel.list')->with($data);
    }
    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
        ];
        return view('matpel.add')->with($data);
    }
    public function edit(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $data = [
            'menu' => $this->menu,
            'title' => 'edit',
            'list' => Matpel::findorfail($id)
        ];
        return view('matpel.edit')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'matpel' => 'required|unique:matpel,matpel,' . $request->matpel . ',id,deleted_at,NULL',
        ]);
        DB::beginTransaction();
        try {
            $paket = new Matpel();
            $paket->matpel = $request->matpel;
            $paket->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/matpel');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table matpel, field matpel, where id
            'matpel' => 'required|unique:matpel,matpel,' . $request->id . ',id,deleted_at,NULL',
        ]);
        DB::beginTransaction();
        try {
            $matpel = Matpel::findorfail($request->id);
            $matpel->matpel = $request->matpel;
            $matpel->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/matpel');
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
            $matpel = Matpel::findorfail($id);
            $matpel->delete();

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
