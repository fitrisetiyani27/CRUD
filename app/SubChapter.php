<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class SubChapter extends Model
{
    public $table = "subchapter";
    use UuidTrait;

    protected $fillable = [
        'uuid','thumbnail','title','content'
    ];
}
