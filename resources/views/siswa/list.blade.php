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
                            @if (Auth::user()->roles === 'Admin')
                                <a href="{{ route('admin.siswa_add') }}"
                                    class="btn btn-light btn-rounded dropdown-toggle">
                                    <i class="mdi mdi mdi-plus-thick mr-1"></i> Tambah
                                </a>
                            @elseif (Auth::user()->roles === 'Siswa')
                                @if ($cek < 1)
                                    <a href="{{ route('admin.siswa_add') }}"
                                        class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi mdi-plus-thick mr-1"></i> Tambah
                                    </a>
                                @endif
                            @endif
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
                                            <th>Nis</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lists as $list)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $list->nis }}</td>
                                                <td>{{ $list->nama_lengkap }}</td>
                                                <td>{{ $list->jenis_kelamin }}</td>
                                                <td>{{ isset($list->kelas->kelas) ? $list->kelas->kelas : '' }}</td>
                                                <td>
                                                    <?php $id = Crypt::encryptString($list->id); ?>
                                                    <form class="delete-form"
                                                        action="{{ route('admin.siswa_destroy', ['id' => $id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.siswa_view', ['id' => $id]) }}"
                                                                class="btn btn-info btn-sm" data-toggle="tooltip"
                                                                data-placement="top" title="View">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            @if (Auth::user()->roles === 'Admin' or Auth::user()->roles === 'Siswa')
                                                                <a href="{{ route('admin.siswa_edit', ['id' => $id]) }}"
                                                                    class="btn btn-warning btn-sm" data-toggle="tooltip"
                                                                    data-placement="top" title="Edit">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </a>
                                                            @endif
                                                            @if (Auth::user()->roles === 'Admin')
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm delete_confirm"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Delete">
                                                                    <i class="mdi mdi-trash-can"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </form>
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
    <script src="{{ asset('assets/alert.js') }}"></script>
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
    </script>
@endsection
