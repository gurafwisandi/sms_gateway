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
                                            <th>Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lists as $list)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $list->kelas->kelas }}</td>
                                                <td>{{ $list->matpel->matpel }}</td>
                                                <td>{{ $list->guru->nama }}</td>
                                                <td>{{ $list->hari }}</td>
                                                <td>{{ $list->jam_mulai }}</td>
                                                <td>{{ $list->jam_selesai }}</td>
                                                <td>
                                                    <?php $id = Crypt::encryptString($list->id); ?>
                                                    <div class="btn-group" role="group">
                                                        <?php
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
                                                        ?>
                                                        @if (strtoupper($dayList[$day]) === $list->hari)
                                                            <a href="{{ route('admin.absensi_kehadiran', ['id' => $id]) }}"
                                                                class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                                data-placement="top" title="Absensi">
                                                                <i class="mdi mdi-barcode-scan"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('admin.history_absensi', ['id' => $id]) }}"
                                                            class="btn btn-info btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="History Absensi">
                                                            <i class="mdi mdi-history"></i>
                                                        </a>
                                                    </div>
                                                </td>
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
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        $('.delete_confirm').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Data',
                text: 'Ingin menghapus data?',
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
    </script> --}}
@endsection
