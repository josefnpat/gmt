<?php

error_reporting(-1);

require("config.php");
require("header.inc");

$db = new PDO(
  'mysql:host='.GMT_DB_HOST.';dbname='.GMT_DB_NAME.';',
  GMT_DB_USER,
  GMT_DB_PASS,
  array(PDO::ERRMODE_WARNING => TRUE)
);

if( isset($_POST) and count($_POST) > 0){
  $errors = array();
  $msg = array();

  $entry = array();

  $entry['cost'] = (float)$_POST['cost'];
  if( $entry['cost'] == 0 ){
    $entry['cost'] = $_POST['cost'];
    $errors[] = "Invalid entry for cost.";
  }

  $entry['distance'] = (float)$_POST['distance'];
  if( $entry['distance'] == 0 ){
    $entry['distance'] = $_POST['distance'];
    $errors[] = "Invalid entry for distance.";
  }

  $entry['capacity'] = (float)$_POST['capacity'];
  if( $entry['capacity'] == 0 ){
    $entry['capacity'] = $_POST['capacity'];
    $errors[] = "Invalid entry for capacity.";
  }

  if( isset($_POST['date']) and $_POST['date'] != "" ){
    $entry['date'] = strtotime($_POST['date']);
  } else {
    $entry['date'] = time();
  }
  if($entry['date'] === false){
    $entry['date'] = $_POST['date'];
    $errors[] = "Invalid entry for date.";
  }

  if( defined('GMT_PASS') ) {
    if( $_POST['password'] == "" ){
      $errors[] = "Please supply a password";
    } elseif ($_POST['password'] != GMT_PASS) {
      $errors[] = "Incorrect password.";
    }
  }

  if(count($errors) == 0){
    $query = "INSERT INTO entries (cost,distance,capacity,date) VALUES (".
      $db->quote($entry['cost']).",".
      $db->quote($entry['distance']).",".
      $db->quote($entry['capacity']).",".
      $db->quote($entry['date']).
      ")";
    $q = $db->query($query);

    $msg[] = "Entry recorded.";

    $entry = NULL;

  }
}

require("form.inc");

$q = $db->query("SELECT * FROM entries ORDER BY date DESC");
$db_entries = $q->fetchAll(PDO::FETCH_ASSOC);
if(count($db_entries)>0){
  echo '<table class="table table-striped">';
  $total_distance =0;
  $total_capacity =0;
  $total_cost     =0;
  foreach($db_entries as $db_entry){
    $total_distance +=$db_entry['distance'];
    $total_capacity +=$db_entry['capacity'];
    $total_cost     +=$db_entry['cost'];
?>
<tr>
  <td><?php echo date("Y-m-d",$db_entry['date']); ?></td>
  <td><?php echo $db_entry['capacity']; ?> gal @
    $<?php echo $db_entry['cost']; ?>/gal
    ($<?php echo round($db_entry['cost']*$db_entry['capacity'],2); ?>)</td>
  <td><?php echo $db_entry['distance']; ?> mi</td>
  <td><?php echo round($db_entry['distance']/$db_entry['capacity'],2); ?> mi/gal</td>
</tr>
<?php
  }
  echo '</table>';

  ?>
  <ul>
    <li>Total Average Mileage: <?php echo round($total_distance/$total_capacity,2); ?> mi/gal</li>
    <li>Total Distance: <?php echo $total_distance; ?> mi (Average: <?php echo round($total_distance/count($db_entries),2); ?> mi)</li>
    <li>Total Capacity Filled: <?php echo $total_capacity; ?> gal (Average: <?php echo round($total_capacity/count($db_entries),2); ?> gal)</li>
    <li>Total Cost: $<?php echo $total_cost; ?> (Average: $<?php echo round($total_capacity/count($db_entries),2); ?>/gal)</li>
  </ul>
  <?php

}


require("footer.inc");
