<?php

namespace Modules\Register\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterRegisterSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('register::registers.title.registers'), function (Item $item) {
                $item->icon('fa fa-car');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('register::forms.title.forms'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
//                    $item->append('admin.register.form.create');
                    $item->route('admin.register.form.index');
                    $item->authorize(
                        $this->auth->hasAccess('register.forms.index')
                    );
                });
                $item->item(trans('register::collaterals.title.collaterals'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.register.collateral.create');
                    $item->route('admin.register.collateral.index');
                    $item->authorize(
                        $this->auth->hasAccess('register.collaterals.index')
                    );
                });
//                $item->item(trans('register::files.title.files'), function (Item $item) {
//                    $item->icon('fa fa-copy');
//                    $item->weight(0);
//                    $item->append('admin.register.file.create');
//                    $item->route('admin.register.file.index');
//                    $item->authorize(
//                        $this->auth->hasAccess('register.files.index')
//                    );
//                });
// append



            });
        });

        return $menu;
    }
}
