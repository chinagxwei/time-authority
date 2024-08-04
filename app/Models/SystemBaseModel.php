<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class SystemBaseModel extends Model
{
    const DISABLE = 0;

    const ENABLE = 1;
}
