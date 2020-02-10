<?php
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD']; // GET, POSTS, DELETE
//$request = explode('/', trim($_SERVER['PATH_INFO'],'/')); // products/1
 
// connect to the mysql database
$link = mysqli_connect('remotemysql.com', 'DGaSoR20oc', 'ENOcr4QJtJ', 'DGaSoR20oc');
 
// retrieve the table and key from the path
//$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request)); // products or users or whatever
//$key = array_shift($request)+0; // id
$query = mysqli_real_escape_string($link, $_GET['query']);
// create SQL Query based on HTTP method
switch ($method) {
  case 'GET':
    $sql = "SELECT * FROM products WHERE name LIKE '%$query%';"; 
}
 
// excecute SQL statement and return the ### LIST ### of products in the shopping list
// https://stackoverflow.com/questions/3351882/how-to-convert-mysqli-result-to-json
$resultArray = array(); // an empty array
if ($result = $link->query($sql)) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $resultArray[] = $row;
    }
    echo json_encode($resultArray);
} else {
  echo "No Results";
}

// close mysql connection
mysqli_close($link);