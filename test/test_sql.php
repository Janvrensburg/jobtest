CREATE TABLE test (
`transaction_id` INT NOT NULL AUTO_INCREMENT,
`transaction_date` DATETIME,
`foreign_currency` VARCHAR(5),
`exchange_rate` DECIMAL(15,10),
`surcharge_percentage` DECIMAL(15,2),
`purchased_currency` VARCHAR(25),
`amount_due` DECIMAL(15,2),
`surcharge_total` VARCHAR(25),
`discount` decimal(15,2) DEFAULT NULL,
`email` varchar(255) DEFAULT NULL,
PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM;

