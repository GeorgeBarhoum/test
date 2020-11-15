@extends('layouts.app')

@section('content')
    
{{-- @if ($message = Session::get('success')) 
<div class="alert alert-success"> 
    <p>{{ $message }}</p> 
</div> 
@endif --}}
        @foreach ($articles as $article)
            <div>
                <h3>
                    {{ $article->title }}
                </h3>
                <p>
                    {{ $article->body }}
                </p>
                <p>
                    {{ $article->user->name }}
                </p>
            </div>
            
        @endforeach

@endsection