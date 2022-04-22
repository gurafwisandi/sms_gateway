@extends('layouts.main')
@section('container')
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">{{ ucwords($menu) }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ ucwords($list) }}</a></li>
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
                                <form class="custom-validation" action="#">
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <input type="text" class="form-control" required placeholder="Mata Pelajaran" />
                                    </div>
                                    <div class="form-group mb-0">
                                        <div>
                                            <a href="{{ route('admin.matpel') }}" class="btn btn-secondary waves-effect">
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
