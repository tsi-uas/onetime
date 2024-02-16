<div class="form-group">
    @if ($secret->secret)
        <p>
            <label for="secret">Here's your Secret:</label>
            <textarea name="secret" id="secret" rows="10" class="form-control" readonly>{{ decrypt($secret->secret) }}</textarea>
        </p>
    @endif
    @if ($secret->file_contents)
        <p>
            This secret includes an attached file. Click the button below to download it.
        </p>
        <p>
            <a class="btn btn-primary" target="_blank" id="download" download="{{ $secret->file_name }}" href="">
                <i class="fas fa-cloud-download-alt fa-fw"></i>
                Download File - {{ $secret->file_name }} - {{ $secret->file_size_human }}
            </a>
        </p>
        <script>
            var data = b64toBlob("{{ base64_encode(decrypt($secret->file_contents)) }}", "{{ $secret->file_mime }}");
            var url = window.URL.createObjectURL(data);
            $('#download').attr('href', url);
        </script>
    @endif
</div>
<p>This secret has now been destroyed forever.</p>
<p>
    <button type="button" class="btn btn-success" id="copy">
        <i class="fas fa-copy fa-fw"></i>
        Copy Secret to Clipboard
    </button>
    <a class="btn btn-primary" href="{{ route('home') }}">
        <i class="fas fa-redo fa-fw"></i>
        Share Another Secret
    </a>
</p>
