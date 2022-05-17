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
                                <form class="custom-validation" action="{{ route('admin.sekolah_update') }}" method="POST"
                                    novalidate>
                                    @csrf
                                    <input type="hidden" class="id" id="id" name="id"
                                        value="{{ $list->id }}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kode</label>
                                                <input type="text" class="form-control" name="kode" required
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    value="{{ $list->kode }}" placeholder="Kode" />
                                                <small class="text-danger">{{ $errors->first('kode') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Sekolah</label>
                                                <input type="text" class="form-control" name="sekolah" required
                                                    oninput="this.value = this.value.toUpperCase()"
                                                    value="{{ $list->sekolah }}" placeholder="Sekolah" />
                                                <small class="text-danger">{{ $errors->first('sekolah') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <div>
                                                    <textarea required name="alamat" class="form-control" placeholder="Alamat" rows="5">{{ $list->alamat }}</textarea>
                                                    <small class="text-danger">{{ $errors->first('alamat') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Notifikasi</label>
                                                <select class="form-control" name="notifikasi" required>
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($notifikasi as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id === $list->id_api ? 'selected' : '' }}>
                                                            {{ $item->notifikasi }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger">{{ $errors->first('notifikasi') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div>
                                            <a href="{{ route('admin.sekolah') }}"
                                                class="btn btn-secondary waves-effect">
                                                Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                Simpan
                                            </button>
                                        </div>
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
