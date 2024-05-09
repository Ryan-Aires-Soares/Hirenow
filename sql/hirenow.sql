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
  `nome` varchar(45) CHARACTER SET utf8 NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`idUsuarios`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'Ryan Aires Soares','admin@gmail.com','123asd!*',1);
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
  `nome_cand` varchar(45) CHARACTER SET utf8 NOT NULL,
  `data_nasc` date NOT NULL,
  `email_cand` varchar(45) CHARACTER SET utf8 NOT NULL,
  `senha_cand` varchar(45) CHARACTER SET utf8 NOT NULL,
  `Administrador_idUsuarios` int(11) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`idCandidato`),
  KEY `fk_Candidato_Administrador1_idx` (`Administrador_idUsuarios`),
  CONSTRAINT `fk_adm` FOREIGN KEY (`Administrador_idUsuarios`) REFERENCES `administrador` (`idUsuarios`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidato`
--

LOCK TABLES `candidato` WRITE;
/*!40000 ALTER TABLE `candidato` DISABLE KEYS */;
INSERT INTO `candidato` VALUES (1,'Tiago','2001-03-02','tiagou@gmail.com','$@DWSEFAs',1,2),(6,'Homer Simpson','2001-03-02','homer@gmail.com','1kfah72nbds',1,2),(7,'Marcos Vinícius','2001-03-02','mv@gmail.com','fes#$Rwsda!@',1,2),(8,'ryan','2006-03-05','ryan88@gmail.com','123#$@#D',1,2),(9,'Gregóri','2001-03-02','gregoridesbravador@gmail.com','123!@#123',1,2),(11,'Marcos','2001-01-02','marcos@gmail.com','123456789',1,2),(12,'Ricardo','1999-02-01','ric@gmail.com','@#$SDFWEas1',1,2),(13,'Julius Caeser','1500-02-01','julius@gmail.com','@%#aED16#',1,2),(16,'Eric Ferreira','2001-01-02','eric@gmail.com','!%&afeW32CX',1,2),(17,'Guilherme','2001-03-02','gui01@gmail.com','@¨FTVCX12',1,2);
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
  `mensagem` varchar(300) CHARACTER SET utf8 NOT NULL,
  `data_msg` date NOT NULL,
  `id_candidato` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idChat`),
  KEY `candidato_idx` (`id_candidato`),
  KEY `empresa_idx` (`id_empresa`),
  CONSTRAINT `candidato` FOREIGN KEY (`id_candidato`) REFERENCES `candidato` (`idCandidato`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`idEmpresas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `escolaridade` varchar(45) CHARACTER SET utf8 NOT NULL,
  `sexo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linguas` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interpessoais` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(300) CHARACTER SET utf8 NOT NULL,
  `portifolio` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `Candidato_idCandidato` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCurriculo`),
  UNIQUE KEY `Candidato_idCandidato_UNIQUE` (`Candidato_idCandidato`),
  KEY `fk_Currículo_Candidato1_idx` (`Candidato_idCandidato`),
  CONSTRAINT `fk_Currículo_Candidato1` FOREIGN KEY (`Candidato_idCandidato`) REFERENCES `candidato` (`idCandidato`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curriculo`
--

LOCK TABLES `curriculo` WRITE;
/*!40000 ALTER TABLE `curriculo` DISABLE KEYS */;
INSERT INTO `curriculo` VALUES (5,'Ensino Superior','feminino','francês','disposição','Bom dia','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/oi.docx',7),(7,'Ensino Medio','masculino','inglês - espanhol','liderança - confiança - proatividade','sims','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/03.docx',6),(8,'Pós Graduação','masculino','inglês - espanhol - francês','confiança - comunicação - proatividade','jaskdlaskda','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/04.docx',8),(9,'Ensino Superior','masculino','inglês - espanhol','liderança - comunicação - trabalho em equipe','Cursando Enfermagem.','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/basico.docx',9),(10,'Ensino Superior','masculino','inglês - espanhol - francês','liderança - disposição - criatividade','Oi, bom dia','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/oi.docx',11),(11,'Ensino Fundamental','feminino','espanhol - francês','liderança','sim','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/ER3.docx',12),(12,'Ensino Superior','masculino','inglês - francês','liderança - comunicação - criatividade','Lider Romano.','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/ER2.docx',13),(13,'Ensino Superior','masculino','inglês - espanhol - francês','liderança - confiança - disposição - proatividade','asdas','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/Trabalho_final.docx',NULL),(17,'Mestrado','masculino','inglês','comunicação - criatividade','freeese','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/Gabinetes.pdf',NULL),(18,'Doutorado','masculino','inglês - francês','comunicação - criatividade - proatividade','Eric','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/Trabalho_final.docx',16),(19,'Ensino Fundamental','masculino','inglês - espanhol','comunicação - criatividade','awdsawds','C:\\xampp\\htdocs\\PCC - Rascunho2\\login_cadastro\\Cand/armazenamento/Slide_Aula.pdf',17);
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
  `nome` varchar(45) CHARACTER SET utf8 NOT NULL,
  `cnpj` int(11) NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Administrador_idUsuarios` int(11) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `area` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEmpresas`),
  UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_Empresas_Administrador1_idx` (`Administrador_idUsuarios`),
  CONSTRAINT `fk_adm1` FOREIGN KEY (`Administrador_idUsuarios`) REFERENCES `administrador` (`idUsuarios`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (11,'Blob',623745234,'blob@gmail.com','26#$FDasc12',1,3,NULL,NULL),(13,'Giggle',291923381,'giggle@gmail.com','#$ASDW##$%SDF',1,3,'Engenharia','asdasd'),(16,'flex',254415324,'flex@gmail.com','234@#DS17',1,3,NULL,NULL);
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
  `id_vaga` int(11) DEFAULT NULL,
  `curriculo_candidato` int(11) DEFAULT NULL,
  PRIMARY KEY (`idInteressados`),
  KEY `vaga_01_idx` (`id_vaga`),
  KEY `currículo_interessados_idx` (`curriculo_candidato`),
  CONSTRAINT `currículo_interessados` FOREIGN KEY (`curriculo_candidato`) REFERENCES `curriculo` (`idCurriculo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `vaga_01` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`idVagas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interessados`
