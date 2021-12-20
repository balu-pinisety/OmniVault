@extends('savedlinks')

@section('content')
    <div class="row" style="margin-top: 20px">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" style="margin-left: 25%">
                <h2>Edit Link</h2>
            </div>
            <div class="pull-right" style="margin-right: 25%">
                <a class="btn btn-primary" href="{{ route('savedlinks') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update', $link->id) }}" method="PUT">

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="margin-left: 25%">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="{{ $link->title }} "
                            value="{{ $link->title }}">
                    <strong>URL:</strong>
                    <input type="text" name="url" class="form-control" placeholder="{{ $link->url }}"
                           value="{{ $link->url }}">
                    <strong>Username:</strong>
                    <input type="text" name="username" class="form-control" placeholder="{{ $link->username }}"
                           value="{{ $link->username }}">
                    <strong>Password</strong>
                    <input id= "password-field" type="password" name="password" class="form-control"
                           value="{{ $decrypted_password }}">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
                        <button type="button" toggle="#password-filed" class="far fa-eye pull-right" style="margin-top: -25px; margin-right: 10px"
                           onclick="if (password.type == 'text') password.type = 'password'; else password.type = 'text';" ></button>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px; margin-left: 37.5%">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
@endsection
