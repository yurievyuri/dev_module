<?php
    /**
     * Created by PhpStorm.
     * User: yuri
     * Date: 2019-02-17
     * Time: 17:24
     */
    
    if(class_exists('Booking'))
        return;
    
    class Booking extends UU
    {
        public function GetList( $IblockId = false ){
    
            $db = CIBlockElement::GetList(
                Array('NAME'=>'ASC'),
                Array(
                    'IBLOCK_ID'         => $IblockId,
                    'ACTIVE'            => 'Y',
                    'CHECK_PERMISSIONS' => 'N'
                ),
                false,
                false,
                parent::TotalFieldsList( $IblockId )
            );
    
            while ( $list = $db->Fetch() )
                $returnArray[] = parent::CleanListArray($list);
    
            /** @var TYPE_NAME $returnArray */
            return $returnArray;
            
        }
        
    }
