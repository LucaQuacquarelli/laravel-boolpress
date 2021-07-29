@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('deleted'))
        <div class="alert alert-success"><strong>{{ session('deleted') }}</strong> eliminato correttamente!</div>
    @endif
    <div class="d-flex">
        <h1 class="my-4">Elenco Post</h1>
        <a class="btn btn-primary mx-4 align-self-center" href="{{ route('admin.posts.create') }}">NEW</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titolo</th>
                <th>Slug</th>
                <th>Categoria</th>
                <th>Tags</th>
                <th colspan="3">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>
                        @if ($post->category)
                        <a href="{{ route('admin.categories.show', $post->category->id) }}" class="btn badge-info">{{ $post->category->name }}</a> 
                        @else
                            Categoria sconosciuta
                        @endif
                    </td>
                    <td>
                        @if (count($post->tags) > 0)
                            @foreach ($post->tags as $tag)
                            <span class="badge badge-pill badge-dark">{{ $tag->name }}</span>
                            @endforeach
                        @else  
                            Nessun tag collegato  
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success" href="{{ route('admin.posts.show', $post->id) }}">SHOW</a>
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">EDIT</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare definitivamente questo articolo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page">
        {{$posts->links()}}
    </div>
</div>
    
@endsection