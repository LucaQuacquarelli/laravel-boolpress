@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Elenco Post</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titolo</th>
                <th>Slug</th>
                <th colspan="3">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>Show</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page">
        {{$posts->links()}}
    </div>
</div>
    
@endsection