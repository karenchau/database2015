CREATE TABLE `platforajxh8lc9y`.`temp_table_1` (
  `group_id` VARCHAR(10) NOT NULL,
  `class` VARCHAR(10) NOT NULL,
  `average` DECIMAL(10) NOT NULL DEFAULT 0,
  `rank` INT NULL,
  PRIMARY KEY (`group_id`, `class`));
