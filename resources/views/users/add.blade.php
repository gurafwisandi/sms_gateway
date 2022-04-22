@extends('layouts.main')
@section('container')
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">{{ $menu }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $list }}</a></li>
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
                                        <label>Required</label>
                                        <input type="text" class="form-control" required placeholder="Type something" />
                                    </div>

                                    <div class="form-group">
                                        <label>Equal To</label>
                                        <div>
                                            <input type="password" id="pass2" class="form-control" required
                                                placeholder="Password" />
                                        </div>
                                        <div class="mt-2">
                                            <input type="password" class="form-control" required
                                                data-parsley-equalto="#pass2" placeholder="Re-Type Password" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>E-Mail</label>
                                        <div>
                                            <input type="email" class="form-control" required parsley-type="email"
                                                placeholder="Enter a valid e-mail" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>URL</label>
                                        <div>
                                            <input parsley-type="url" type="url" class="form-control" required
                                                placeholder="URL" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Digits</label>
                                        <div>
                                            <input data-parsley-type="digits" type="text" class="form-control" required
                                                placeholder="Enter only digits" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Number</label>
                                        <div>
                                            <input data-parsley-type="number" type="text" class="form-control" required
                                                placeholder="Enter only numbers" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alphanumeric</label>
                                        <div>
                                            <input data-parsley-type="alphanum" type="text" class="form-control" required
                                                placeholder="Enter alphanumeric value" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Textarea</label>
                                        <div>
                                            <textarea required class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect">
                                                Cancel
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
