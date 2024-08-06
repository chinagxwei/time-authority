<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string title
 * @property string content
 * @property int type
 * @property int status
 */
trait SystemComplaintBuild
{
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    public function setType($type){
        $this->type = $type;
        return $this;
    }

    public function setStatus($status){
        $this->status = $status;
        return $this;
    }
}
