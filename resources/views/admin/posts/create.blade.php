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
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                <option value="">-- Seleziona una categoria --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ ($category->id == old('category_id')) ? 'selected' : '' }}
                        >{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mb-5">
            <h6>Tags</h6>
            @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                </div>     
            @endforeach 
            @error('tags')
                <div>
                    <small class="text-danger">{{ $message }}</small> 
                </div>
            @enderror   
        </div>      
        <button type="submit" class="btn btn-primary">Crea</button>
        <a class="btn btn-warning ml-2" href="{{ route('admin.posts.index') }}">Annulla</a>
    </form>
</div>
@endsection