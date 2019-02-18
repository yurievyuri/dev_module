<?php
    /**
     * Created by PhpStorm.
     * User: yuri
     * Date: 2019-02-17
     * Time: 15:14
     */
    
//    if(class_exists('Picture'))
//        return;
    
    class Picture extends UU {
    
        public function GetPathRandomPicture ( $IblockId = false, $section = false ) {
            
            $IblockId = (int)$IblockId ? $IblockId : GET_IBLOCK_BACKGROUNDS;
            
            $picId = CIBlockElement::GetList(
                Array('RAND'=>'ID'),
                Array(
                    'IBLOCK_ID'         => $IblockId,
                    'ACTIVE'            => 'Y',
                    'CHECK_PERMISSIONS' => 'N',
                    'SECTION_ID'        => parent::GetSectionIdByName( $IblockId, $section )
                ),
                false,
                Array('nTopCount' => 1),
                Array('PREVIEW_PICTURE')
            )->Fetch()['PREVIEW_PICTURE'];
        
            if (!$picId)
                return false;
    
            return CFile::GetPath($picId);
        
        }
    }