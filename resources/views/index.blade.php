@extends('layout')

@section('content')
<form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <p class="text-muted">
        Enter your secret information below, select an expiration time, and click the button. You will be provided with
        a URL to share your secret with someone. Secrets are stored in a secure database, protected by AES-256
        encryption. Once the URL has been accessed one time, the secret will be destroyed permanently, and the URL will
        never be accessible again. If the URL is not accessed by the time your chosen expiration period ends, the secret
        will be destroyed automatically.
    </p>
    <div class="form-group">
        <label for="secret">What's your secret?</label>
        <textarea name="secret" id="secret" rows="10" class="form-control" autofocus></textarea>
    </div>
    <div class="form-group">
        <label for="secret">Upload a File?</label>
        <input name="file" id="file" type="file" class="form-control" />
        <p class="help-text">
            Max Size: {{ ini_get('upload_max_filesize') }}<br>
            Allowed File Types: jpeg, jpg, gif, png, tif, tiff, bmp, doc, docx, xls, xlsx, ppt, pptx, txt, csv, psv, pdf, zip, 7z, rar
        </p>
    </div>
    <div class="form-group">
        <label for="expires">When should it expire?</label>
        <select name="expires" id="expires" class="form-control">
            <option value="+1 hour">1 Hour</option>
            <option value="+2 hours">2 Hours</option>
            <option value="+3 hours">3 Hours</option>
            <option value="+4 hours">4 Hours</option>
            <option value="+5 hours">5 Hours</option>
            <option value="+6 hours">6 Hours</option>
            <option value="+12 hours">12 Hours</option>
            <option value="+18 hours">18 Hours</option>
            <option value="+1 day" selected>1 Day</option>
            <option value="+2 days">2 Days</option>
            <option value="+3 days">3 Days</option>
            <option value="+4 days">4 Days</option>
            <option value="+5 days">5 Days</option>
            <option value="+6 days">6 Days</option>
            <option value="+7 days">7 Days</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-check fa-fw"></i> Get Your Secret URL</button>
</form>
@endsection
