<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string title
 * @property string description
 * @property string url
 */
trait SystemFileBuild
{
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function setUrl($url){
        $this->url = $url;
        return $this;
    }
}
