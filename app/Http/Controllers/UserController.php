<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $menu = 'Akun';
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'List',
            'lists' => User::all(),
        ];
        return view('user.list')->with($data);
    }
    public function add()
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Tambah',
        ];
        return view('user.add')->with($data);
    }
    public function edit(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $data = [
            'menu' => $this->menu,
            'title' => 'edit',
            'list' => User::findorfail($id)
        ];
        return view('user.edit')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'roles' => 'required',
            'password' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->roles = $request->roles;
            $user->password = bcrypt($request->password);
            $user->status = 'Aktif';
            $user->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/user');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            // something went wrong
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            // validasi unique table User, field User, where id
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $request->id,
            'roles' => 'required',
            'password' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $User = User::findorfail($request->id);
            $User->name = $request->name;
            $User->email = $request->email;
            $User->roles = $request->roles;
            if ($request->password !== $request->password_old) {
                $User->password = bcrypt($request->password);
            }
            $User->status = isset($request->status) ? 'Aktif' : 'Tidak Aktif';
            $User->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('admin/user');
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
            $User = User::findorfail($id);
            $User->delete();

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
