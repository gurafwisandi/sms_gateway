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
        $jadwal = Jadwal::findorfail(Crypt::decryptString($id));
        $data = [
            'menu' => $this->menu,
            'title' => 'Absensi',
            'lists' => Absensi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->get(),
            'id' => $id,
            'barcode' => $jadwal,
            'jml_kelas' => Siswa::where('id_kelas', $jadwal->id_kelas)->count(),
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
                'id' => Crypt::encryptString($id_jadwal),
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
    public function edit($id)
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Edit Absensi',
            'list' => Absensi::findorfail(Crypt::decryptString($id)),
        ];
        return view('absensi.edit')->with($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required',
            'kehadiran' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $absensi = Absensi::findorfail($request->id);
            $absensi->kehadiran = $request->kehadiran;
            $absensi->save();

            DB::commit();
            if ($request->kehadiran != $request->kehadiran_old) {
                // TODO : kirim SMS GATEWAY
            }
            AlertHelper::addAlert(true);
            return redirect('admin/absensi_kehadiran/' . Crypt::encryptString($request->id_jadwal));
        } catch (\Exception $e) {
            DB::rollback();
            AlertHelper::deleteAlert(false);
            return back();
            // something went wrong
        }
    }
    public function history_absensi($id)
    {
        $history = DB::table('absensi')
            ->select('absensi.created_at', 'hari', 'id_jadwal as id')
            ->selectRaw('count(case when kehadiran = "Hadir"  then kehadiran END) as hadir')
            ->selectRaw('count(case when kehadiran = "Tidak Hadir" then kehadiran END) as tidak_hadir')
            ->join('jadwal', 'jadwal.id', '=', 'absensi.id_jadwal')
            ->where('id_jadwal', Crypt::decryptString($id))
            ->groupBy(DB::raw('DATE_FORMAT(absensi.created_at, "%y-%m-%d")'))
            ->orderBy('absensi.created_at', 'DESC')
            ->get();
        $data = [
            'menu' => $this->menu,
            'title' => 'History Absensi',
            'lists' => $history,
        ];
        return view('absensi.list_absensi')->with($data);
    }
    public function absensi_siswa($id, $hari)
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Absensi Siswa',
            'lists' => Absensi::where('id_jadwal', Crypt::decryptString($id))
                ->where('created_at', 'like', '%' . date('Y-m-d', strtotime($hari)) . '%')
                ->orderBy('id', 'ASC')
                ->get(),
            'id' => $id,
        ];
        return view('absensi.history')->with($data);
    }
    public function belum_absensi($id)
    {
        $history = DB::table('jadwal')
            ->select('jadwal.*', 'kelas.kelas', 'siswa.id as id_siswa', 'siswa.nama_lengkap')
            ->join('kelas', 'kelas.id', '=', 'jadwal.id_kelas')
            ->join('siswa', 'siswa.id_kelas', '=', 'kelas.id')
            ->where('jadwal.id', Crypt::decryptString($id))
            ->whereNull('siswa.deleted_at')
            ->whereNull('kelas.deleted_at')
            ->whereNull('jadwal.deleted_at')
            ->whereNotIn(
                'siswa.id',
                DB::table('absensi')
                    ->select('id_siswa')
                    ->where('type', 'Siswa')
                    ->where('id_jadwal', Crypt::decryptString($id))
                    ->where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')
            )
            ->get();
        $data = [
            'menu' => $this->menu,
            'title' => 'Belum Absensi',
            'lists' => $history,
            'id_jadwal' => $id,
        ];
        return view('absensi.belum_absensi')->with($data);
    }
    public function absensi_belum_absen($id_siswa, $id_jadwal)
    {
        $data = [
            'menu' => $this->menu,
            'title' => 'Absensi Siswa',
            'list' => Siswa::findorfail(Crypt::decryptString($id_siswa)),
            'id_jadwal' => $id_jadwal,
        ];
        return view('absensi.absensi_belum_absen')->with($data);
    }
    public function absensi_update_belum_absen(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_jadwal' => 'required',
            'kehadiran' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $absensi = new Absensi;
            $absensi->id_jadwal = Crypt::decryptString($request->id_jadwal);
            $absensi->id_siswa = $request->id_siswa;
            $absensi->type = 'Siswa';
            $absensi->kehadiran = $request->kehadiran;
            $absensi->save();

            DB::commit();

            // TODO : kirim SMS GATEWAY

            AlertHelper::addAlert(true);
            return redirect('admin/belum_absensi/' . $request->id_jadwal);
        } catch (\Exception $e) {
            DB::rollback();
            AlertHelper::deleteAlert(false);
            return back();
            // something went wrong
        }
    }
}
