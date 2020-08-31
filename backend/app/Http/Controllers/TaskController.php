<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task; 
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use function GuzzleHttp\Promise\task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function edit(int $id, int $task_id, EditTask $request)
    {
      //1
      //リクエストされたidでタスクデータを取得
      $task = Task::find($task_id);

      //2
      //タスク変更内容の保存
      $task->title = $request->title;
      $task->status = $request->status;
      $task->due_date = $request->due_date;
      $task->save();

      //3
      //リダイレクト
      return redirect()->route('tasks.index', [
        'id' => $task->folder_id,
       ]);
    }

    //編集したいタスクデータを取得し、テンプレートに渡す
    //しなければ編集したいデータは空で
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    //urlの変数をコントローラーで受け取る方法は、ルーティングで定めた{}内の値と合致しなければならない
    public function index(int $id)
    {
        // ★ ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();
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
