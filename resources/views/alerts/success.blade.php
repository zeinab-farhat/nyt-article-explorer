@if (session($key ?? 'status'))
    <div class="alert alert-success alert-with-icon" data-notify="container" id="autoCloseAlert">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tim-icons icon-simple-remove"></i>
        </button>
        <span data-notify="icon" class="tim-icons icon-bell-55"></span>
        <span data-notify="message">{{ session($key ?? 'status') }}</span>
    </div>
@endif


