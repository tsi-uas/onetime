@extends('layout')

@section('content')
<div id="show">
    <button type="button" class="btn btn-warning btn-lg mt-3" onclick="loadSecret();" id="load">
        <i class="fas fa-user-secret fa-fw"></i>
        Show This Secret
    </button>
</div>
<script type="text/javascript">
    function loadSecret() {
        $('#load i').removeClass('fa-user-secret').addClass('fa-sync-alt fa-spin').attr('disabled', 'disabled');
        $.get('{{ route('load', $secret) }}', function (secret) {
            $('#show').html(secret);
            $('#copy').click(copySecret);
        }).fail(function () {
            $('#show').html('<p class="text-danger">Whoops, that secret has already been destroyed.</p><p><a class="btn btn-primary" href="{{ route('home') }}"><i class="fas fa-redo fa-fw"></i> Share Another Secret</a></p>');
        });
    }
    function copySecret() {
        var $secret = $('#secret');
        $secret.select();
        document.execCommand("copy");
    }
</script>
@endsection
