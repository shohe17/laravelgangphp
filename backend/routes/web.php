<?php

Route::group(['middleware' => 'auth'], function() {

  //ログイン後にトップページへ映るリダイレクト
  Route::get('/', 'HomeController@index')->name('home');

//フォルダ作成機能ルーティング
  //getで/folders/createにリクエストがきたら、FolderControllerでshowCreateFormメソッドを呼び出す
  Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
  //postで/folders/createからデータを送信する。FolderControllerでcreateメソッドを呼び出す
  Route::post('/folders/create', 'FolderController@create');

  //アプリケーション内でページを呼び出す場合はname('tasks.index');を使う
  //can ミドルウェアの引数（view,folder）はカンマ区切りで、左側が認可処理の種類、右側がポリシーに渡すルートパラメーター（URL の変数部分）を示す
  //ミドルウェアを適用、canミドルウェアは引数（コロン以降の部分）から適切な認可処理を判定してコントローラーメソッド実行前に適用
  Route::group(['middleware' => 'can:view,folder'], function() {
    Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
    
    //タスク作成機能ルーティング
    //getで/folders/{id}/tasks/createにリクエストが来たら、TaskControllerファイルのshowCreateFormメソッドを実行する
    Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

    //タスク編集機能ルーティング
    //getで/folders/{id}/tasks/{task_id}/editにリクエストが来たら、TaskControllerファイルのshowEditFormメソッドを実行する  
    Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
    });
  });

//会員登録・ログイン・ログアウト・パスワード再設定の各機能で必要なルーティング設定をすべて定義
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

