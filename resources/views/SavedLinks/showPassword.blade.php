{{-- !-- Show Password Modal -->  --}}
<form>
    <div class="modal-body">
        @csrf
        @method('GET')
                <div class="form-group" style="text-align: center;">
                    <strong>{{ $decrypted_password }}</strong>
                </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button"  class="btn btn-primary pull-right" data-dismiss="modal">OKAY</button>
{{--        <button type="submit" class="btn btn-secondary pull-right">OKAY</button>--}}
    </div>
</form>
