<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;

use function Symfony\Component\String\s;

class FolderController extends Controller
{
  public function showCreateForm()
  {
    return view('folders/create');
  }

  //引数にインポートしたrequestクラスを入れる
  public function create(CreateFolder $request)
  {
    // dd($request);
    //フォルダモデルのインスタンすを作成する
    $folder = new Folder();
    //タイトルに入力値を代入する
    $folder->title = $request->title;
    //インスタンスの状態をdbに書き込む
    
    $folder->save();
    // dd(123);

    //リダイレクト？
    return redirect()->route('tasks.index', [
      'id' => $folder->id,
      
    ]);
  }
}
