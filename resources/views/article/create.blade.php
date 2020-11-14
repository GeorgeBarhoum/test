@extends('layouts.app')

@section('content')

<form method="POST" action="/articles/create">
    @csrf
    <input type="text" name="title">
    <textarea name="body"></textarea>
    <button type="submit">Submit</button>

</form>


@endsection