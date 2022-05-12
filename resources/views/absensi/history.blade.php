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
                                        <a href="{{ route('admin.history_absensi', ['id' => $id]) }}"
                                            class="btn btn-secondary w-lg">Kembali</a>
                                    </div>
                                </div>
                            </div>
                            @foreach ($lists as $item)
                                @if ($item->type === 'Guru')
                                    <?php $class = 'timeline-item'; ?>
                                @else
                                    @if ($item->kehadiran === 'Hadir')
                                        <?php
                                        $class = 'timeline-item';
                                        $kehadiran = 'primary';
                                        ?>
                                    @else
                                        <?php
                                        $class = 'timeline-item timeline-left';
                                        $kehadiran = 'danger';
                                        ?>
                                    @endif
                                @endif
                                <div class="{{ $class }}">
                                    <div class="timeline-block">
                                        <div class="timeline-box card">
                                            <div class="card-body">
                                                <div class="timeline-icon icons-md">
                                                    <i class="uim uim-layer-group"></i>
                                                </div>
                                                @if ($item->type === 'Guru')
                                                    <div class="d-inline-block py-1 px-3 bg-success text-white badge-pill">
                                                        {{ $item->guru->nama . ' - Guru' }}
                                                    </div>
                                                    <p class="mt-3 mb-2">{{ $item->created_at }} -
                                                        {{ $item->kehadiran . ' Mengajar' }}</p>
                                                @else
                                                    <div
                                                        class="d-inline-block py-1 px-3 bg-{{ $kehadiran }} text-white badge-pill">
                                                        {{ $item->siswa->nama_lengkap . ' - Siswa' }}
                                                    </div>
                                                    <i class="mdi mdi-clock-check-outline"></i>
                                                    <p class="mt-3 mb-2">{{ $item->created_at }} -
                                                        {{ $item->kehadiran }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
