@extends('savedlinks')

@section('content')
    <div class="row" style="margin-top: 20px">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" style="margin-left: 25%">
                <h2>Add New Link</h2>
            </div>
            <div class="pull-right" style="margin-right: 25%">
                <a class="btn btn-primary" data-toggle="modal" id="smallButton" data-target="#smallModal"
                   data-attr="{{ route('savedlinks') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
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
    <form action="{{ route('storelink') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6" style="margin-left: 25%">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Enter Title">
                    <strong>URL:</strong>
                    <input type="text" name="url" class="form-control" placeholder="Enter URL">
                    <strong>Username:</strong>
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                    <strong>Password:</strong>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password"
                           onmouseover="this.type='text'" onmouseout="this.type='password'" placeholder="password">
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px; margin-left: 37.5%">Add Link</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Get back modal -->
    <div class="modal fade " id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-left " style="font-weight: bolder; font-size: 25px; margin-left: 5%">
                        Alert:
                    </h5>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close" style="margin-right: 2.5%; margin-top: 1%">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                        <form action="{{route('savedlinks')}}" method="get">
                            <div class="modal-body">
                                @csrf
                                <h5 class="text-center">Are you sure you want to Go Back?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger pull-right">Yes</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash')});

        // display a modal (medium modal)
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                }
                , complete: function() {
                    $('#loader').hide();
                }
                , error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                }
                , timeout: 8000
            })
        });


    </script>


@endsection
