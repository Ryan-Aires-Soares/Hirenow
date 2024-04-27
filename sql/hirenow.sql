-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: hirenow
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`idUsuarios`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'Ryan Aires Soares','airesryan88@gmail.com','123asd!*',1);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidato`
--

DROP TABLE IF EXISTS `candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `candidato` (
  `idCandidato` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cand` varchar(45) NOT NULL,
  `data_nasc` date NOT NULL,
  `email_cand` varchar(45) NOT NULL,
  `senha_cand` varchar(45) NOT NULL,
  `Administrador_idUsuarios` int(11) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`idCandidato`),
  KEY `fk_Candidato_Administrador1_idx` (`Administrador_idUsuarios`),
  CONSTRAINT `fk_Candidato_Administrador1` FOREIGN KEY (`Administrador_idUsuarios`) REFERENCES `administrador` (`idUsuarios`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidato`
--

LOCK TABLES `candidato` WRITE;
/*!40000 ALTER TABLE `candidato` DISABLE KEYS */;
INSERT INTO `candidato` VALUES (1,'Tiago','2001-03-02','tiagou@gmail.com','$@DWSEFAs',1,2);
/*!40000 ALTER TABLE `candidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `idChat` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` varchar(300) NOT NULL,
  `data_msg` date NOT NULL,
  `id_candidato` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idChat`),
  KEY `candidato_idx` (`id_candidato`),
  KEY `empresa_idx` (`id_empresa`),
  CONSTRAINT `candidato` FOREIGN KEY (`id_candidato`) REFERENCES `candidato` (`idCandidato`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`idEmpresas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curriculo`
--

DROP TABLE IF EXISTS `curriculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curriculo` (
  `idCurriculo` int(11) NOT NULL AUTO_INCREMENT,
  `escolaridade` varchar(45) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `portifolio` varchar(45) DEFAULT NULL,
  `Candidato_idCandidato` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCurriculo`),
  KEY `fk_Currículo_Candidato1_idx` (`Candidato_idCandidato`),
  CONSTRAINT `fk_Currículo_Candidato1` FOREIGN KEY (`Candidato_idCandidato`) REFERENCES `candidato` (`idCandidato`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curriculo`
--

LOCK TABLES `curriculo` WRITE;
/*!40000 ALTER TABLE `curriculo` DISABLE KEYS */;
/*!40000 ALTER TABLE `curriculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `idEmpresas` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cnpj` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `Administrador_idUsuarios` int(11) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`idEmpresas`),
  UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_Empresas_Administrador1_idx` (`Administrador_idUsuarios`),
  CONSTRAINT `fk_Empresas_Administrador1` FOREIGN KEY (`Administrador_idUsuarios`) REFERENCES `administrador` (`idUsuarios`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'Hirenow',123456632,'hirenow@gmail.com','123234345asd',1,3);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interessados`
--

DROP TABLE IF EXISTS `interessados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interessados` (
  `idInteressados` int(11) NOT NULL AUTO_INCREMENT,
  `proposta` varchar(300) NOT NULL,
  `id_candidato` int(11) DEFAULT NULL,
  `id_vaga` int(11) DEFAULT NULL,
  `curriculo_candidato` int(11) DEFAULT NULL,
  PRIMARY KEY (`idInteressados`),
  KEY `vaga_01_idx` (`id_vaga`),
  KEY `candidato_01_idx` (`id_candidato`),
  KEY `currículo_interessados_idx` (`curriculo_candidato`),
  CONSTRAINT `candidato_01` FOREIGN KEY (`id_candidato`) REFERENCES `candidato` (`idCandidato`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `currículo_interessados` FOREIGN KEY (`curriculo_candidato`) REFERENCES `curriculo` (`idCurriculo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `vaga_01` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`idVagas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interessados`
--

LOCK TABLES `interessados` WRITE;
/*!40000 ALTER TABLE `interessados` DISABLE KEYS */;
/*!40000 ALTER TABLE `interessados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vagas`
--

DROP TABLE IF EXISTS `vagas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vagas` (
  `idVagas` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `requisitos` varchar(45) NOT NULL,
  `pagamento` decimal(5,2) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idVagas`),
  KEY `id_empresa_idx` (`id_empresa`),
  CONSTRAINT `id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`idEmpresas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vagas`
--

LOCK TABLES `vagas` WRITE;
/*!40000 ALTER TABLE `vagas` DISABLE KEYS */;
INSERT INTO `vagas` VALUES (1,'Analista de Sistemas','Descrição','Requisitos',700.00,1),(5,'Estágio Suporte Técnico','Suporte','Redes de Computadores',700.00,1),(7,'Administração','Adm','Administração',999.99,1);
/*!40000 ALTER TABLE `vagas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-27 14:19:17
