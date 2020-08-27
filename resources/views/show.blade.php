@extends('layout')

@section('content')
<div class="form-group">
    <label for="secret">Here's your Secret:</label>
    <textarea name="secret" id="secret" rows="5" class="form-control" readonly>{{ decrypt($secret->secret) }}</textarea>
</div>
<p>This secret has now been destroyed forever.</p>
<button type="button" class="btn btn-success" onclick="copySecret();">
    <i class="fas fa-copy fa-fw"></i>
    Copy Secret to Clipboard
</button>
<a class="btn btn-primary" href="{{ route('home') }}">
    <i class="fas fa-redo fa-fw"></i>
    Share Another Secret
</a>
<script type="text/javascript">
    function copySecret() {
        var copyText = document.getElementById("secret");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
    }
</script>
@endsection
