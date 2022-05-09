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
                    <div class="col-xl-12">
                        <div class="timeline" dir="ltr">
                            <div class="timeline-item timeline-left">
                                <div class="timeline-block">
                                    <div class="time-show-btn mt-0">
                                        <a href="#" class="btn btn-success w-lg">Kehadiran</a>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-block">
                                    <div class="timeline-box card">
                                        <div class="card-body">
                                            <div class="timeline-icon icons-md">
                                                <i class="uim uim-layer-group"></i>
                                            </div>
                                            <div class="d-inline-block py-1 px-3 bg-primary text-white badge-pill">
                                                Full Stack Developer
                                            </div>
                                            <i class="mdi mdi-message-alert"></i>
                                            <p class="mt-3 mb-2">{{ now() }} - Hadir</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-block">
                                    <div class="timeline-box card">
                                        <div class="card-body">
                                            <div class="timeline-icon icons-md">
                                                <i class="uim uim-layer-group"></i>
                                            </div>
                                            <div class="d-inline-block py-1 px-3 bg-primary text-white badge-pill">
                                                Full Stack Developer
                                            </div>
                                            <i class="mdi mdi-message-bulleted"></i>
                                            <p class="mt-3 mb-2">{{ now() }} - Hadir</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item timeline-left">
                                <div class="timeline-block">
                                    <div class="timeline-box card">
                                        <div class="card-body">
                                            <div class="timeline-icon icons-md">
                                                <i class="uim uim-layer-group"></i>
                                            </div>
                                            <div class="d-inline-block py-1 px-3 bg-danger text-white badge-pill">
                                                Backend Developer
                                            </div>
                                            <p class="mt-3 mb-2">{{ now() }} - Tidak Hadir</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item timeline-left">
                                <div class="timeline-block">
                                    <div class="timeline-box card">
                                        <div class="card-body">
                                            <div class="timeline-icon icons-md">
                                                <i class="uim uim-layer-group"></i>
                                            </div>
                                            <div class="d-inline-block py-1 px-3 bg-success text-white badge-pill">
                                                Backend Developer
                                            </div>
                                            <p class="mt-3 mb-2">{{ now() }} - Tidak Hadir</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
