<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    protected $menu = 'api';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => Api::all(),
        ];
        return view('api.list')->with($data);
    }
    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
        ];
        return view('api.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'notifikasi' => 'required|unique:api,notifikasi,' . $request->notifikasi . ',id,deleted_at,NULL',
            'url' => 'required|unique:api,url,' . $request->url . ',id,deleted_at,NULL',
            'userkey' => 'required',
            'passkey' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $api = new api();
            $api->notifikasi = $request->notifikasi;
            $api->url = $request->url;
            $api->userkey = $request->userkey;
            $api->passkey = $request->passkey;
            $api->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/api');
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
            $api = api::findorfail($id);
            $api->delete();

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
            'list' => api::findorfail($id)
        ];
        return view('api.edit')->with($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table, field, where id
            'notifikasi' => 'required|unique:api,notifikasi,' . $request->id . ',id,deleted_at,NULL',
            'url' => 'required|unique:api,url,' . $request->id . ',id,deleted_at,NULL',
            'userkey' => 'required',
            'passkey' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $api = api::findorfail($request->id);
            $api->notifikasi = $request->notifikasi;
            $api->url = $request->url;
            $api->userkey = $request->userkey;
            $api->passkey = $request->passkey;
            $api->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/api');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
}
