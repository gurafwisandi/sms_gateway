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
                                <form class="custom-validation" action="{{ route('admin.siswa_update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="id" id="id" name="id"
                                        value="{{ $list->id }}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nis</label>
                                                <input type="number" class="form-control" name="nis" disabled
                                                    value="{{ $list->nis }}" placeholder="Nis" />
                                                <small class="text-danger">{{ $errors->first('nis') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" name="nama_lengkap" disabled
                                                    value="{{ $list->nama }}"
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    placeholder="Nama Lengkap" />
                                                <small class="text-danger">{{ $errors->first('nama_lengkap') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" disabled>
                                                <option value="">-- Pilih --</option>
                                                <option value="Pria"
                                                    {{ $list->jenis_kelamin === 'Pria' ? 'selected' : '' }}>Pria</option>
                                                <option value="Wanita"
                                                    {{ $list->jenis_kelamin === 'Wanita' ? 'selected' : '' }}>Wanita
                                                </option>
                                            </select>
                                            <small class="text-danger">{{ $errors->first('jenis_kelamin') }}</small>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <div>
                                                    <textarea disabled name="alamat" class="form-control" placeholder="Alamat" rows="5">{{ $list->alamat }}</textarea>
                                                    <small class="text-danger">{{ $errors->first('alamat') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>User</label>
                                            <select class="form-control" name="id_user" disabled>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $list->id_user === $item->id ? 'selected' : '' }}>
                                                        {{ $item->name . ' - ' . $item->email }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('id_user') }}</small>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Kelas</label>
                                            <select class="form-control" name="id_kelas" disabled>
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
                                    <div class="mt-4">
                                        <a href="{{ route('admin.guru') }}" class="btn btn-secondary waves-effect">
                                            Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