--

LOCK TABLES `interessados` WRITE;
/*!40000 ALTER TABLE `interessados` DISABLE KEYS */;
INSERT INTO `interessados` VALUES (9,10,5),(10,14,5),(11,10,7),(12,13,7),(13,10,8),(14,13,8),(15,NULL,9),(19,NULL,8),(21,33,9),(22,28,9),(23,34,9),(27,10,10),(28,10,17),(29,13,18),(30,10,19),(31,34,19);
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
  `area` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(80) CHARACTER SET utf8 NOT NULL,
  `tipo_vaga` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(300) CHARACTER SET utf8 NOT NULL,
  `requisitos` varchar(45) CHARACTER SET utf8 NOT NULL,
  `requisitos2` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requisitos3` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requisitos4` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requisitos5` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagamento` decimal(8,2) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_adm` int(11) DEFAULT NULL,
  PRIMARY KEY (`idVagas`),
  KEY `id_empresa_idx` (`id_empresa`),
  KEY `fk_adm2_idx` (`id_adm`),
  CONSTRAINT `fk_adm2` FOREIGN KEY (`id_adm`) REFERENCES `administrador` (`idUsuarios`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`idEmpresas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vagas`
--

LOCK TABLES `vagas` WRITE;
/*!40000 ALTER TABLE `vagas` DISABLE KEYS */;
INSERT INTO `vagas` VALUES (10,'Administração','Administração','online',' Administração     ','Formado em Administração','Experiência na área','Raciocínio Lógico','Projetos Feitos','Certificações',3000.00,11,1),(13,'Administração','Administração','online','     Pacote Office     ','Superior em Administração','Experiência na área','Raciocínio Lógico','Projetos Feitos','Certificações',4000.99,13,1),(14,'Administração','Administração','online',' Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi vel cupiditate, excepturi eligendi aliquid amet molestias maxime culpa dolores voluptas adipisci dolorem fuga. Qui labore fugiat incidunt sequi dolorum sunt.Lorem, ipsum dolor sit amet consectetur adipisicing elit.','Superior em Administração','Experiência na área','Raciocínio Lógico','Projetos Feitos','Certificações',2000.00,13,1),(24,'Administração','asdasda','presencial',' asdasdasd ','asdasdasd','Experiência na área','Raciocínio Lógico','Projetos Feitos','Certificações',1000.00,11,1),(28,'Administração','Adm','presencial','wasdwe','as','asd','asdf','asdfg','asdfgh',1000.00,11,1),(33,'Tecnologia (TI)','TI','online','TI','TI','TI','TI','TI','TI',3000.00,11,1),(34,'Saúde','Enfermagem','presencial',' Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi vel cupiditate, excepturi eligendi aliquid amet molestias maxime culpa dolores voluptas adipisci dolorem fuga. Qui labore fugiat incidunt sequi dolorum sunt.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi vel cupiditate','Superior em Enfermagem','teste','enfermagem','sim','bom dia',1000.00,13,1),(35,'Administração','Administração','online',' Superior em Administração ','ADM','MDA','DAM','DMA','AMD',5000.00,16,1);
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

-- Dump completed on 2024-05-09 18:38:23
