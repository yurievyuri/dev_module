<?php
    /**
     * Created by PhpStorm.
     * User: yuri
     * Date: 2019-02-17
     * Time: 21:46
     */
    
    class Tour extends Booking {
        
        public function GetList ()
        {
            return parent::GetList(GET_IBLOCK_TOUR);
        }
        
        public function GetListType ()
        {
            return parent::GetList(GET_IBLOCK_TYPE);
        }
    }