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
                                <form>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mt-3 mt-md-0">
                                                <h5 class="font-size-14">Kelas</h5>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="kelas" id="kelas">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($kelas as $item)
                                                            <option value="{{ $item->id }}" <?php
                                                            if (isset($_GET['kelas']) and $_GET['kelas'] != '' and $item->id == $_GET['kelas']) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                {{ $item->kelas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-3 mt-md-0">
                                                <h5 class="font-size-14">Mata pelajaran</h5>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="matpel" id="matpel">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($matpel as $item)
                                                            <option value="{{ $item->id }}" <?php
                                                            if (isset($_GET['matpel']) and $_GET['matpel'] != '' and $item->id == $_GET['matpel']) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                {{ $item->matpel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-3 mt-md-0">
                                                <h5 class="font-size-14">Guru</h5>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="guru" id="guru">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($guru as $item)
                                                            <option value="{{ $item->id }}" <?php
                                                            if (isset($_GET['guru']) and $_GET['guru'] != '' and $item->id == $_GET['guru']) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-3 mt-md-0">
                                                <h5 class="font-size-14">&nbsp;</h5>
                                                <button type="submit" id="save" class="btn btn-primary btn-sm">
                                                    Cari
                                                </button>
                                                <a href="{{ route('admin.laporan_jadwal') }}"
                                                    class="btn btn-secondary btn-sm">
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
