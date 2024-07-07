@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('store') }}">
                @method('POST')
                @csrf
                <div class="card">
                    <div class="card-header">{{ __('Create Review') }}</div>

                    <div class="card-body">
                        {{-- form file multipart --}}

                        {{-- title --}}
                        <div class="form-group mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                            class="form-control"
                            id="title" aria-describedby="title"
                            placeholder="Enter title" value="{{ old('title') }}">
                        </div>

                        {{-- image_url --}}
                        <div class="form-group mb-2">
                            <label for="image_url">Image URL</label>
                            <input type="text" name="image_url"
                            class="form-control"
                            id="image_url" aria-describedby="image_url"
                            placeholder="Enter image_url" value="{{ old('image_url') }}">
                        </div>

                        <div class="preview pb-4">
                            <div>Preview</div>
                            <img src="" alt="" width="320px" id="preview">
                        </div>

                        {{-- body --}}
                        <div class="form-group mb-2">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body"
                            id="body" rows="3">{{ old('body') }}</textarea>
                        </div>

                        {{-- rating --}}
                        <div class="form-group mb-2">
                            <label for="rating">Rating</label>
                            <input type="number" name="rating"
                            class="form-control"
                            id="rating" aria-describedby="rating"
                            placeholder="Enter rating" value="{{ old('rating') }}"
                            min="1"
                            max="5"
                            pattern="[1-5]"
                            required>
                        </div>

                        {{-- category --}}
                        <div class="form-group mb-2">
                            <label for="rating">Category</label>
                            {{-- select game, music, film, or book --}}
                            <select class="form-select" name="category" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="game">Game</option>
                                <option value="music">Music</option>
                                <option value="film">Film</option>
                                <option value="book">Book</option>
                            </select>
                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="card-footer">
                        <a href="{{route('home')}}" class="btn btn-danger float-start">Cancel</a>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var imageInput = document.querySelector('input#image_url');
        var preview = document.querySelector('img#preview');
        imageInput.addEventListener('keyup', function() {
            preview.src = imageInput.value;
        })
    });
</script>
@endsection
