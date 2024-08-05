<?php

namespace App\Models\Trait\Build\System;

/**
 * @property string navigation_name
 * @property string navigation_link
 * @property int navigation_sort
 * @property int menu_show
 * @property string icon
 */
trait SystemNavigationBuild
{
    public function setNavigationName($navigation_name)
    {
        $this->navigation_name = $navigation_name;
        return $this;
    }

    public function setNavigationLink($navigation_link)
    {
        $this->navigation_link = $navigation_link;
        return $this;
    }

    public function setNavigationSort($navigation_sort)
    {
        $this->navigation_sort = $navigation_sort;
        return $this;
    }

    public function setMenuShow($menu_show)
    {
        $this->menu_show = $menu_show;
        return $this;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }
}
