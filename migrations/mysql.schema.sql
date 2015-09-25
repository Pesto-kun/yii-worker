#Пользователи
CREATE TABLE `client` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '1',
  `username` varchar(255) NOT NULL,
  `description` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

#Контакты пользователя
CREATE TABLE `contact` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(32) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_client_id`
  FOREIGN KEY (`client_id`)
  REFERENCES `client` (`id`)
  ON DELETE CASCADE;

#Задачи
CREATE TABLE `task` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` int(11) UNSIGNED NOT NULL,
  `updated` int(11) UNSIGNED NOT NULL,
  `closed` int(11) UNSIGNED,
  `client_id` int(11) UNSIGNED,
  `title` varchar(255) NOT NULL,
  `date` int(11) UNSIGNED,
  `expected_profit` int(11),
  `result_profit` int(11),
  `description` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
ALTER TABLE `task`
  ADD CONSTRAINT `task_client`
  FOREIGN KEY (`client_id`)
  REFERENCES `client` (`id`)
  ON DELETE SET NULL;