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
                    <div class="col-md-4">
                        <div class="float-right">
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
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah Siswa</th>
                                            <th>Jumlah Hadir</th>
                                            <th>Jumlah Tidak Hadir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lists as $list)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $list->hari }}</td>
                                                <td>{{ date('d F Y', strtotime($list->created_at)) }}</td>
                                                <td>{{ $list->hadir + $list->tidak_hadir }}</td>
                                                <td>{{ $list->hadir }}</td>
                                                <td>{{ $list->tidak_hadir }}</td>
                                                <td>
                                                    <?php
                                                    $id = Crypt::encryptString($list->id);
                                                    ?>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.absensi_siswa', ['id' => $id, 'hari' => $list->created_at]) }}"
                                                            class="btn btn-success btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="Absensi Siswa">
                                                            <i class="mdi mdi-account-multiple-check-outline"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="form-group mb-0">
                                    <div>
                                        <a href="{{ route('admin.absensi') }}" class="btn btn-secondary waves-effect">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
@endsection
