<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task; 
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\task;

class TaskController extends Controller
{
    //urlの変数をコントローラーで受け取る方法は、ルーティングで定めた{}内の値と合致しなければならない
    public function index(int $id)
    {
        // dd(123);
        // すべてのフォルダを選択
        $folders = Folder::all();
        //選ばれたフォルダを取得
        $current_folder = Folder::find($id);
        // 選ばれたフォルダに紐づくタスク作り
        $tasks = $current_folder->tasks()->get(); 


        // $folders = [];
        //第一関数がテンプレートファイル名
        //第二関数がテンプレートに渡すデータ  
        return view('tasks/index', [
            'folders' => $folders,
            //ルーティングで受け取った値をテンプレートに渡す
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,

        ]);
    }
}