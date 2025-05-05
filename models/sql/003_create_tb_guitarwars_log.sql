CREATE TABLE tb_guitarwars_log(
`id` INT NOT NULL AUTO_INCREMENT,
`id_guitarwars` INT NOT NULL, 
`date` DATETIME NOT NULL, 
`name` VARCHAR(50) NOT NULL,
`score` INT UNSIGNED NOT NULL,
`screenshot` VARCHAR(50) NULL,
`message` VARCHAR(100),
PRIMARY KEY(id) 
);