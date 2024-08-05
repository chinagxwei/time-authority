<?php

namespace App\Models\Trait;

use Illuminate\Database\Eloquent\Model;

trait SearchTrait
{
    /**
     * @param $id
     * @param $with
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null|static
     */
    static function findOneByID($id, $with = [])
    {
        return self::query()->where('id', $id)->with($with)->first();
    }

    abstract function searchBuild($param = [], $with = []);
}
