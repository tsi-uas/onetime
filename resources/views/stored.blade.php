@extends('layout')

@section('content')
<div class="form-group">
    <label for="secret">Here's your URL:</label>
    <input type="text" name="url" id="url" value="{{ route('show', $secret) }}" class="form-control text-monospace">
</div>
<p>
    <button type="button" class="btn btn-success" onclick="copyURL();">
        <i class="fas fa-copy fa-fw"></i>
        Copy URL to Clipboard
    </button>
    <a class="btn btn-danger" href="{{ route('destroy', $secret) }}">
        <i class="fas fa-exclamation-triangle fa-fw"></i>
        Destroy This Secret
    </a>
    <a class="btn btn-primary" href="{{ route('home') }}">
        <i class="fas fa-redo fa-fw"></i>
        Share Another Secret
    </a>
</p>
<script type="text/javascript">
    function copyURL() {
        var copyText = document.getElementById("url");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
    }
</script>
@endsection
