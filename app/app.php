<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();
    //created Silex object
    $app->get("/", function() {
      return "<!DOCTYPE html>
      <html>
      <head>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
          <title>Find a Car</title>
      </head>
      <body>
          <div class='container'>
              <h1>Find a Car!</h1>
              <form action='/car_list'>
                  <div class='form-group'>
                      <label for='price'>Enter Maximum Price:</label>
                      <input id='price' name='price' class='form-control' type='number'>
                  </div>
                  <div class='form-group'>
                    <label for='mileage'>Enter Maximum Mileage:</label>
                    <input id='mileage' name='mileage' class='form-control' type='number'>
                  </div>
                  <button type='submit' class='btn-success'>Submit</button>
              </form>
          </div>
      </body>
      </html>";
    });
    //Input form for app

    $app->get("/car_list", function() {
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
      //making new car objects and putting them into an array
      $cars_matching_search = array();
      foreach ($cars as $car) {
          if ($car->getPrice() <= $_GET["price"] && $car->getMiles() <= $_GET["mileage"]) {
              array_push($cars_matching_search, $car);
          }
      }
      //compares user input to the values in the cars

      if (empty($cars_matching_search)) {
        $list_of_cars = "<p> Sorry no cars match your search </p>";
      } else {
        $list_of_cars = "";
        foreach ($cars_matching_search as $car) {
          $list_of_cars = $list_of_cars . '<img src='. $car->getImage() . '>
          <li>' . $car->getName() . '</li>
          <ul>
            <li>$'. $car->getPrice(). '</li>
            <li>' . $car->getMiles(). '</li>
          </ul>';
        }
      }
      //if there are cars matching the search this creates a list of those cars
      //if no matching cars, app returns Sorry no cars match your search
      //list_of_cars builds unordered lists for all of the cars that match search
      return "<!DOCTYPE html>
      <html>
      <head>
          <title>Your Car Dealership's Homepage</title>
          <link rel='stylesheet' href='styles.css' media='screen' title='no title' charset='utf-8'>
      </head>
      <body>
          <h1>Your Car Dealership</h1>
            <ul>
              $list_of_cars
          </ul>
      </body>
      </html>";
    });
    return $app;
 ?>
