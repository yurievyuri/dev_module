<?php

    use Bitrix\Main\Application;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Main\Config\Option;
    
    //defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'dev.extended');
    $app = Application::getInstance();
    $context = $app->getContext();
    $request = $context->getRequest();
    $module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);
    
    Loc::loadMessages(__FILE__);
    Loc::loadMessages($context->getServer()->getDocumentRoot()."/bitrix/modules/main/options.php");
    
    require_once $_SERVER["DOCUMENT_ROOT"] . '/local/dev_settings.php';
    
    if( !file_exists( $_SERVER["DOCUMENT_ROOT"] . '/local/dev_settings.php' ))
        echo '/local/dev_settings.php - Обязательный файл настроек по указанному пути<br><br>';
    
    if( empty ($aTabs[0]['OPTIONS']) )
        echo 'Отсутствуют заданные настройки в файле /local/dev_settings.php<br><br>';
    
    $tabControl = new CAdminTabControl(
        "tabControl",
        $aTabs
    );
    
    if ((!empty($save) || !empty($restore)) && $request->isPost() && check_bitrix_sessid()) {
        if (!empty($restore)) {
            
            Option::delete($module_id);
            CAdminMessage::showMessage(array(
                "MESSAGE"   => Loc::getMessage("REFERENCES_OPTIONS_RESTORED"),
                "TYPE"      => "OK",
            ));
        } else {
            CAdminMessage::showMessage(Loc::getMessage("REFERENCES_INVALID_VALUE"));
        }
    }
    $tabControl->Begin();
    //<?=sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID)
?>
    
    <form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">
        <?
            foreach($aTabs as $aTab){
                if($aTab["OPTIONS"]){
                    $tabControl->BeginNextTab();
                    __AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
                }
            }
            $tabControl->Buttons();
        ?>
    
        <input type="submit" name="apply" value="<?=Loc::getMessage("MAIN_SAVE") ?>" class="adm-btn-save" />
        
        <?echo(bitrix_sessid_post());?>
    
    </form>

<?
    $tabControl->End();
    
    if($request->isPost() && check_bitrix_sessid()){
        
        foreach($aTabs as $aTab){
            
            foreach($aTab["OPTIONS"] as $arOption){
                
                if(!is_array($arOption)){
                    
                    continue;
                }
                
                if($arOption["note"]){
                    
                    continue;
                }
                
                if($request["apply"]){
                    
                    $optionValue = $request->getPost($arOption[0]);
                    
                    if($arOption[0] == "switch_on"){
                        
                        if($optionValue == ""){
                            
                            $optionValue = "N";
                        }
                    }
                    
                    Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
                }elseif($request["default"]){
                    
                    Option::set($module_id, $arOption[0], $arOption[2]);
                }
            }
        }
        
        LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
    }