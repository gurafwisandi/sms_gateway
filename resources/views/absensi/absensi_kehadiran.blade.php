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
                            @if (Auth::user()->roles === 'Guru')
                                @if (count($last_mulai) > 0 and count($last_selesai) > 0)
                                    @if (date('Y-m-d', strtotime($last_mulai[0]->created_at)) === date('Y-m-d') and date('Y-m-d', strtotime($last_selesai[0]->created_at)) !== date('Y-m-d'))
                                        <form class="delete-form"
                                            action="{{ route('admin.absensi_selesai', ['id' => $id]) }}" method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-light btn-rounded dropdown-toggle"
                                                data-toggle="modal" data-target=".bs-example-modal-center"><i
                                                    class="mdi mdi-qrcode-scan"></i> Barcode Siswa
                                                Absensi</button>

                                            @if ($jml_kelas === $lists->where('type', 'Siswa')->count())
                                                <button type="button"
                                                    class="btn btn-light btn-rounded dropdown-toggle absensi_selesai"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Guru Selesai Mengajar">
                                                    <i class="mdi mdi-account-multiple-check-outline"></i> Guru Selesai
                                                    Mengajar
                                                </button>
                                            @endif
                                        </form>
                                    @elseif (date('Y-m-d', strtotime($last_selesai[0]->created_at)) !== date('Y-m-d'))
                                        <form class="delete-form"
                                            action="{{ route('admin.absensi_mulai', ['id' => $id]) }}" method="POST">
                                            @csrf
                                            <button type="button"
                                                class="btn btn-light btn-rounded dropdown-toggle absensi_mulai"
                                                data-toggle="tooltip" data-placement="top" title="Guru Mulai Mengajar">
                                                <i class="mdi mdi-account-multiple-check-outline"></i> Guru Mulai Mengajar
                                            </button>
                                        </form>
                                    @endif
                                @elseif (count($last_mulai) > 0 and count($last_selesai) < 1)
                                    @if ($jml_kelas === $lists->where('type', 'Siswa')->count())
                                        <form class="delete-form"
                                            action="{{ route('admin.absensi_selesai', ['id' => $id]) }}" method="POST">
                                            @csrf
                                            <button type="button"
                                                class="btn btn-light btn-rounded dropdown-toggle absensi_selesai"
                                                data-toggle="tooltip" data-placement="top" title="Guru Selesai Mengajar">
                                                <i class="mdi mdi-account-multiple-check-outline"></i> Guru Selesai Mengajar
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <form class="delete-form"
                                        action="{{ route('admin.absensi_mulai', ['id' => $id]) }}" method="POST">
                                        @csrf
                                        <button type="button"
                                            class="btn btn-light btn-rounded dropdown-toggle absensi_mulai"
                                            data-toggle="tooltip" data-placement="top" title="Guru Mulai Mengajar">
                                            <i class="mdi mdi-account-multiple-check-outline"></i> Guru Mulai Mengajar
                                        </button>
                                    </form>
                                @endif
                            @elseif (Auth::user()->roles === 'Siswa')
                                <button type="button" class="btn btn-light btn-rounded dropdown-toggle" data-toggle="modal"
                                    data-target=".bs-example-modal-center-siswa"><i class="mdi mdi-qrcode-scan"></i> Barcode
                                    Siswa
                                    Absensi</button>
                            @endif
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
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card border mb-0">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div class="icons-xl uim-icon-primary my-4">
                                                    <i class="uim uim-schedule"></i>
                                                </div>
                                                <h4 class="alert-heading font-size-20">
                                                    <?php
                                                    $hadir = $lists
                                                        ->where('type', 'Siswa')
                                                        ->where('kehadiran', 'Hadir')
                                                        ->count();
                                                    $tidak_hadir = $lists
                                                        ->where('type', 'Siswa')
                                                        ->where('kehadiran', 'Tidak Hadir')
                                                        ->count();
                                                    $belum_absensi = $jml_kelas - $hadir - $tidak_hadir;
                                                    ?>
                                                    {{ $jml_kelas }}
                                                </h4>
                                                <p class="text-muted">Jumlah Siswa</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card border mb-0">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div class="icons-xl uim-icon-success my-4">
                                                    <i class="uim uim-check-circle"></i>
                                                </div>
                                                <h4 class="alert-heading font-size-20">
                                                    {{ $hadir }}
                                                </h4>
                                                <p class="text-muted">Hadir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    @if ($belum_absensi > 0)
                                        <?php $url = route('admin.belum_absensi', ['id' => $id]); ?>
                                    @else
                                        <?php $url = '#'; ?>
                                    @endif
                                    <a href="{{ $url }}" data-toggle="tooltip" data-placement="top"
                                        title="Belum Absensi">
                                        <div class="card noti border mt-4 mt-lg-0 mb-0">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <div class="icons-xl uim-icon-warning my-4">
                                                        <i class="uim uim-exclamation-triangle"></i>
                                                    </div>
                                                    <h4 class="alert-heading font-size-20">
                                                        {{ $belum_absensi }}
                                                    </h4>
                                                    <p class="text-muted">Belum Absensi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card noti border mt-4 mt-lg-0 mb-0">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div class="icons-xl uim-icon-danger my-4">
                                                    <i class="uim uim-times-circle"></i>
                                                </div>
                                                <h4 class="alert-heading font-size-20">
                                                    {{ $tidak_hadir }}
                                                </h4>
                                                <p class="text-muted">Tidak Hadir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Hari</th>
                                        <th>Nama</th>
                                        <th>Type</th>
                                        <th>Tanggal</th>
                                        <th>Kehadiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $list)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $list->jadwal->kelas->kelas }}</td>
                                            <td>{{ $list->jadwal->hari }}</td>
                                            <td>{{ $list->id_guru ? $list->guru->nama : $list->siswa->nama_lengkap }}
                                            </td>
                                            <td>{{ $list->type }}</td>
                                            <td>{{ $list->created_at }}</td>
                                            <td>{{ $list->kehadiran }}</td>
                                            <td>
                                                @if ($list->type === 'Siswa' and Auth::user()->roles !== 'Siswa')
                                                    <?php $id_list = Crypt::encryptString($list->id); ?>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.absensi_edit', ['id' => $id_list]) }}"
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
    {{-- barcode absensi --}}
    <?php preg_match('/(chrome|firefox|avantgo|blackberry|android|blazer|elaine|hiptop|iphone|ipod|kindle|midp|mmp|mobile|o2|opera mini|palm|palm os|pda|plucker|pocket|psp|smartphone|symbian|treo|up.browser|up.link|vodafone|wap|windows ce; iemobile|windows ce; ppc;|windows ce; smartphone;|xiino)/i', $_SERVER['HTTP_USER_AGENT'], $version); ?>
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        @if ($version[1] == 'Android' || $version[1] == 'Mobile' || $version[1] == 'iPhone')
            <div class="modal-dialog modal-dialog-centered" style="width: 75%">
            @else
                <div class="modal-dialog modal-dialog-centered" style="width: 21%">
        @endif
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Barcode Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $data_barcode = Crypt::encryptString($barcode->id . '|' . $barcode->id_guru); ?>
                {!! QrCode::size(250)->generate($data_barcode) !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog- -->
    </div><!-- /.modal-end -->

    {{-- barcode absensi siswa --}}
    <div class="modal fade bs-example-modal-center-siswa" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Barcode Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (Auth::user()->roles === 'Siswa')
                        <div id="qr-reader" style="width:100%"></div>
                        <div id="qr-reader-results"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    {{-- js qrcode --}}
    <script src="{{ asset('assets/html5-qrcode.min.js') }}" type="text/javascript"></script>
    <script>
        // start qrcode
        function docReady(fn) {
            if (document.readyState === "complete" ||
                document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }
        docReady(function() {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.qrcode_siswa') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            decodedText,
                        },
                        success: (response) => {
                            console.log(response)
                            var APP_URL = {!! json_encode(url('/')) !!}
                            if (response.code === 200) {
                                Swal.fire(
                                    'Berhasil',
                                    `${response.message}`,
                                    'success',
                                ).then(function() {
                                    // window.location = APP_URL + '/admin/absensi_kehadiran/' +
                                    //     response.id
                                    // kirim notifikasi API
                                    window.location = APP_URL + '/admin/notifikasi_kehadiran/' +
                                        response.idx
                                })
                            } else {
                                Swal.fire(
                                    'Gagal',
                                    `${response.message}`,
                                    'error',
                                ).then(function() {
                                    window.location = APP_URL + '/admin/absensi_kehadiran/' +
                                        response.id
                                })
                            }
                        },
                    })
                }
            }
            var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                fps: 10,
                qrbox: 250
            });
            html5QrcodeScanner.render(onScanSuccess);
        });
        // end qrcode

        // cek sudah allow camera belum
        navigator.permissions.query({
                name: 'camera'
            })
            .then((permission) => {
                if (permission.state === 'granted') {} else {
                    Swal.fire(
                        'Primession',
                        'Primession wajib di Allow!',
                        'error'
                    )
                }
            }).catch((error) => {
                console.log('Got error :', error);
            })
        // cek sudah allow camera belum

        $('.absensi_selesai').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Absensi',
                text: 'Ingin Selesai Mengajar?',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Batal",
                focusConfirm: false,
            }).then((value) => {
                if (value.isConfirmed) {
                    $(this).closest("form").submit()
                }
            });
        });
        $('.absensi_mulai').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Absensi',
                text: 'Ingin Mulai Mengajar?',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Batal",
                focusConfirm: false,
            }).then((value) => {
                if (value.isConfirmed) {
                    $(this).closest("form").submit()
                }
            });
        });
    </script>
@endsection
