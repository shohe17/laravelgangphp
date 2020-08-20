<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $folders = Folder::all();
        //第一関数がテンプレートファイル名
        //第二関数がテンプレートに渡すデータ  
        return view('tasks/index', [
            'folders' => $folders,
        ]);
    }
}