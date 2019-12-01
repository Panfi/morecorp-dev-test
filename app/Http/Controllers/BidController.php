<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;

class BidController extends Controller
{
    public function bidPage() {
        return view('bid');
    }

    public function storeBid(){

    }
}
