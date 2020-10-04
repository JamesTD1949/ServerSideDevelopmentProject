<?php

   try { 
$pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * FROM owners';
$result = $pdo->query($sql); 

echo "<br /><b>List of Owners</b><br /><br />";
echo "<table border=1>";
echo "<tr><th>Owner ID</th>
<th>Name</th></tr>";


while ($row = $result->fetch()) {
echo '<tr><td>' . $row['OwnerID'] . '</td><td>'. $row['Name'] . '</td></tr>';
}
echo '</table>';
} 
catch (PDOException $e) { 
$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
}


include 'whotoupdate.html';

?>