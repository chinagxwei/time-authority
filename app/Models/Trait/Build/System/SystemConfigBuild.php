<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string key
 * @property string value
 */
trait SystemConfigBuild
{

    public function setConfig(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
        return $this;
    }

}
