<?
    use Bitrix\Main\Config\Option;
    
    $aTabs =  array(
        
        array(
            "DIV" 	    => "edit",
            "TAB"       => 'Основная',
            "TITLE"     => 'Настройки сайта',
            "OPTIONS" => array(
                'Расширенные настройки сайта',
                array(
                    "NAME",
                    'Наименование компании',
                    Option::get($module_id, "NAME"),
                    array("text", 50)
                ),
                array(
                    "SLOGAN",
                    'Слоган',
                    Option::get($module_id, "SLOGAN"),
                    array("text", 50)
                ),
                array(
                    "ZIP",
                    'Индекс',
                    Option::get($module_id, "ZIP"),
                    array("text", 7)
                ),
                array(
                    "CITY",
                    'Город',
                    Option::get($module_id, "CITY"),
                    array("text", 50)
                ),
                array(
                    "ADRESS",
                    'Адрес (без города)',
                    Option::get($module_id, "ADRESS"),
                    array("text", 100)
                ),
                array(
                    "PHONE",
                    'Контактный телефон',
                    Option::get($module_id, "PHONE"),
                    array("text", 30)
                ),
                array(
                    "EMAIL",
                    'Контактная почта',
                    Option::get($module_id, "EMAIL"),
                    array("text", 30)
                ),
                array(
                    "FACEBOOK",
                    'facebook',
                    Option::get($module_id, "FACEBOOK"),
                    array("text", 80)
                ),
                array(
                    "VK",
                    'ВКонтакте',
                    Option::get($module_id, "VK"),
                    array("text", 80)
                ),
                array(
                    "INSTAGRAM",
                    'instagram',
                    Option::get($module_id, "INSTAGRAM"),
                    array("text", 80)
                ),
                array(
                    "TELEGRAM",
                    'telegram',
                    Option::get($module_id, "TELEGRAM"),
                    array("text", 80)
                ),
                array(
                    "TWITTER",
                    'twitter',
                    Option::get($module_id, "TWITTER"),
                    array("text", 80)
                ),
            )
        )
    );
    
/*
     
// некоторые настройки типов полей по умолчанию для примера
    
$aTabs = array(
        array(
            "DIV" 	  => "edit",
            "TAB" 	  => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_NAME"),
            "TITLE"   => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_NAME"),
    
            "OPTIONS" => array(
                Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_COMMON"),
                array(
                    "switch_on",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SWITCH_ON"),
                    "Y",
                    array("checkbox")
                ),
                Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_APPEARANCE"),
                array(
                    "width",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_WIDTH"),
                    "50",
                    array("text", 5)
                ),
                array(
                    "height",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_HEIGHT"),
                    "50",
                    array("text", 5)
                ),
                array(
                    "radius",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_RADIUS"),
                    "50",
                    array("text", 5)
                ),
                array(
                    "color",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_COLOR"),
                    "#bf3030",
                    array("text", 5)
                ),
                Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_POSITION_ON_PAGE"),
                array(
                    "side",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SIDE"),
                    "left",
                    array("selectbox", array(
                        "left"  => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SIDE_LEFT"),
                        "right" => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SIDE_RIGHT")
                    ))
                ),
                array(
                    "indent_bottom",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_INDENT_BOTTOM"),
                    "10",
                    array("text", 5)
                ),
                array(
                    "indent_side",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_INDENT_SIDE"),
                    "10",
                    array("text", 5)
                ),
                Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_ACTION"),
                array(
                    "speed",
                    Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SPEED"),
                    "normal",
                    array("selectbox", array(
                        "slow"   => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SPEED_SLOW"),
                        "normal" => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SPEED_NORMAL"),
                        "fast"   => Loc::getMessage("FALBAR_TOTOP_OPTIONS_TAB_SPEED_FAST")
                    ))
                )
              )
            )
);

*/