<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    //				
    protected $fillable=['StoryValue','AuthorId','FileId','ViewNum'];


    //Relation

      //Author Relation
      public function Author()
      {
          return $this->hasOne('App\Author', 'id', 'AuthorId');
      }

      //File Relation
      public function File()
      {
          return $this->hasOne('App\File', 'id', 'FileId');
      }
      


}
