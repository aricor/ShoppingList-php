CREATE TABLE `products` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `id_index` (`id`)
);

-- ADD INDEX TO TABLE PRODUCTS
ALTER TABLE `DGaSoR20oc`.`products` 
ADD INDEX `id_index` (`id` ASC) VISIBLE;
;

--  CREATE AUTO GENERATED ID AND MAKE THEM UNIQUE
ALTER TABLE `DGaSoR20oc`.`shoppinglist` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;

-- add indexes
ALTER TABLE `DGaSoR20oc`.`shoppinglist` 
ADD UNIQUE INDEX `product_id_UNIQUE` (`product_id` ASC) VISIBLE,
ADD UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE;
;

-- create position field
ALTER TABLE `DGaSoR20oc`.`shoppinglist` 
ADD COLUMN `position` INT(11) NOT NULL AFTER `quantity`;


-- ADD TABLE shoppinglist (cart)
CREATE TABLE `DGaSoR20oc`.`shoppinglist` (
  `id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_idx` (`product_id` ASC) VISIBLE,
  CONSTRAINT `id`
    FOREIGN KEY (`product_id`)
    REFERENCES `DGaSoR20oc`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- INSERT PRODUCTS TO shoppingList (cart) EXAMPLE
INSERT INTO `DGaSoR20oc`.`shoppinglist` (`id`, `product_id`, `quantity`) VALUES ('1', '1', '2'); -- add product 1 with quantity 2
INSERT INTO `DGaSoR20oc`.`shoppinglist` (`id`, `product_id`, `quantity`) VALUES ('2', '2', '4'); -- add product 2 with quantity 4

