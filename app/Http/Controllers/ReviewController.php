<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $review = new Review();
        $review->comment = $request->input('comment');
        $review->store_id = $request->input('store_id');
        $review->user_id = Auth::user()->id;
        $review->star = $request->input('star');
        $review->save();

        return back();
    }

}
