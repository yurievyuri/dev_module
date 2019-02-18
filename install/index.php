<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Dev\Extended\DeveloperTable;

Loc::loadMessages(__FILE__);

class dev_extended extends CModule
{
    public function __construct()
    {
        
        $this->MODULE_VERSION       = '0.0.1';
        $this->MODULE_VERSION_DATE  = date('Y-m-d');
        $this->MODULE_ID            = 'dev.extended';
        $this->MODULE_NAME          = 'Модуль разработчика';
        $this->MODULE_DESCRIPTION   = 'Расширенные настройки, классы, методы';
        $this->MODULE_GROUP_RIGHTS  = 'N';
        $this->PARTNER_NAME         = 'U+U';
        $this->PARTNER_URI          = 'http://market.yy24.ru';
    }
    
    public function InstallFiles()
    {
        // копируем файл настроек в /local/
        if( !file_exists( $_SERVER["DOCUMENT_ROOT"] . '/local/dev_settings.php' ))
            copy(
                __DIR__  . '/dev_settings.php',
                $_SERVER[ "DOCUMENT_ROOT" ] . "/local/dev_settings.php"
            );
    
        // для быстрого доступа создаем сиволическую ссылку на классы модуля в /local/
        /*if( !readlink  ($_SERVER['DOCUMENT_ROOT'] . '/local/' . 'dev_classes_link') ):
        
            $target = $_SERVER['DOCUMENT_ROOT']     . '/local/modules/' . $this->MODULE_ID . '/lib';
            $link   = $_SERVER[ 'DOCUMENT_ROOT' ]   . '/local/dev_classes_link';
        
            if(!readlink($link))
                symlink(
                    $target,
                    $link
                );
        endif;*/
        
    }
    
    
    public function doInstall()
    {
        //$this->installDB();
        $this->InstallFiles();
        ModuleManager::registerModule($this->MODULE_ID);
        
    }
    
    
    public function doUninstall()
    {
        //$this->uninstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            //DeveloperTable::getEntity()->createDbTable();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(DeveloperTable::getTableName());
        }
    }
}
