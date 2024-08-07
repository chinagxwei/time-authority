<?php

namespace App\Services\Install;

class BaseSystemRouterData implements BaseData
{

    public function getData($params = [])
    {
        // TODO: Implement getData() method.
        $time = time();
        return array_merge(
            $this->getAgreement($params[0], $time),
            $this->getComplaint($params[0], $time),
            $this->getFile($params[0], $time),
            $this->getTag($params[0], $time),
            $this->getUnit($params[0], $time),
            $this->getConfig($params[0], $time),
            $this->getNavigation($params[0], $time),
            $this->getRole($params[0], $time),
            $this->getManager($params[0], $time),
            $this->getSystemLog($params[0], $time),
            $this->getRouters($params[0], $time)
        );
    }

    private function getAgreement($created_by, $time)
    {
        return [
            [
                'router_name' => '协议列表',
                'router' => '/api/v1/agreement/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '协议保存',
                'router' => '/api/v1/agreement/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '协议详情',
                'router' => '/api/v1/agreement/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除协议',
                'router' => '/api/v1/agreement/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getComplaint($created_by, $time)
    {

        return [
            [
                'router_name' => '投诉列表',
                'router' => '/api/v1/complaint/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '投诉保存',
                'router' => '/api/v1/complaint/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '投诉详情',
                'router' => '/api/v1/complaint/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除投诉',
                'router' => '/api/v1/complaint/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getFile($created_by, $time)
    {

        return [
            [
                'router_name' => '文件列表',
                'router' => '/api/v1/file/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '文件保存',
                'router' => '/api/v1/file/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '文件详情',
                'router' => '/api/v1/file/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '文件上传',
                'router' => '/api/v1/file/upload',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除文件',
                'router' => '/api/v1/file/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getTag($created_by, $time)
    {
        return [
            [
                'router_name' => '标签列表',
                'router' => '/api/v1/tag/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '标签保存',
                'router' => '/api/v1/tag/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '标签详情',
                'router' => '/api/v1/tag/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除标签',
                'router' => '/api/v1/tag/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getUnit($created_by, $time)
    {
        return [
            [
                'router_name' => '单位列表',
                'router' => '/api/v1/unit/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '单位保存',
                'router' => '/api/v1/unit/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '单位详情',
                'router' => '/api/v1/unit/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除单位',
                'router' => '/api/v1/unit/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getConfig($created_by, $time)
    {
        return [
            [
                'router_name' => '配置列表',
                'router' => '/api/v1/config/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '配置保存',
                'router' => '/api/v1/config/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '配置详情',
                'router' => '/api/v1/config/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除配置',
                'router' => '/api/v1/config/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getNavigation($created_by, $time)
    {
        return [
            [
                'router_name' => '导航列表',
                'router' => '/api/v1/navigation/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '导航保存',
                'router' => '/api/v1/navigation/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '导航详情',
                'router' => '/api/v1/navigation/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除导航',
                'router' => '/api/v1/navigation/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getRole($created_by, $time)
    {
        return [
            [
                'router_name' => '角色列表',
                'router' => '/api/v1/role/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '角色保存',
                'router' => '/api/v1/role/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '角色详情',
                'router' => '/api/v1/role/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除角色',
                'router' => '/api/v1/role/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getManager($created_by, $time)
    {
        return [
            [
                'router_name' => '管理员列表',
                'router' => '/api/v1/manager/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '管理员保存',
                'router' => '/api/v1/manager/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '管理员详情',
                'router' => '/api/v1/manager/view',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '管理员信息',
                'router' => '/api/v1/manager/info',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除管理员',
                'router' => '/api/v1/manager/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getSystemLog($created_by, $time)
    {
        return [
            [
                'router_name' => '管理员日志列表',
                'router' => '/api/v1/system-log/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除管理员日志',
                'router' => '/api/v1/system-log/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private function getRouters($created_by, $time){
        return [
            [
                'router_name' => '管理路由列表',
                'router' => '/api/v1/router/index',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '保存管理路由',
                'router' => '/api/v1/router/save',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除管理路由',
                'router' => '/api/v1/router/delete',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '注册路由',
                'router' => '/api/v1/router/registered-route',
                'created_by' => $created_by,
                'updated_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }
}
