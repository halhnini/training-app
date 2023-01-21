<?php

namespace App\Factory;

use App\Entities\Location;

class LocationFactory
{
    public static function createFromArray(array $result): Location
    {
        $location = new Location();
        $location->setAddress($result['formatted_address'])
                 ->setLat($result['geometry']['location']['lat'])
                 ->setLng($result['geometry']['location']['lng'])
                 ->setPlaceID($result['place_id']);

        return $location;
    }
}
