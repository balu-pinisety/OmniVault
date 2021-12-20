@extends('savedlinks')

@section('content')

    <div class="row" style="margin-top: 20px">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" style="margin-left: 6.25%; color: darkblue">
                <h1>Saved Links</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('create') }}" title="Create a link">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="margin-top: 20px">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table id="linksTable" class="table table-bordered table-responsive-lg">
        <tr>
            <th width="70px" style="text-align:center">S.No</th>
            <th width="140px" style="text-align:center">Title</th>
            <th width="280px" style="text-align:center">URL</th>
            <th width="140px" style="text-align:center">Username</th>
            <th width="140px" style="text-align:center">Password</th>
            <th width="175px" style="text-align:center">Action</th>
        </tr>

        @foreach ($links as $link)
            <tr>
                <td style="text-align:center">{{$loop->iteration}}</td>
                <td style="text-align:center">{{ $link->title }}</td>
                <td style="text-align:center">{{ $link->url }}</td>
                <td style="text-align:center">{{ $link->username }}</td>
                <td style="text-align:center">*********</td>
                <td style="text-align:center">
                    <div >
                        <a data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                           data-attr="showlink/{{$link->id}}" title="Show">
                            <i class="fas fa-eye showpassword fa-lg" style="color: #1a202c"></i>
                        </a>
                        <a href="editlink/{{$link->id}}" title="Edit">
                            <i class="fas fa-edit text-success fa-lg"></i>
                        </a>
                        <a data-toggle="modal" id="smallButton" data-target="#smallModal"
                           data-attr="deletelink/{{$link->id}}" title="Delete">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </a>
                        <a data-toggle="modal" id="largeButton" data-target="#largeModal"
                           data-attr="sharelink/{{$link->id}}" title="Share">
                            <i class="fas fa-share fa-lg"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>


    <!-- small modal -->
    <div class="modal fade " id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-left " style="font-weight: bolder; font-size: 25px; margin-left: 5%">
                       Delete Link:
                    </h5>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close" style="margin-right: 2.5%; margin-top: 1%">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- medium modal -->
    <div class="modal fade " id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-left " style="font-weight: bolder; font-size: 25px; margin-left: 5%">
                        LINK PASSWORD:
                    </h5>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- large modal -->
    <div class="modal fade " id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-left " style="font-weight: bolder; font-size: 25px; margin-left: 5%">
                        Share Link:
                    </h5>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close" style="margin-right: 2.5%; margin-top: 1%">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="largeBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        // display a modal (large modal)
        $(document).on('click', '#largeButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#largeModal').modal("show");
                    $('#largeBody').html(result).show();
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

        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
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
