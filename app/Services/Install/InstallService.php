<?php

namespace App\Services\Install;

use App\Models\System\SystemAdmin;
use App\Models\System\SystemNavigation;
use App\Models\System\SystemRole;
use App\Models\System\SystemRouter;
use App\Services\User\SystemAdminService;
use function Symfony\Component\Translation\t;

class InstallService
{
    /** @var SystemAdmin */
    private $admin;

    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->initAdmin();

        if ($this->admin) {
            $this->initRouter();
            $this->initMenu();
        } else {
            throw new \Exception('create admin error');
        }
    }

    /**
     * @throws \Exception
     */
    private function initAdmin()
    {
        $this->admin = (new SystemAdminService())
            ->setEmail('admin@system.com')
            ->setUsername('admin')
            ->setPassword('admin123456')
            ->setUserType(SystemRole::USER_TYPE_PLATFORM_SUPER_ADMIN)
            ->register();
    }

    private function initRouter()
    {
        $data = (new BaseSystemRouterData)->getData([$this->admin->created_by]);

        SystemRouter::query()->insert($data);
    }

    private function initMenu()
    {
        SystemNavigation::generateParent("站点首页", "line-menu", $this->admin->created_by, 0, '/');

        $systemMenus = SystemNavigation::generateParent("系统管理", "line-menu", $this->admin->created_by, 7, '/system');

        $systemData = (new BaseSystemNavigationData)->getData([$systemMenus->id, $this->admin->created_by]);

        SystemNavigation::query()->insert($systemData);
    }
}
