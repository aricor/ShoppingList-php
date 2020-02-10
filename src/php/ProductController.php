<?php
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD']; // GET, POSTS, DELETE
 
// connect to the mysql database
$link = mysqli_connect('remotemysql.com', 'DGaSoR20oc', 'ENOcr4QJtJ', 'DGaSoR20oc');

$queryId = json_decode(file_get_contents('php://input'), true)["id"];

// create SQL Query based on HTTP method
switch ($method) {
  case 'POST':
    $sql = "INSERT INTO shoppinglist (product_id, quantity, position) VALUES ($queryId,1,(SELECT count(*)+1 from shoppinglist T)) ON DUPLICATE KEY UPDATE quantity=(quantity + 1)"; 
    break;
  case 'DELETE':
    $sql = "DELETE FROM shoppinglist WHERE id=$queryId;"; 
    break;
  case 'PUT':
    $queryQuantity = json_decode(file_get_contents('php://input'), true)["quantity"];
    if($queryQuantity) {
      $sql = "UPDATE shoppinglist SET quantity=$queryQuantity WHERE id=$queryId;"; 
      // excecute SQL statement and return the ### LIST ### of products in the shopping list
    } else {
      $queryMove = json_decode(file_get_contents('php://input'), true)["move"]; // 'up' or 'down
      if($queryMove == 'up') {
        echo 'moving up';
        $sql = "
          UPDATE 
          shoppinglist as s1, 
            shoppinglist as s2 
          SET 
            s1.position = s2.position, 
            s2.position=s1.position 
          WHERE 
            s1.id = $queryId AND s2.position = s1.position - 1;
        "; 
      } else if ($queryMove == 'down') {
        echo 'moving down';
        $sql = "
          UPDATE 
          shoppinglist as s1, 
            shoppinglist as s2 
          SET 
            s1.position = s2.position, 
            s2.position=s1.position 
          WHERE 
            s1.id = $queryId AND s2.position = s1.position + 1;
        "; 
      }
    }
    
    break;  
}

$resultArray = array(); // an empty array
if ($result = $link->query($sql)) {
    echo "Added";
} else {
  echo "Not Added";
  printf("Error message: %s\n", $link->error);
}

// close mysql connection
mysqli_close($link);