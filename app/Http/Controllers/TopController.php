<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
        // トップ画面に表示するデータを取得または処理するコードを追加
        return view('top.index'); // 'top.index'は後で作成するビューの名前
    }
}
