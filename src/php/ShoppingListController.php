<?php
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD']; // GET, POSTS, DELETE
 
// connect to the mysql database
$link = mysqli_connect('remotemysql.com', 'DGaSoR20oc', 'ENOcr4QJtJ', 'DGaSoR20oc');
 
// create SQL Query based on HTTP method
switch ($method) {
  case 'GET':
    //: create query that Joins the shopping list with the products and returns the id, name and quantity of the existing products in the shopping
    $sql = "SELECT shoppinglist.id, products.name, shoppinglist.quantity, shoppinglist.position FROM products INNER JOIN shoppinglist ON products.id = shoppinglist.product_id ORDER BY shoppinglist.position;";
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