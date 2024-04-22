<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\ShoeComments;
use App\Models\ShoeRatings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShoeController extends Controller
{
    public function home(){
        $shoes = Shoe::all();
        $overall_ratings = [];
        foreach($shoes as $shoe){
            array_push($overall_ratings, round(ShoeRatings::where('shoe_id', $shoe->id)->avg('rating'), 2));
        }
        return view('front', compact('shoes', 'overall_ratings'));
    }

    public function addShoe(Request $request){
        $imageName = "test";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
        }
        Shoe::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'specs' => $request->specs,
            'pros' => $request->pros,
            'cons' => $request->cons,
            'image_path' => $imageName
        ]);
        return redirect()->route('dashboard');
    }

    public function getShoe(Request $request){
        $shoe = Shoe::where('id', $request->shoe_id)->first();
        $isRated = false;

        //For Rating
        $rating = 0;
        if($request->has('user_id')){
            $rating = ShoeRatings::where([['user_id', $request->user_id],['shoe_id', $request->shoe_id]])->first();
        }
        if($rating!= null){
            $isRated = true;
            $rating = $rating->rating;
        }
        $overall_rating = round(ShoeRatings::where('shoe_id', $request->shoe_id)->avg('rating'), 2);

        //For Comments
        $comments = ShoeComments::where([['shoe_id', $request->shoe_id], ['status', 1]])->get();
        return view('homepages.shoeview', compact('shoe', 'isRated', 'rating', 'overall_rating', 'comments'));
    }

    public function submitRating(Request $request){
        ShoeRatings::create([
            'user_id' => $request->user_id,
            'shoe_id' => $request->shoe_id,
            'rating' => $request->rating,
        ]);
        $rating = $request->rating;
        $overall_rating = round(ShoeRatings::where('shoe_id', $request->shoe_id)->avg('rating'), 2);
        return view('homepages.ratingview', compact('rating', 'overall_rating'));
    }

    public function submitComment(Request $request){
        ShoeComments::create([
            'user_id' => $request->user_id,
            'shoe_id' => $request->shoe_id,
            'comment' => $request->comment,
            'status' => 1,
        ]);
        $comments = ShoeComments::where([['shoe_id', $request->shoe_id], ['status', 1]])->get();
        return view('homepages.commentview', compact('comments'));
    }

    public function hideComment(Request $request){
        ShoeComments::where('id', $request->comment_id)->update([
            'status'=>2,
        ]);
        return false;
    }
}
