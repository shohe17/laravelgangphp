<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  //数値1-3に文字列を指定する
  const STATUS = [
    1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
    2 => [ 'label' => '着手中', 'class' => 'label-info' ],
    3 => [ 'label' => '完了', 'class' => '' ],
  ];

  /**
   * 状態を表すHTMLクラス
   * @return string
   */
  public function getStatusClassAttribute ()
    {
      // 状態値
      $status = $this->attributes['status'];

      // 定義されていなければ空文字を返す
      if (!isset(self::STATUS[$status])) {
          return '';
      }

      return self::STATUS[$status]['class'];
    }

  public function getStatusLabelAttribute ()
    {
      //状態値
      $status = $this->attributes['status'];
        //もし定義されていなければから文字を返す
        if (!isset(self::STATUS[$status])) {
          return '';
      }
      return self::STATUS[$status]['label'];

    }

  //日付の表示形式を2019-01-01から2019/01/01に変更する
  public function getFormattedDueDateAttribute ()
    {
      return Carbon::createFormFormat('Y-m-d', $this->attributes['due_date'])
        ->format('Y/m/d');
      
    }
}
