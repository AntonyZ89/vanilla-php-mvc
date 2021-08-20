CREATE TABLE `user` (
  `id` int NOT NULL primary key AUTO_INCREMENT,
  `document` VARCHAR(14) NOT NULL,
  `birthday` DATE NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` INT NOT NULL,
  `updated_at` INT NOT NULL
) default charset utf8;

CREATE TABLE `debt` (
  `id` int NOT NULL primary key AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `value` DECIMAL(12, 2) NOT NULL,
  `due_date` DATE NOT NULL,
  `created_at` INT NOT NULL,
  `updated_at` INT NOT NULL,

  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) default charset utf8;
