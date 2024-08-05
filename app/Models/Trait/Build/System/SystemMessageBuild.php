<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string title
 * @property string content
 * @property int weight
 * @property int user_type
 */
trait SystemMessageBuild
{

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    public function setUserType($user_type)
    {
        $this->user_type = $user_type;
        return $this;
    }
}
