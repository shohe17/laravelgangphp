<?php

//Getで/folders/{id}/taskにリクエストがきたら、TaskControllerでindexメソッドを呼び出す
//アプリケーション内でページを呼び出す場合はname('tasks.index');を使う
//ポイントは{}内のidで、表示したいタスクによってidが変わる仕組み
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

//getで/folders/createにリクエストがきたら、FolderControllerでshowCreateFormメソッドを呼び出す
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');

//postで/folders/createからデータを送信する。FolderControllerでcreateメソッドを呼び出す
Route::post('/folders/create', 'FolderController@create');

