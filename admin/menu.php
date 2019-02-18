<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$menu = array(
    array(
        'parent_menu'   => 'global_menu_content', //global_menu_services
        'sort'          => 1,
        'text'          => 'Настройки сайта',
        'title'         => 'Расширенные настройки разработчика',
        'url'           => 'admin.php',
        'items_id'      => 'menu_references',
        'items'         => array(
            array(
                'text' => Loc::getMessage('SUBMENU_TITLE'),
                'url' => 'admin.php?param1=paramval&lang=' . LANGUAGE_ID,
                'more_url' => array('admin.php?param1=paramval&lang=' . LANGUAGE_ID),
                'title' => Loc::getMessage('SUBMENU_TITLE'),
            ),
        ),
    ),
);

return $menu;
