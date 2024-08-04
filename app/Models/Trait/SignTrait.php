<?php

namespace App\Models\Trait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property string $sign
 */
trait SignTrait
{
    public function getSign(){
        return $this->sign;
    }

    abstract function setSign();
}
