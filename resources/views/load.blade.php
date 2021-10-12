<div class="form-group">
    <label for="secret">Here's your Secret:</label>
    <textarea name="secret" id="secret" rows="10" class="form-control" readonly>{{ decrypt($secret->secret) }}</textarea>
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
