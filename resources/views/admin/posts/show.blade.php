@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('created'))
        <div class="alert alert-success"><strong>{{ session('created') }}</strong> creato correttamente!</div>
    @endif
    @if (session('edited'))
        <div class="alert alert-success"><strong>{{ session('edited') }}</strong> modificato correttamente!</div>
    @endif
    <h1>{{$post->title}}  
        @if ($post->category)        
            <a href="{{ route('admin.categories.show', $post->category->id) }}" class="badge badge-info">{{ $post->category->name }}</a>
        @else
            <span class="badge badge-secondary">Categoria sconosciuta</span>     
        @endif
    </h1>
    <small>{{$post->slug}}</small>
    <p class="my-2">{{$post->content}}</p>
    <div class="d-flex my-4">
        <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
        <a class="btn btn-secondary mx-4" href="{{ route('admin.posts.index') }}">Elenco post</a>
        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare definitivamente questo articolo?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETE</button>
        </form>
    </div>
</div>
@endsection