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
$porsche = new Car("2014 Porsche 911", "images/911.jpeg", 7864, 114991 );
$ford = new Car("2011 Ford F450", "images/ford.jpg", 14241);
$lexus = new Car("2013 Lexus RX 350", "images/lexus.jpg", 20000);
$mercedes = new Car("Mercedes Benz CLS550", "images/mercedes.jpg", 37979, 39900);
$porsche->setName("2013 Porsche 911");
$porsche->setMileage(55555);
$lexus->setPrice(0);
$porsche->setName("2012 Porsche 911");
$mercedes->setName("2009 Mercedes Benz CLS550");
$ford->setImage("images/pinto.jpeg");
$cars = array($porsche, $ford, $lexus, $mercedes);
$cars_matching_search = array();
foreach ($cars as $car) {
    if ($car->getPrice() <= $_GET["price"] && $car->getMiles() <= $_GET["mileage"]) {
        array_push($cars_matching_search, $car);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Car Dealership's Homepage</title>
    <link rel="stylesheet" href="styles.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <h1>Your Car Dealership</h1>
    <ul>
        <?php
            foreach ($cars_matching_search as $car) {
                $car_name = $car->getName();
                $car_price = $car->getPrice();
                $car_mileage = $car->getMiles();
                $car_image = $car->getImage();
                echo "<img src='$car_image'>";
                echo "<li> $car_name </li>";
                echo "<ul>";
                    echo "<li> $$car_price </li>";
                    echo "<li> Miles: $car_mileage </li>";
                echo "</ul>";
            }
            if (empty($cars_matching_search))
            {
              echo "<p> Sorry no cars match your search</p>";
            }
        ?>
    </ul>
</body>
</html>
