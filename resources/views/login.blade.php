<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ trans('names.description_header') }}">
    <meta name="author" content="Ho Quoc Hai">
    <meta name="trainer" content="Nguyen Van Vuong">
    <meta name="trainer" content="Pham Van Doanh">

    <title>{{ trans('names.login_heading_panel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap theme CSS -->
    <link href="{{ asset('bower/bootstrap/dist/css/bootstrap-theme.min.css') }}" rel="stylesheet">

    <!-- Bootstrap datatable CSS -->
    <link href="{{ asset('bower/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- Login CSS -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="row" id = "head-login">
        <h1> <img src="{{ asset(config('common.system_path') . config('common.system_images.logo')) }}" with = "100px" height="100px"> {{ trans('names.project') }}</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4" id="login">
            <div class="panel panel-primary">
                <div class="panel-heading"><h2>{{ trans('names.login_heading_panel') }}</h2></div>
                <div class="panel-body">
                    @include('admin.error')
                    @if (session('message'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span class="glyphicon glyphicon-minus-sign"></span> {{ session('message') }}
                        </div>
                    @endif
                    {{ Form::open(['route' => 'postLogin', 'method' => 'POST']) }}
                    <div class="form-group">
                        {{ Form::label(trans('user/names.label_key.label_key_email'), trans('user/names.label.user_email') . trans('names.required')) }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_email_placeholder')]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label(trans('user/names.label_key.label_key_password'), trans('user/names.label.user_password') . trans('names.required')) }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_password_placeholder')]) }}
                    </div>
                    {{ Form::button('<span class="glyphicon glyphicon-log-in"></span> ' . trans('names.login_heading_panel'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
<!-- jQuery -->
<script src="{{ asset('bower/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- jQuery Datatable JavaScript -->
<script src="{{ asset('bower/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<!-- Bootstrap Datatable JavaScript -->
<script src="{{ asset('bower/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

</body>
</html>
