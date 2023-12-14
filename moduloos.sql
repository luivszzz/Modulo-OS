CREATE DATABASE joaomanutencao;

USE joaomanutencao;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `nomeCliente` varchar(50) NOT NULL,
  `cpfCliente` varchar(18) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `infoAdic` text,
  `prdtModelo` varchar(40),
  `prdtDetalhes` varchar(60),
  `prdtReclam` text,
  `servDiag` text,
  `servGarant` text,
  `valorServ` int(10),
  `valorPeca` int(10),
  `orderEstado` varchar(15),
  `userID` int(11) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orders`
  ADD FOREIGN KEY (`userID`) REFERENCES `users`(`userID`);

COMMIT;