<?php

namespace App\Services\Install;

class BaseSystemNavigationData implements BaseData
{

    public function getData($params = [])
    {
        // TODO: Implement getData() method.
        $time = time();
        return array_merge(
            $this->getAgreement($params[0], $params[1], $time),
            $this->getComplaint($params[0], $params[1], $time),
            $this->getFile($params[0], $params[1], $time),
            $this->getTag($params[0], $params[1], $time),
            $this->getUnit($params[0], $params[1], $time),
            $this->getConfig($params[0], $params[1], $time),
            $this->getNavigation($params[0], $params[1], $time),
            $this->getRole($params[0], $params[1], $time),
            $this->getManager($params[0], $params[1], $time),
            $this->getSystemLog($params[0], $params[1], $time),
            $this->getRouters($params[0], $params[1], $time)
        );
    }

    public function getAgreement($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '协议管理',
                'navigation_link' => '/system/agreement',
                'navigation_sort' => 2,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '协议编辑',
                'navigation_link' => '/system/agreement/edit',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '协议详情',
                'navigation_link' => '/system/agreement/details',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getComplaint($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '投诉管理',
                'navigation_link' => '/system/complaint',
                'navigation_sort' => 3,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '投诉详情',
                'navigation_link' => '/system/complaint/details',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
        ];
    }

    private function getFile($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '文件管理',
                'navigation_link' => '/system/images',
                'navigation_sort' => 4,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
        ];
    }

    private function getTag($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '标签管理',
                'navigation_link' => '/system/tag',
                'navigation_sort' => 5,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getUnit($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '单位管理',
                'navigation_link' => '/system/unit',
                'navigation_sort' => 6,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getConfig($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '系统配置管理',
                'navigation_link' => '/system/config',
                'navigation_sort' => 7,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getNavigation($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '导航管理',
                'navigation_link' => '/system/navigation',
                'navigation_sort' => 8,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '导航编辑',
                'navigation_link' => '/system/navigation/edit',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '导航详情',
                'navigation_link' => '/system/navigation/details',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getRole($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '用户角色管理',
                'navigation_link' => '/system/role',
                'navigation_sort' => 9,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '用户角色编辑',
                'navigation_link' => '/system/role/edit',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '用户角色详情',
                'navigation_link' => '/system/role/details',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getManager($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员管理',
                'navigation_link' => '/system/manager',
                'navigation_sort' => 10,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员编辑',
                'navigation_link' => '/system/manager/edit',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员详情',
                'navigation_link' => '/system/manager/details',
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getSystemLog($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员日志',
                'navigation_link' => '/system/action-log',
                'navigation_sort' => 11,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getRouters($menus_id, $created_by, $time)
    {
        return [
            [
                'parent_id' => $menus_id,
                'navigation_name' => '系统路由管理',
                'navigation_link' => '/system/router',
                'navigation_sort' => 12,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }
}
