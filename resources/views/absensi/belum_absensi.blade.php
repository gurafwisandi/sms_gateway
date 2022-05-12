@extends('layouts.main')
@section('container')
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">{{ ucwords($menu) }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ ucwords($title) }}</a></li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right">
                        </div>
                    </div>
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
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Hari</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $list)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $list->kelas }}</td>
                                            <td>{{ $list->hari }}</td>
                                            <td>{{ $list->nama_lengkap }}</td>
                                            <td>
                                                @if (Auth::user()->roles !== 'Siswa')
                                                    <?php $id_siswa = Crypt::encryptString($list->id_siswa); ?>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.absensi_belum_absen', ['id_siswa' => $id_siswa, 'id_jadwal' => $id_jadwal]) }}"
                                                            class="btn btn-info btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="Absensi">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <div class="form-group mb-0">
                                <div>
                                    <a href="{{ route('admin.absensi_kehadiran', ['id' => $id_jadwal]) }}"
                                        class="btn btn-secondary waves-effect">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
