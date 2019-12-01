<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Product;
use App\Bid;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the admin dashboard.
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id')->get();
        return view('admin', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
	    Product::create($data);

	    Session::flash('message', ' New product added successfully');
	    return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $highest_bid = Bid::where('prod_id', $id)->max('amount');
        $avg_bid = Bid::where('prod_id', $id)->avg('amount');
        $min_bid = Bid::where('prod_id', $id)->min('amount');

        return view('admin/view', ['product' => $product, 'highest_bid' => $highest_bid,
                                    'avg_bid' => $avg_bid, 'min_bid' => $min_bid]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin/edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        $product->update($data);

        $notification = array(
            'message' => 'Product successfully updated!', 
            'alert-type' => 'success'
        );

	    // Session::flash('message', ' Product updated successfully');
        return redirect('/dashboard')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->destroy($id);
        
        $notification = array(
            'message' => 'Product successfully deleted!', 
            'alert-type' => 'error'
        );

	    // Session::flash('message', ' Product deleted successfully');
	    return redirect('/dashboard')->with($notification);
    }
}
