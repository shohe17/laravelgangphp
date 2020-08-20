<?php

//Getで/folders/{id}/taskにリクエストがきたら、TaskControllerでindexメソッドを呼び出す
//アプリケーション内でページを呼び出す場合はname('tasks.index');を使う
//ポイントは{}内のidで、表示したいタスクによってidが変わる仕組み
Route::get('/folders/1/tasks', 'TaskController@index')->name('tasks.index');
