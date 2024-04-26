@extends('layouts.simple.master')
@section('title', 'Edit Role')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/dropzone.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Edit<span>Role</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Blog</li>
    <a href="{{ route('roles.index') }}" class="breadcrumb-item">Role List</a>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Role</h5>
                    </div>
                    <div class="card-body add-post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="row needs-validation themeform" method="post" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-sm-12">
                                <!--<input type="hidden" value="blog" name="home_for">-->
                                <div class="form-group">
                                    <label for="name">Enter Role:</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Role" name="name" value="{{ old('name', $role->name) }}">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                
                                <div class="form-group">
                                <label>Permissions</label><br>
                                @foreach($permissions as $permission)
                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}> {{ $permission->name }}<br>
                                @endforeach
                            </div>

                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="submit">Submit</button>
                                <input class="btn btn-light btn-pill" type="reset" value="Discard">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ route('/') }}/assets/js/select2/select2.full.min.js"></script>
    <script src="{{ route('/') }}/assets/js/select2/select2-custom.js"></script>
    <script src="{{ route('/') }}/assets/js/dropzone/dropzone.js"></script>
    <script src="{{ route('/') }}/assets/js/dropzone/dropzone-script.js"></script>
    <script src="{{ route('/') }}/assets/js/chat-menu.js"></script>
    <script src="{{ route('/') }}/assets/js/email-app.js"></script>
    <script src="{{ route('/') }}/assets/js/form-validation-custom.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/styles.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endsection
