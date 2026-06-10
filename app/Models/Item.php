<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Item extends Model
{
   public function __construct(

        private string $name,
        private string $content,
        private DateTime $createdAt
   ){
     if (strlen($content) > 1000) {
        throw new \InvalidArgumentException("Content must be less than 1000 characters.");
     }
   }
}
