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
                                <form class="custom-validation" action="{{ route('admin.guru_store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nis</label>
                                                <input type="number" class="form-control" name="nis" required
                                                    value="{{ old('nis') }}" placeholder="Nis" />
                                                <small class="text-danger">{{ $errors->first('nis') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" name="nama_lengkap" required
                                                    value="{{ old('nama_lengkap') }}"
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    placeholder="Nama Lengkap" />
                                                <small class="text-danger">{{ $errors->first('nama_lengkap') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                            <small class="text-danger">{{ $errors->first('jenis_kelamin') }}</small>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <div>
                                                    <textarea required name="alamat" class="form-control" placeholder="Alamat" rows="5">{{ old('alamat') }}</textarea>
                                                    <small class="text-danger">{{ $errors->first('alamat') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>User</label>
                                            <select class="form-control" name="id_user" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name . ' - ' . $item->email }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">{{ $errors->first('id_user') }}</small>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Kelas</label>
                                            <select class="form-control" name="id_kelas">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($kelas as $item)
                                                    <option value="{{ $item->id }}">
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
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Simpan
                                        </button>
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