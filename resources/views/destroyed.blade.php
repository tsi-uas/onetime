@extends('layout')

@section('content')
<p>This secret has now been destroyed forever.</p>
<a class="btn btn-primary" href="{{ route('home') }}">
    <i class="fas fa-redo fa-fw"></i>
    Share Another Secret
</a>
@endsection
