<?php
    /**
     * Created by PhpStorm.
     * User: yuri
     * Date: 2019-02-17
     * Time: 21:44
     */
    
    class Continent extends Booking {
        
        public function GetList ()
        {
            return parent::GetList(GET_IBLOCK_CONTINENT);
        }
        
    }