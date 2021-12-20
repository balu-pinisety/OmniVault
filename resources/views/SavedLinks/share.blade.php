<form>
    <div class="modal-body">
        <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
            <div class="form-group">
                <strong><u>LINK DETAILS</u></strong>
            </div>
        </div>
        <div class="row" style="padding-left: 150px; ">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>TITLE:</strong>
                    {{ $link->title }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>URL:</strong>
                    {{ $link->url }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Username:</strong>
                    {{ $link->username }}
                </div>
            </div>
        </div>

{{--        <div class="form-group" style="text-align: left;">--}}
{{--            Enter e-mail below to share the above link details.--}}
{{--        </div>--}}
        <div class="form-group" style="text-align: left;">
            <strong>E-mail:</strong>
            <input type="text" name="url" class="form-control"
                   placeholder="Enter e-mail below to share the above link details">
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button"  class="btn btn-primary pull-right" data-dismiss="modal">OKAY</button>
        {{--        <button type="submit" class="btn btn-secondary pull-right">OKAY</button>--}}
    </div>
</form>
