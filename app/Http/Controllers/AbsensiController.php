<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\Absensi;
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
    public function absensi_kehadiran($id)
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Absensi',
            'lists' => Absensi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->get(),
            'id' => $id,
            'barcode' => Jadwal::findorfail(Crypt::decryptString($id)),
            'last_mulai' => Absensi::select('created_at')->where('type', 'Guru')->where('kehadiran', 'Mulai')->orderBy('created_at', 'DESC')->limit(1)->get(),
            'last_selesai' => Absensi::select('created_at')->where('type', 'Guru')->where('kehadiran', 'Selesai')->orderBy('created_at', 'DESC')->limit(1)->get(),
        ];
        return view('absensi.absensi_kehadiran')->with($data);
    }
    public function absensi_mulai(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $id = Crypt::decryptString($id);
            $guru = Guru::where('id_user', Auth::user()->id)->get();

            $jadwal = new Absensi;
            $jadwal->id_jadwal = $id;
            $jadwal->id_guru = $guru[0]->id;
            $jadwal->type = 'Guru';
            $jadwal->kehadiran = 'Mulai';
            $jadwal->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            AlertHelper::deleteAlert(false);
            return back();
            // something went wrong
        }
    }
    public function absensi_selesai(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $id = Crypt::decryptString($id);
            $guru = Guru::where('id_user', Auth::user()->id)->get();

            $jadwal = new Absensi;
            $jadwal->id_jadwal = $id;
            $jadwal->id_guru = $guru[0]->id;
            $jadwal->type = 'Guru';
            $jadwal->kehadiran = 'Selesai';
            $jadwal->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            AlertHelper::deleteAlert(false);
            return back();
            // something went wrong
        }
    }
    public function qrcode_siswa(Request $request)
    {
        $data = explode("|", Crypt::decryptString($request->decodedText));
        $id_jadwal = $data[0];
        $id_guru = $data[1];
        // cek jadwal
        $cek_jadwal = Jadwal::findorfail($id_jadwal);
        $day = date('D', strtotime(now()));
        $dayList = [
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
        ];
        if (strtoupper($dayList[$day]) !== $cek_jadwal->hari) {
            return response()->json([
                'code' => 404,
                'message' => 'Absensi hanya bisa dilakukan pada hari ' . $cek_jadwal->hari,
            ]);
        }

        // cek absensi
        $siswa = Siswa::select('id')->where('id_user', Auth::user()->id)->get();
        $now = date('Y-m-d', strtotime(now()));
        $cek_absensi = Absensi::where('id_jadwal', $id_jadwal)
            ->where('id_siswa', $siswa[0]->id)
            ->where('created_at', 'Like', '%' . $now . '%')
            ->get();
        if (count($cek_absensi) > 0) {
            return response()->json([
                'code' => 404,
                'id' => Crypt::encryptString($id_jadwal),
                'message' => 'Sudah melakukan absensi pada tanggal ' . date('d M Y H:i:s', strtotime($cek_absensi[0]->created_at)),
            ]);
        }

        DB::beginTransaction();
        try {
            $jadwal = new Absensi;
            $jadwal->id_jadwal = $id_jadwal;
            $jadwal->id_siswa = $siswa[0]->id;
            $jadwal->type = 'Siswa';
            $jadwal->kehadiran = 'Hadir';
            $jadwal->save();

            // TODO :: proses SMS GATEWAY

            DB::commit();
            return response()->json([
                'code' => 200,
                'id' => Crypt::encryptString($id_jadwal),
                'message' => 'Berhasil Simpan',
            ]);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return response()->json([
                'code' => 404,
                'id' => Crypt::encryptString($id_jadwal),
                'message' => 'Gagal Simpan',
            ]);
        }
    }









    public function history_absensi($id)
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'History Absensi',
            'kelas' => Kelas::all(),
            'guru' => Guru::all(),
            'matpel' => Matpel::all(),
        ];
        return view('absensi.list_absensi')->with($data);
    }
    public function absensi_siswa($id)
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Absensi Siswa',
        ];
        return view('absensi.history')->with($data);
    }
}
