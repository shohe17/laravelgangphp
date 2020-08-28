<?php

//Getで/folders/{id}/taskにリクエストがきたら、TaskControllerでindexメソッドを呼び出す
//アプリケーション内でページを呼び出す場合はname('tasks.index');を使う
//ポイントは{}内のidで、表示したいタスクによってidが変わる仕組み
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

//フォルダ作成機能ルーティング
//getで/folders/createにリクエストがきたら、FolderControllerでshowCreateFormメソッドを呼び出す
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
//postで/folders/createからデータを送信する。FolderControllerでcreateメソッドを呼び出す
Route::post('/folders/create', 'FolderController@create');


//タスク作成機能ルーティング
//getで/folders/{id}/tasks/createにリクエストが来たら、TaskControllerファイルのshowCreateFormメソッドを実行する
Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{id}/tasks/create', 'TaskController@create');

//タスク編集機能ルーティング
//getで/folders/{id}/tasks/{task_id}/editにリクエストが来たら、TaskControllerファイルのshowEditFormメソッドを実行する
Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');
