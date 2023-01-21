<?php

namespace App\Entities;

class Location
{
    private string $address;
    private float $lat;
    private float $lng;
    private string $placeID;

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLng(): float
    {
        return $this->lng;
    }

    public function getPlaceID(): string
    {
        return $this->placeID;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function setPlaceID(string $placeID): self
    {
        $this->placeID = $placeID;

        return $this;
    }
}
