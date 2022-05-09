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
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" class="id" id="id" name="id" value="{{ $list->id }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select class="form-control" name="id_kelas" id="id_kelas">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($kelas as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $list->id_kelas === $item->id ? 'selected' : '' }}>
                                                        {{ $item->kelas }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('id_kelas') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Mata Pelajaran</label>
                                            <select class="form-control" name="id_matpel" id="id_matpel">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($matpel as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $list->id_matpel === $item->id ? 'selected' : '' }}>
                                                        {{ $item->matpel }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('id_matpel') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Guru</label>
                                            <select class="form-control" name="id_guru" id="id_guru">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($guru as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $list->id_guru === $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('id_guru') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input type="time" class="form-control" name="jam_mulai" id="jam_mulai"
                                                value="{{ $list->jam_mulai }}" placeholder="Jam Mulai" />
                                            <small class="text-danger">{{ $errors->first('jam_mulai') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input type="time" class="form-control" name="jam_selesai" id="jam_selesai"
                                                value="{{ $list->jam_selesai }}" placeholder="Jam Selesai" />
                                            <small class="text-danger">{{ $errors->first('jam_selesai') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <a href="{{ route('admin.jadwal') }}" class="btn btn-secondary waves-effect">
                                            Kembali
                                        </a>
                                        <button type="submit" id="save"
                                            class="btn btn-primary waves-effect waves-light mr-1">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#save").on('click', function() {
            id = document.getElementById("id").value;
            id_kelas = document.getElementById("id_kelas").value;
            id_matpel = document.getElementById("id_matpel").value;
            id_guru = document.getElementById("id_guru").value;
            jam_mulai = document.getElementById("jam_mulai").value;
            jam_selesai = document.getElementById("jam_selesai").value;

            if (id === '' || id_kelas === '' || id_matpel === '' || id_guru === '' || jam_mulai === '' ||
                jam_selesai === '') {
                Swal.fire(
                    'Gagal',
                    'Semua data wajib di isi',
                    'error',
                ).then(function() {})
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.jadwal_update') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id,
                    id_kelas,
                    id_matpel,
                    id_guru,
                    jam_mulai,
                    jam_selesai,
                },
                success: (response) => {
                    var APP_URL = {!! json_encode(url('/')) !!}
                    if (response.code === 200) {
                        window.location = APP_URL + '/admin/jadwal'
                    } else {
                        Swal.fire(
                            'Gagal',
                            `${response.message}`,
                            'error'
                        ).then(function() {})
                    }
                },
            })
        })
    </script>
@endsection
