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
        });
    }
    function copySecret() {
        var $secret = $('#secret');
        $secret.select();
        $secret.setSelectionRange(0, 99999);
        document.execCommand("copy");
    }
</script>
@endsection
