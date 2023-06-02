-- CREATE TABLE PLAYER
CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `number` int(11) NOT NULL UNIQUE,
  `birthDate` date NOT NULL,
  `age` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERT DUMP DATA
INSERT INTO `player` (`name`, `position`, `number`, `birthDate`, `age`, `nationality`, `image`) VALUES ('Karim Mostafa Benzema', 'Striker', '9', '1987:11:19', YEAR(CURRENT_DATE) - YEAR(birthDate), 'France', 'benzema.png');
INSERT INTO `player` (`name`, `position`, `number`, `birthDate`, `age`, `nationality`, `image`) VALUES ('Thibaut Nicolas Marc Courtois', 'Goalkeeper', '1', '1992:05:11', YEAR(CURRENT_DATE) - YEAR(birthDate), 'Belgium', 'courtois.png');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL UNIQUE,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;