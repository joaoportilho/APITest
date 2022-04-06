CREATE DATABASE `manutencao_faculdade` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

CREATE TABLE `chamado` (
  `id_chamado` int(11) NOT NULL AUTO_INCREMENT,
  `campus` varchar(10) NOT NULL,
  `bloco` varchar(10) NOT NULL,
  `tipo_local` varchar(20) NOT NULL,
  `local` varchar(20) NOT NULL,
  `prioridade` int(11) NOT NULL,
  `detalhes` varchar(255) NOT NULL,
  `st_chamado` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id_chamado`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

CREATE TABLE `local` (
  `id_local` int(11) NOT NULL AUTO_INCREMENT,
  `campus` varchar(10) NOT NULL,
  `bloco` varchar(10) NOT NULL,
  `andar` varchar(10) NOT NULL,
  `sala` varchar(10) NOT NULL,
  `outro` varchar(55) NOT NULL,
  PRIMARY KEY (`id_local`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
