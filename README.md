# EcommerceAPI
##project structure
- *sql*: sql scripts to create the database from scratch
  - database structure can be found here: ![Image of Yaktocat](https://i.ibb.co/MkrVtxB/Captura-de-ecra-2019-12-30-a-s-23-44-24.png)
- src/php: php controllers for the backend services
  - **ShoppingListController.php**:
     - GET: returns the products already added to the shopping list in the database
     - POST: NOT IMPLEMENTED YET. TO BE DONE LATER
  - **ProductsController.php**:
     - GET: NOT CORRECTLY IMPLEMENTED YET. TO BE DONE LATER
- views: html files with the layouts and logic to retrieve data from the backend and present it
  - **shoppinglist.html**:
       - [IN PROGRESS] shows the list of products already added to the shopping list in the database. Currently only shows a raw JSON with the sql query results
  - **products.html**: NOT CORRECTLY IMPLEMENTED YET. TO BE DONE LATER