<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;


// use function Symfony\Component\String;

class FolderController extends Controller
{
  
  public function showCreateForm()
  {
    return view('folders/create');
    // dd(123);
  }

  //引数にインポートしたrequestクラスを入れる
  public function create(CreateFolder $request)
  {
    // dd($request);
    //フォルダモデルのインスタンすを作成する
    
    $folder = new Folder();
    //タイトルに入力値を代入する
    $folder->title = $request->title;
    
    //ユーザーに紐づけて保存
    //Auth::user() でユーザーモデルが取得
    //インスタンスの状態をdbに書き込む
    Auth::user()->folders()->save($folder);
    // dd(123);

    //リダイレクト？
    return redirect()->route('tasks.index', [
      'folder' => $folder->id,
      
    ]);
  }
}
