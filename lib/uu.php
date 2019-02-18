<?php
    /**
     * Created by PhpStorm.
     * User: yuri
     * Date: 2019-02-17
     * Time: 11:13
     */
    
    // выбор всех пользовательских и стандартных полей
    //->TotalFieldsList( 191 );
    // очистка мусора PROPERTY_ _VALUE
    //->CleanListArray( $list );
    
   //if(class_exists('UU')) return false;
    
    class UU {
        
        public function __construct(){
        
            define( 'STANDART_ELEMENT_FIELDS',  array_keys(\Bitrix\Iblock\ElementTable::getMap()) );
            define( 'STANDART_SECTION_FIELDS',  array_keys(\Bitrix\Iblock\SectionTable::getMap()) );
        
            $this->STANDART_ELEMENT_FIELDS = STANDART_ELEMENT_FIELDS;
            $this->STANDART_SECTION_FIELDS = STANDART_SECTION_FIELDS;
            
        }
    
        /**
         * @param bool $field
         *
         * @return bool
         */
        public function CheckToSystemField($field = false){
        
            if(!$field)
                return false;
        
            if( in_array($field, STANDART_ELEMENT_FIELDS) )
                return true;
            else
                return false;
        }
    
        /**
         * @param bool $field
         *
         * @return bool|string
         */
        public function AddToUserFieldPropValue($field = false){
        
            if(!$field)
                return false;
        
            if( $this->CheckToSystemField($field) === false)
                return strtoupper(
                    self::MoveSpecialSymbols('PROPERTY_'.$field)
                );
            else
                return $field;
        }
    
        /**
         * @param bool $string
         * @return bool|string
         */
        public function MoveSpecialSymbols($string = false){
        
            $special_symbols = preg_replace("/[^<>=!?]/", "", $string);
        
            if(strlen($special_symbols)>0)
            
                return $special_symbols.str_replace([$special_symbols],'', $string);
        
            else
            
                return $string;
        }
    
    
        /**
         * Выбираем из массива только системные свойства инфоблока
         * @param array $array
         *
         * @return array|bool
         */
        public function ExtractSystemFields($array = []){
        
            if(empty($array))
                return false;
        
            $return = [];
        
            foreach($array as $key => $value)
                if( $this->CheckToSystemField($key) )
                    $return[ $key ] = ( is_array($value) || is_object($value) ) ? $value : trim($value) ;
        
            return $return;
        }
    
        /**
         * Выбираем из массива только пользовательские свойства инфоблока
         * @param array $array
         *
         * @return array|bool
         */
        public function ExtractUserFields($array = [], $bitrixExt = true){
        
            if(empty($array))
                return false;
        
            $return = [];
        
            foreach($array as $key => $value)
                if( $value )
                    $return[ ($bitrixExt) ? $this->AddToUserFieldPropValue($key) : $key ]
                        = ( is_array($value) || is_object($value) ) ? $value : trim($value) ;
        
            return $return;
        }
    
        /**
         * Список пользовательских свойств для инфоблока
         * @param bool $iblockId
         * @param null $ext '_VALUE' при необходимости
         *
         * @return array|bool
         */
        public function GetUserPropList($iblockId = false, $ext = null){
        
            if(!$iblockId)
                return false;
            $return = [];
        
            $db = CIBlockProperty::GetList(
                Array('NAME' => 'ASC'),
                Array(
                    "ACTIVE"            =>  "Y",
                    "IBLOCK_ID"         =>  $iblockId,
                    "CHECK_PERMISSIONS" =>  "N"
                )
            );
        
            while( $list = $db->Fetch() )
                $return[] = 'PROPERTY_'.$list['CODE'].$ext;
        
            return $return;
        }
    
        /**
         * Для того чтобы не мучаться каждый раз набирая ручками список полей для выборки
         * используем данный скрипт. Безусловно уже не так быстро будет работать getlist )
         * @param bool $iblockId
         *
         * @return array|bool
         */
        public function TotalFieldsList($iblockId = false){
        
            if(!$iblockId)
                return false;
        
            return array_values(array_merge(
                STANDART_ELEMENT_FIELDS,
                self::GetUserPropList($iblockId)
            ));
        }
    
        /**
         * Так как достаточно гемморойно постоянно прописывать PROPERTY_ _VALUE
         * вычищаем этот мусор из массива
         * @param array $list
         * @return array|bool
         */
        public function CleanListArray($list = []){
        
            if(empty($list))
                return false;
        
            $return = [];
        
            foreach ( $list as $key => $value ) :
            
                if(
                    !stristr( $key ,'_VALUE_ID' )
                    &&
                    !stristr( $key ,'_ENUM_ID' )
                    &&
                    !stristr( $key, 'PROPERTY_' )
                    &&
                    !stristr( $key, '_VALUE' )
                ):
                    $return[$key] = $value;
            
                elseif(
                    !stristr( $key ,'_VALUE_ID' )
                    &&
                    !stristr( $key ,'_ENUM_ID' )
                    &&
                    stristr( $key, 'PROPERTY_' )
                    &&
                    stristr( $key, '_VALUE' )
                ):
                
                    if(!in_array(str_replace(['PROPERTY_', '_VALUE'], '', $key), STANDART_ELEMENT_FIELDS))
                        $return[str_replace(['PROPERTY_', '_VALUE'], '', $key)] = $value;
                    else
                        $return[$key] = $value;
                endif;
        
            endforeach;
        
            return $return;
        }
    
        /**
         * @param      $IblockId
         * @param bool $nameSection
         *
         * @return bool
         */
        public function GetSectionIdByName( $IblockId, $nameSection = false ){
        
            if (!$IblockId)
                return false;
        
            return CIBlockSection::GetList(
                false,
                Array(
                    'IBLOCK_ID'         =>  (int)$IblockId ,
                    'CHECK_PERMISSIONS' =>  'N',
                    'ACTIVE'            =>  'Y',
                    'NAME'              =>  trim($nameSection)
                ) ,
                false,
                Array( 'ID' )
            )->Fetch()['ID'];
        }
        
    }