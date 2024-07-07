@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
            @endif
            @auth
            <div class="bg-green">
                <a href="{{ route('create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus-circle"></i>
                    Add Item
                </a>
            </div>
            @endauth
            <div class="row">
                @foreach ($reviews as $review)
                <div class="col-6 p-2">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4 p-3">
                                <img src="{{$review->image_url}}" class="card-img mt-2" alt="thumbnail" width="100%">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text mb-1">
                                        <small class="text-muted">Author: {{$review->author}}</small>
                                    </p>
                                    <h5 class="card-title">{{$review->title}}</h5>
                                    <p class="card-text mb-1" style="height:75px">
                                        {{ Str::limit($review->body, 134, '...') }}
                                    </p>
                                    <div class="rating">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                            @endfor
                                    </div>
                                    <div class="timestamp">
                                        <div class="text-muted">
                                            <small>
                                                {{$review->created_at->diffForHumans()}}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="category">
                                        Category:
                                        <a href="{{route('category',['category'=>$review->category])}}">{{$review->category}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{-- visit button with paper plane icon --}}
                            <a href="{{ route('show', ['id' => $review->id]) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                View
                            </a>
                            {{-- if user_id from review is the same, then show edit button --}}
                            @if (Auth::id() == $review->user_id)
                            <a href="{{ route('edit', ['id' => $review->id]) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form id="delete-form" action="{{ route('delete', ['id' => $review->id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method("DELETE");
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit">Delete</button>
                            </form>
                            <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                <i class="fas fa-trash"></i>
                                Delete
                            </a>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>


        </div>
    </div>
</div>
@endsection