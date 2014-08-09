<?php

include('phpgraphlib/phpgraphlib.php');
$graph = new PHPGraphLib(500,350);

require('config.php');
$db = new PDO(
  'mysql:host='.GMT_DB_HOST.';dbname='.GMT_DB_NAME.';',
  GMT_DB_USER,
  GMT_DB_PASS,
  array(PDO::ERRMODE_WARNING => TRUE)
);

$q = $db->query("SELECT distance,capacity,date FROM entries");

$entries = $q->fetchAll(PDO::FETCH_ASSOC);

$data = array();

foreach($entries as $entry){
  $data[$entry['date']] = $entry['distance']/$entry['capacity'];
}

$graph->addData($data);
$graph->setLine(true);
$graph->setBars(false);
$graph->setTitle('Mileage');
$graph->setGradient('red', 'maroon');
imagepng($graph->createGraph());
