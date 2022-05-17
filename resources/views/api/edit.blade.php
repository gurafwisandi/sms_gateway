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
                                <form class="custom-validation" action="{{ route('admin.api_update') }}" method="POST"
                                    novalidate>
                                    @csrf
                                    <input type="hidden" class="id" id="id" name="id"
                                        value="{{ $list->id }}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Notifikasi</label>
                                                <select class="form-control" name="notifikasi" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="SMS"
                                                        {{ $list->notifikasi === 'SMS' ? 'selected' : '' }}>SMS</option>
                                                    <option value="WA" {{ $list->notifikasi === 'WA' ? 'selected' : '' }}>
                                                        WhatsApp
                                                    </option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('notifikasi') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Url</label>
                                                <input type="text" class="form-control" name="url" required
                                                    value="{{ $list->url }}" placeholder="Url" />
                                                <small class="text-danger">{{ $errors->first('url') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Userkey</label>
                                                <input type="text" class="form-control" name="userkey" required
                                                    value="{{ $list->userkey }}" placeholder="Userkey" />
                                                <small class="text-danger">{{ $errors->first('userkey') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Passkey</label>
                                                <input type="text" class="form-control" name="passkey" required
                                                    value="{{ $list->passkey }}" placeholder="Passkey" />
                                                <small class="text-danger">{{ $errors->first('passkey') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div>
                                            <a href="{{ route('admin.api') }}" class="btn btn-secondary waves-effect">
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
