<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Request;
use App\Product;
use App\Bid;
use App\User;
use DB;
use Auth;

class FrontstoreController extends Controller
{

    /**
     * Show the storefront.
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */

    public function FrontStore(){
           
        return view('frontstore');
        
    }

    /**
     * Show the bidPage.
     * Display the product to bid.
     *
     * @return \Illuminate\Http\Response
     */
    public function bidPage($id) {
        
        $singleProduct = Product::find($id);
        $highest_bid = Bid::where('prod_id', $id)->max('amount');
        $avg_bid = Bid::where('prod_id', $id)->avg('amount');
        $last_bid = Bid::where('prod_id', $id)->orderBy('id','desc')->first();

        //dd($last_bid);

        return view('bid', ['singleProduct' => $singleProduct, 'highest_bid' => $highest_bid,
                            'avg_bid' => $avg_bid, 'last_bid' => $last_bid]);
    }

    public function storeBid(){
        
        $user = Auth::user();
        $bids = new Bid();
        $bids->user_id = $user->id;
        $bids->email = Request::input('email');
        $bids->amount = Request::input('amount');
        $bids->prod_id = Request::input('prod_id');
        
        $bids->save();

        $notification = array(
            'message' => 'Bid successfully placed!', 
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }


    /**
     *  Highest Bid
     *  Display the highest to bid.
     * 
     * @return \Illuminate\Http\Response
     */

     public function highestBid() {

        $highest_bid = Bid::avg('amount');
        dd($highest_bid);
     }
}
