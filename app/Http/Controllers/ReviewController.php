<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get desc
        $reviews = Review::orderBy('id', 'desc')->get();
        return view('home', ['reviews' => $reviews]);
    }

    public function create()
    {
        return view('review.create');
    }

    public function store()
    {
        Review::create([
            'user_id' => auth()->user()->id,
            'title' => request('title'),
            'body' => request('body'),
            'author' => request('author'),
            'rating' => request('rating'),
            'image_url' => request('image_url'),
            'category' => request('category'),
        ]);
        return redirect('/home')->with('msg', 'Thanks for your review!');
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        // find with
        $comments = Comment::where('review_id', $id)->get();

        return view('review.show', ['review' => $review, 'comments' => $comments]);
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('review.edit', ['review' => $review]);
    }

    public function update()
    {
        $id = request('id');
        $review = Review::findOrFail($id);
        $review->title = request('title');
        $review->body = request('body');
        $review->author = request('author');
        $review->rating = request('rating');
        $review->image_url = request('image_url');
        $review->category = request('category');
        $review->save();
        return redirect('/show/' . $id)->with('msg', 'Your review has been updated!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect('/home')->with('msg', 'Your review has been deleted!');
    }

    public function category($category)
    {
        $reviews = Review::where('category', $category)->get();
        return view('home', ['reviews' => $reviews]);
    }
}
