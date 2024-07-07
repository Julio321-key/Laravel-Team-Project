@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3 p-2">
                    <div class="card p-2">
                        <img src="{{$review->image_url}}" class="card-img" alt="thumbnail">
                        <div class="card-body">
                            <p class="mb-1">Author: {{$review->author}}</p>
                            <p class="mb-1">Email: {{Auth::user()->find($review->user_id)->email}}</p>
                            <p
                            class="mb-1"
                            title="{{$review->created_at->format('d/m/Y H:i:s')}}">
                                Create Date: {{$review->created_at->diffForHumans()}}
                            </p>
                            <div class="rating mb-3">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                    @endfor
                            </div>
                            @if (Auth::id() == $review->user_id)
                            <a href="{{ route('edit', ['id' => $review->id]) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form
                            id="delete-form"
                            action="{{ route('delete', ['id' => $review->id]) }}"
                            method="POST"
                            style="display: none;">
                                @csrf
                                @method("DELETE");
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit">Delete</button>
                            </form>
                            <a
                            href="#"
                            class="btn btn-sm btn-danger"
                            onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                <i class="fas fa-trash"></i>
                                Delete
                            </a>
                            @endif
                            {{-- modal share button to popup url --}}
                            <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#shareModal">
                                <i class="fas fa-share"></i>
                                Share
                            </button>

                            {{-- modal share --}}

                            <!-- Modal -->
                            <div
                            class="modal fade"
                            id="shareModal"
                            tabindex="-1"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Share Post</h5>
                                            <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- echo current url --}}
                                            {{ URL::current() }}
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-9 p-2">
                    <div class="card p-2">
                        <h3 class="text-title">{{$review->title}}</h3>
                        <p class="text-body">{{$review->body}}</p>
                    </div>
                    <div class="card p-2 mt-4">
                        <form method="post" action="{{ route('comment.store', ['id' => $review->id]) }}">
                            @method("post")
                            @csrf
                            <label for="body">Comment</label>
                            <textarea name="body" id="comment" cols="30" rows="1" class="form-control"></textarea>
                            <input type="hidden" name="name" value="{{Auth::user()->name}}">
                            <input type="hidden" name="email" value="{{Auth::user()->email}}">
                            <input type="hidden" name="review_id" value="{{$review->id}}">
                            <input type="submit" value="Post" class="btn btn-sm btn-success mt-2">
                        </form>
                        <div class="comment-list pt-4">
                            @foreach ($comments as $c)
                            <div class="d-flex">
                                <div class="px-2">
                                    <i class="fas fa-user-circle" style="font-size: 25px"></i>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">
                                        <span class="text-capitalize fw-semibold">{{$c->name}}</span>
                                        <span class="text-muted">({{$c->email}})</span>
                                        <span class="text-muted" title="{{$c->created_at->format('d/m/Y H:i:s')}}">
                                            {{$c->created_at->diffForHumans()}}
                                        </span>
                                    </h6>
                                    <p>{{$c->body}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
