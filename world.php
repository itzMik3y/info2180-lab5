<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
  $country = $_GET['country'];

  // Check if 'lookup' is set to 'cities'
  if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
      // SQL to fetch cities in the country
      $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population 
                              FROM cities 
                              JOIN countries ON cities.country_code = countries.code 
                              WHERE countries.name LIKE :country");
       $country = "%$country%";
       $stmt->bindParam(':country', $country, PDO::PARAM_STR);
       $stmt->execute();
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

       echo '<table>';
        echo '<tr><th>Name</th><th>District</th><th>Population</th></tr>';
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['district'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['population'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '</tr>';
        }
        echo '</table>';
  } else {
      // SQL to fetch country information
      $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
      $country = "%$country%";
      $stmt->bindParam(':country', $country, PDO::PARAM_STR);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  if (!isset($_GET['lookup']) || $_GET['lookup'] !== 'cities') {
    echo '<table>';
    echo '<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>';
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['continent'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['independence_year'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['head_of_state'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
}

?>

