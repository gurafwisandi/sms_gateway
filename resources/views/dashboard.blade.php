@extends('layouts.main')
@section('container')
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Dashboard</h4>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="container-fluid">
                @if (Auth::user()->roles === 'Admin')
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Data Akun</h5>
                                            <div class="mt-4">
                                                <a href="{{ route('admin.user') }}" class="btn btn-primary btn-sm">View
                                                    more
                                                    <i class="mdi mdi-arrow-right ml-1"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-5 ml-auto">
                                            <div>
                                                <h1 class="display-4">{{ count($akun) }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Data Guru</h5>
                                            <div class="mt-4">
                                                <a href="{{ route('admin.guru') }}" class="btn btn-primary btn-sm">View
                                                    more
                                                    <i class="mdi mdi-arrow-right ml-1"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-5 ml-auto">
                                            <div>
                                                <h1 class="display-4">{{ count($guru) }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Data Siswa</h5>
                                            <div class="mt-4">
                                                <a href="{{ route('admin.siswa') }}" class="btn btn-primary btn-sm">View
                                                    more
                                                    <i class="mdi mdi-arrow-right ml-1"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-5 ml-auto">
                                            <div>
                                                <h1 class="display-4">{{ count($siswa) }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">Absensi Per-Tanggal - {{ date('d F Y') }}</h5>
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Siswa Hadir</th>
                                            <th>Siswa Tidak Hadir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $list)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $list->kelas }}</td>
                                                <td>{{ $list->matpel }}</td>
                                                <td>{{ $list->nama }}</td>
                                                <td>{{ $list->hadir }}</td>
                                                <td>{{ $list->tidak_hadir }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
