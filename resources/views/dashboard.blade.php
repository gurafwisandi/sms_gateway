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
                @if (Auth::user()->roles !== 'Siswa')
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
                                <form class="form-inline float-right">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm datepicker-here"
                                            data-range="true" data-multiple-dates-separator=" - " data-language="en"
                                            placeholder="Select Date" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i
                                                    class="far fa-calendar font-size-12"></i></span>
                                        </div>
                                    </div>
                                </form>
                                <h5 class="header-title mb-4">Absensi</h5>
                                <div id="yearly-sale-chart" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
