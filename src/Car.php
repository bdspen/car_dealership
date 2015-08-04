<?php
class Car
{
    private $make_model;
    private $price;
    private $image;
    private $miles;
    function __construct($car_model, $car_image, $car_miles, $car_price = 45000)
    {
      $this->make_model = $car_model;
      $this->image = $car_image;
      $this->miles = $car_miles;
      $this->price = $car_price;
    }
    function setName($new_name)
    {
      $changed_name = (string) $new_name;
      $this->make_model = $changed_name;
    }
    function getName()
    {
      return $this->make_model;
    }
    function setPrice($new_price)
    {
      $float_price = (float) $new_price;
      if ($float_price != 0) {
        $formatted_price = number_format($float_price, 2);
        $this->price = $formatted_price;
      }
    }
    function getPrice()
    {
      return $this->price;
    }
    function setMileage($new_mileage)
    {
      $number_mileage = (integer) $new_mileage;
      if ($number_mileage != 0) {
        $this->miles = $number_mileage;
      }
    }
    function getMiles()
    {
      return $this->miles;
    }
    function setImage($new_image)
    {
      $image_change = (string) $new_image;
      $this->image = $image_change;
    }
    function getImage()
    {
      return $this->image;
    }
}

?>
