<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Http\Controllers\MenuController;

class SetMenuUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $login){

        $menuCon = new MenuController();
        $menu = $menuCon->getMenuByUserGrant($login->user->id_kategori_user);
        $subMenu = $menuCon->getSubMenuByUserGrant($login->user->id_kategori_user);

        session([
            'menu' => $menu,
            'subMenu' => $subMenu
        ]);

    }
}
