@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex">
            <h1>{{ $category->name }}</h1>
            <a class="btn btn-primary mx-4 align-self-center" href="{{ route('admin.posts.create') }}">CREATE NEW</a>
        </div>
        @if (count($category->posts) > 0)
        <ul class="mt-4">
            @foreach ($category->posts as $post)    
            <li>
                <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
            </li>
            @endforeach
        </ul>
        @else
        <h2>Non ci sono articoli all'interno di questa categoria.</h2> 
        @endif
        <a class="btn btn-secondary mx-4" href="{{ route('admin.posts.index') }}">Elenco post</a>
    </div>
@endsection