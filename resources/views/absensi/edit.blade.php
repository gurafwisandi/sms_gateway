@extends('layouts.main')
@section('container')
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">{{ ucwords($menu) }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ ucwords($title) }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="custom-validation" action="{{ route('admin.absensi_update') }}" method="POST"
                                    novalidate>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $list->id }}">
                                    <input type="hidden" name="kehadiran_old" value="{{ $list->kehadiran }}">
                                    <input type="hidden" name="id_jadwal" value="{{ $list->id_jadwal }}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $list->siswa->nama_lengkap }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $list->created_at }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kehadiran</label>
                                                <select class="form-control" name="kehadiran" id="kehadiran">
                                                    <option value="Hadir"
                                                        {{ $list->kehadiran === 'Hadir' ? 'selected' : '' }}>Hadir
                                                    </option>
                                                    <option value="Tidak Hadir"
                                                        {{ $list->kehadiran === 'Tidak Hadir' ? 'selected' : '' }}>Tidak
                                                        Hadir
                                                    </option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('kehadiran') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div>
                                            <?php $idjadwal = Crypt::encryptString($list->id_jadwal); ?>
                                            <a href="{{ route('admin.absensi_kehadiran', ['id' => $idjadwal]) }}"
                                                class="btn btn-secondary waves-effect">
                                                Kembali
                                            </a>
                                            <button type="submit" id="save"
                                                class="btn btn-primary waves-effect waves-light mr-1">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
