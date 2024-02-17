<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TopController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // トップ画面に表示するデータを取得または処理するコードを追加
        return view('top.index', compact('categories'));
    }
}
