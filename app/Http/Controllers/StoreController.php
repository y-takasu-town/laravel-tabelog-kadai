<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Favorite;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword=$request->keyword;


        // カテゴリーIDとキーワードが両方空の時、全ての店舗を取得する
        if(empty($request->category_id) && empty($request->keyword))
        {
            $stores = Store::all();
        }
        // カテゴリーIDが空の時、キーワードのあいまい検索をする
        elseif(empty($request->category_id))
        {
           // ①これをあいまい検索にする
            $stores = Store::where('name','like',"%{$request->keyword}%")->get();
        } // キーワードが空の時、カテゴリーIDで検索をかける
        elseif(empty($request->keyword))
        {
            $stores = Store::where('category_id', $request->category_id)->get();
        } 
        // カテゴリーIDとキーワード両方に値がある時、2つの条件で検索をかける 
        else
        {
            $stores = Store::where('category_id', $request->category_id)
            ->where('name', 'like', "%{$request->keyword}%")
            ->get();
        }

        $categories = Category::all();

        return view('stores.index', compact('stores','categories'));    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $reviews = $store->reviews()->get();
  
        return view('stores.show', compact('store', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }

    public function favorite(Store $store)
    {
        $favorite = Favorite::where('user_id', Auth::user()->id)->where('store_id', $store->id)->first();

        if (empty($favorite)) {
            $favorite = new Favorite();
            $favorite->user_id = Auth::user()->id;
            $favorite->store_id = $store->id;
            $favorite->save();

            $message = 'お気に入り登録しました';
        } else {
            $favorite->delete();

            $message = 'お気に入り登録を解除しました';
        }

        return back()->with('success', $message);
    }
}
