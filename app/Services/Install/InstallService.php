<?php

namespace App\Services\Install;

use App\Models\Order\OrderRevenuesConfig;
use App\Models\System\SystemAdmin;
use App\Models\System\SystemNavigation;
use App\Models\System\SystemRole;
use App\Models\System\SystemRouter;
use App\Models\System\SystemUnit;
use App\Services\User\MemberService;
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
            $this->initRole();
            $this->initUnit();
            $this->initCommissionRatio();
            $this->initMember();
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
            ->setRoleId(1)
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

    private function initRole()
    {
        $data = (new BaseSystemRoleData)->getData([$this->admin->created_by]);

        SystemRole::query()->insert($data);
    }

    private function initUnit()
    {
        $data = (new BaseSystemUnitData)->getData([$this->admin->created_by]);

        SystemUnit::query()->insert($data);
    }

    private function initCommissionRatio()
    {
        $data = (new BaseSystemCommissionRatioData)->getData([$this->admin->created_by]);

        OrderRevenuesConfig::query()->insert($data);
    }

    private function initMember()
    {
        (new MemberService())->setUsername('test')
            ->setPassword('test123456')
            ->setRoleId(3)
            ->register();
    }
}
