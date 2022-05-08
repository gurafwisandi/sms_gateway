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
                                <form class="custom-validation" action="{{ route('admin.user_store') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="name" required
                                                    value="{{ old('name') }}"
                                                    oninput="this.value = this.value.toUpperCase()" placeholder="Nama" />
                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" required
                                                    value="{{ old('email') }}" placeholder="Email" />
                                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" required
                                                    placeholder="Password" />
                                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Foto</label>
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="validationCustomFile"
                                                        name="foto">
                                                </div>
                                                <small class="text-danger">{{ $errors->first('foto') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Roles</label>
                                            <select class="form-control" name="roles" required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Siswa">Siswa</option>
                                            </select>
                                            <small class="text-danger">{{ $errors->first('roles') }}</small>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('admin.user') }}" class="btn btn-secondary waves-effect">
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
