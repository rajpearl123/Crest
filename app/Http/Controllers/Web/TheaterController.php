<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Theater;
use App\Utils\ViewPath;
use Illuminate\Http\Request;
use App\Models\Review;

class TheaterController extends Controller
{
    public function theaterView($id){
        $theater = Theater::where('id', $id)->first();
        $theaterImages = json_decode($theater->images, true);
        $firstFourImages = array_slice($theaterImages, 0, 4);
        $reviews = Review::where('theater_id', $id)->latest()->take(10)->get();
        return view(ViewPath::THEATER_VIEW, compact('theater', 'theaterImages', 'firstFourImages','reviews'));
    }
    
}
