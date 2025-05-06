<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Mail\ReviewMail;
use Illuminate\Support\Facades\Mail;
class ReviewController extends Controller
{
    public function storeReview(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required',
            'theater_id' => 'required',
        ]);
        $review = new Review();
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->theater_id = $request->theater_id;
        $review->user_id = auth()->user()->id;
        $review->save();
        Mail::to(auth()->user()->email)->send(new ReviewMail($review));
        Toastr::success('Review added successfully');
        return redirect()->back();
    }
}
