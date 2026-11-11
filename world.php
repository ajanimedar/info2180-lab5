<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);



$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup == 'cities'){
  $sql = "SELECT cities.name AS city_name, cities.district, cities.population
          FROM cities JOIN countries ON cities.country_code = countries.code
          WHERE countries.name LIKE '%$country%'";
}else{
  $sql = "SELECT * FROM countries WHERE name LIKE '%$country%'";

}

$stmt = $conn->query($sql);
$results = $stmt->fetchall(PDO::FETCH_ASSOC);

if(count($results)>0){
  echo "<table>";

  echo "<thead>";




  if($lookup == 'cities'){
    echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";
   
    }else{
      echo "<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
  }


  echo "</thead>";
  echo "<tbody>";

  foreach($results as $row){
    echo "<tr>";
    if($lookup == 'cities'){
      echo "<td>" . $row['city_name'] . "</td>";
      echo "<td>" . $row['district'] . "</td>";
      echo "<td>" . $row['population'] . "</td>";
    }else{
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['continent'] . "</td>";
      echo "<td>" . $row['independence_year'] . "</td>";
      echo "<td>" . $row['head_of_state'] . "</td>";
    }
    echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";


}else{
  echo "<p>No results found.</p>";
}

