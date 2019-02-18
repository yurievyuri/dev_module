<?php
    global $DBType;
    
    $arClasses = array(
        
        'UU'        =>  'lib/uu.php',
        'Picture'   =>  'lib/picture.php',
        'Booking'   =>  'lib/booking.php',
        'Continent' =>  'lib/continent.php',
        'Country'   =>  'lib/country.php',
        'Place'     =>  'lib/place.php',
        'Tour'      =>  'lib/tour.php',
        'Offer'     =>  'lib/offer.php',
    );
    
    \Bitrix\Main\Loader::registerAutoLoadClasses("dev.extended", $arClasses);
    