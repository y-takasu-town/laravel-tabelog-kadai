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
        $sort_query = [];
        $sorted = "";

        if ($request->sort !== null) {
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
        }

        // カテゴリーIDとキーワードが両方空の時、全ての店舗を取得する
        if(empty($request->category_id) && empty($request->keyword))
        {
            $stores = Store::sortable($sort_query)->get();
        }

        // カテゴリーIDが空の時、キーワードのあいまい検索をする
        elseif(empty($request->category_id))
        {
            $stores = Store::where('name','like',"%{$request->keyword}%")->sortable($sort_query)->get();
        } 
        
        // キーワードが空の時、カテゴリーIDで検索をかける
        elseif(empty($request->keyword))
        {
            $stores = Store::where('category_id', $request->category_id)->sortable($sort_query)->get();
        } 

        // カテゴリーIDとキーワード両方に値がある時、2つの条件で検索をかける 
        else
        {
            $stores = Store::where('category_id', $request->category_id)
            ->where('name', 'like', "%{$request->keyword}%")
            ->sortable($sort_query)->get();
        }

        $sort = [
            '並び替え' => '', 
            '価格の安い順' => 'price_range asc',
            '価格の高い順' => 'price_range desc', 
        ];

        $categories = Category::all();

        return view('stores.index', compact('stores', 'categories','sort',  'sorted'));
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
