@extends('layout')

@section('content')
<form action="{{ route('store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="secret">What's your secret?</label>
        <textarea name="secret" id="secret" rows="5" class="form-control"></textarea>
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
            <option value="+1 day">1 Day</option>
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
