@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Inserisci il titolo dell'articolo" name="title" value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Testo</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="6" name="content" placeholder="Inserisci il testo dell'articolo">{{ old('content') }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crea</button>
        <a class="btn btn-warning ml-2" href="{{ route('admin.posts.index') }}">Annulla</a>
    </form>
</div>
@endsection