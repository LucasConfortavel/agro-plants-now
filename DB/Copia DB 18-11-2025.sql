-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 192.168.22.9    Database: 143p2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `valor_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinho`
--

LOCK TABLES `carrinho` WRITE;
/*!40000 ALTER TABLE `carrinho` DISABLE KEYS */;
INSERT INTO `carrinho` VALUES (1,1,'2025-10-30 17:26:18',0.00),(2,2,'2025-11-03 15:21:06',200000.00),(3,3,'2025-11-03 15:41:28',0.00),(4,4,'2025-11-03 15:59:59',0.00),(5,20,'2025-11-03 16:28:19',0.00),(12,21,'2025-11-07 15:26:12',0.00),(13,22,'2025-11-07 17:18:54',0.00),(14,24,'2025-11-10 17:14:28',0.00),(15,32,'2025-11-11 17:23:24',0.00),(16,36,'2025-11-11 17:23:24',0.00),(17,37,'2025-11-11 17:31:10',43.43),(18,38,'2025-11-13 17:29:21',0.00),(19,44,'2025-11-17 15:24:32',74.00),(20,45,'2025-11-17 15:25:46',0.00),(21,46,'2025-11-18 17:00:17',0.00);
/*!40000 ALTER TABLE `carrinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrinho_itens`
--

DROP TABLE IF EXISTS `carrinho_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrinho_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL CHECK (`quantidade` > 0),
  PRIMARY KEY (`id`),
  KEY `id_carrinho` (`id_carrinho`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `carrinho_itens_ibfk_1` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinho` (`id`),
  CONSTRAINT `carrinho_itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinho_itens`
--

LOCK TABLES `carrinho_itens` WRITE;
/*!40000 ALTER TABLE `carrinho_itens` DISABLE KEYS */;
INSERT INTO `carrinho_itens` VALUES (108,2,4,4),(125,17,27,1),(137,19,4,37);
/*!40000 ALTER TABLE `carrinho_itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (7,'Análise de solo'),(6,'Controle de pragas e doenças'),(2,'Ferramentas'),(4,'Fertilizantes'),(1,'Grãos'),(3,'Insumos'),(5,'Irrigação');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` char(11) DEFAULT NULL,
  `CPF` char(11) DEFAULT NULL,
  `CNPJ` char(14) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `status` enum('ATIVADO','DESATIVADO') NOT NULL DEFAULT 'ATIVADO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `CPF` (`CPF`),
  UNIQUE KEY `CNPJ` (`CNPJ`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`CPF` is not null or `CNPJ` is not null)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'João Vitor da silva Oliveira','joao550vit@gmail.com','67991307007','',NULL,'0000-00-00',0,'DESATIVADO'),(2,'Roberto Gomez','gomezrob@gmail.com','67998485122',NULL,'258.147.369-84','0000-00-00',0,'ATIVADO'),(3,'Reinaldo Junior','reinaldojr@gmail.com','67994256324',NULL,'654.321.951-87','0000-00-00',0,'ATIVADO'),(4,'John Pork','sirjohnathanporkusthesecond@hotmail.com','67991562489',NULL,'10666263000198','2001-09-11',0,'ATIVADO'),(20,'José Stalino','ilovemustache@outlook.com','9483975398',NULL,'18481763000167','1932-02-23',NULL,'ATIVADO'),(21,'sabrina','sabrinateste@gmail.com','67995623211',NULL,'012.012.012-77','0000-00-00',NULL,'ATIVADO'),(22,'Vinicius O lindo','vinicius@hotmail.com','67981806326',NULL,'380.240.690-75','0000-00-00',NULL,'ATIVADO'),(24,'VINICIUS CRUZ LOPES','viniciusteste@hotmail.com','67981806326',NULL,'676.295.910-55','0000-00-00',NULL,'ATIVADO'),(32,'teste','testeit@gmail.com','67998542655',NULL,'321.321.321-87','0000-00-00',NULL,'ATIVADO'),(36,'testedwa','testeitawas@gmail.com','67998542655',NULL,'asd.asd.aas-55','0000-00-00',NULL,'ATIVADO'),(37,'agroplantsnowcli','agroplantsnowcli@gmail.com','6799532653',NULL,'000.000.011-11','1975-06-24',NULL,'ATIVADO'),(38,'Luã Carlos','santoslua1607@gmail.com','67995854266',NULL,'015.012.012-65','2007-06-16',NULL,'ATIVADO'),(44,'claudio ronaldo','claudioo@gmail.com','67995854266',NULL,'012.012.321-52','1995-12-12',NULL,'ATIVADO'),(45,'teste data ','testedata@gmail.com','78965412331','98745632164',NULL,'2000-11-08',NULL,'ATIVADO'),(46,'testeservi','claudi@gmail.com','67995235622',NULL,'013.321.023-88','1995-12-10',NULL,'ATIVADO');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comissao`
--

DROP TABLE IF EXISTS `comissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venda` int(11) NOT NULL,
  `percentual` decimal(5,2) NOT NULL CHECK (`percentual` between 0 and 100),
  `valor` decimal(10,2) NOT NULL CHECK (`valor` >= 0),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_venda` (`id_venda`),
  CONSTRAINT `comissao_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comissao`
--

LOCK TABLES `comissao` WRITE;
/*!40000 ALTER TABLE `comissao` DISABLE KEYS */;
/*!40000 ALTER TABLE `comissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cupom`
--

DROP TABLE IF EXISTS `cupom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cupom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` enum('FIXO','PERCENTUAL') NOT NULL DEFAULT 'FIXO',
  `valor` decimal(10,2) NOT NULL,
  `data_validade` date NOT NULL,
  `data_emissao` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`data_validade` >= `data_emissao`),
  CONSTRAINT `CONSTRAINT_2` CHECK (`tipo` = 'FIXO' and `valor` > 0 or `tipo` = 'PERCENTUAL' and `valor` between 0 and 100)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cupom`
--

LOCK TABLES `cupom` WRITE;
/*!40000 ALTER TABLE `cupom` DISABLE KEYS */;
INSERT INTO `cupom` VALUES (2,'N3IIZ4GX','teste','FIXO',15.00,'2025-11-05','2025-11-04'),(6,'','edwe','FIXO',1.00,'2025-11-18','2025-11-14'),(9,'XZ7AMO2P','reszwetrgxe','FIXO',4.00,'2025-11-18','2025-11-18'),(13,'0Y5CDGPI','3434','FIXO',100.00,'2026-12-15','2025-11-18'),(15,'XTYBKCWW','10','FIXO',30.00,'2026-10-10','2025-11-18');
/*!40000 ALTER TABLE `cupom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mensagem` text NOT NULL,
  `data_msg` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagens`
--

LOCK TABLES `mensagens` WRITE;
/*!40000 ALTER TABLE `mensagens` DISABLE KEYS */;
INSERT INTO `mensagens` VALUES (1,'Vinicius','vinicius_cruz_lopes@hotmail.com','eae deixa eu folga hoje',NULL);
/*!40000 ALTER TABLE `mensagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacoes`
--

DROP TABLE IF EXISTS `notificacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `assunto` text NOT NULL,
  `horario_criacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacoes`
--

LOCK TABLES `notificacoes` WRITE;
/*!40000 ALTER TABLE `notificacoes` DISABLE KEYS */;
INSERT INTO `notificacoes` VALUES (2,'Estoque Baixo - Soja','O produto \'Soja\' está com estoque baixo. Quantidade atual: 4 unidades.','2025-11-06 17:46:04'),(4,'Estoque Baixo - Soja','O produto \'Soja\' está com estoque baixo. Quantidade atual: 3 unidades.','2025-11-07 16:23:02'),(5,'Estoque Baixo - Soja','O produto \'Soja\' está com estoque baixo. Quantidade atual: 2 unidades.','2025-11-07 16:25:39'),(9,'Novo Contato - Paulinho2','Novo email de contato:\n\nDe: Paulinho2 (bbbbbb@gmail.com)\n\nMensagem:\nOutro test','2025-11-14 17:03:11'),(11,'Novo Contato - Lucas','Novo email de contato:\n\nDe: Lucas (lucas@lucas.lucas)\n\nMensagem:\nLucas...','2025-11-18 16:08:45'),(12,'Novo Contato - qduywgduyQXWDUYQVB','Novo email de contato:\n\nDe: qduywgduyQXWDUYQVB (WEJIDNWI@gmail.com)\n\nMensagem:\nqewfwAEFW','2025-11-18 16:14:43');
/*!40000 ALTER TABLE `notificacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_itens`
--

DROP TABLE IF EXISTS `pedido_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `total_item` decimal(10,2) NOT NULL CHECK (`total_item` > 0),
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedido_itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_itens`
--

LOCK TABLES `pedido_itens` WRITE;
/*!40000 ALTER TABLE `pedido_itens` DISABLE KEYS */;
INSERT INTO `pedido_itens` VALUES (1,1,1,1,1.00,1.00),(2,3,1,1,1.00,1.00),(3,4,3,7,2222222.00,15555554.00),(4,6,4,4,50000.00,200000.00),(5,7,4,47000,50000.00,99999999.99),(6,8,4,47000,50000.00,99999999.99),(7,29,4,11,50000.00,550000.00),(8,30,3,8,2222222.00,17777776.00),(9,31,4,1,50000.00,50000.00),(10,32,4,21,50000.00,1050000.00),(11,33,4,12,50000.00,600000.00),(12,34,4,170,50000.00,8500000.00),(13,37,4,210,50000.00,10500000.00),(14,40,4,4,50000.00,200000.00),(15,44,4,12,50000.00,600000.00),(16,45,4,2147483647,50000.00,99999999.99),(17,50,4,134,50000.00,6700000.00),(18,54,4,5,50000.00,250000.00),(19,58,4,5,50000.00,250000.00),(20,61,4,24,50000.00,1200000.00),(21,63,4,5,50000.00,250000.00),(22,65,4,60,50000.00,3000000.00),(23,66,15,3,15.00,45.00),(24,69,15,1,15.00,15.00),(25,71,4,51,50000.00,2550000.00),(26,74,4,26,50000.00,1300000.00),(27,76,4,9,50000.00,450000.00),(28,78,4,1,50000.00,50000.00),(29,82,4,5,50000.00,250000.00),(30,84,4,6,50000.00,300000.00),(31,90,4,4,50000.00,200000.00),(32,92,4,5,50000.00,250000.00),(33,93,4,11,50000.00,550000.00),(34,94,15,1,15.00,15.00),(35,95,15,1,15.00,15.00),(36,98,4,5,50000.00,250000.00),(37,105,4,1,50000.00,50000.00),(38,108,15,1,15.00,15.00),(39,110,22,10,1000.00,10000.00),(40,111,20,5,1500.00,7500.00),(41,112,22,10,1000.00,10000.00);
/*!40000 ALTER TABLE `pedido_itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_pedido` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cupom` int(11) DEFAULT NULL,
  `status` enum('FINALIZADO','PAGO','ENVIADO','PENDENTE') DEFAULT NULL,
  `total` decimal(10,2) NOT NULL CHECK (`total` > 0),
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_cupom` (`id_cupom`),
  KEY `fk_pedidos_vendedor` (`id_vendedor`),
  CONSTRAINT `fk_pedidos_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `usuario` (`id`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_cupom`) REFERENCES `cupom` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'2025-10-31 19:43:46',1,2,NULL,'FINALIZADO',1.00),(2,'2025-10-31 17:35:35',1,2,NULL,'PENDENTE',1.00),(3,'2025-10-31 21:35:51',1,2,NULL,'FINALIZADO',1.00),(4,'2025-11-03 19:33:49',2,2,NULL,'FINALIZADO',15555554.00),(5,'2025-11-03 17:42:40',1,2,NULL,'FINALIZADO',53333328.00),(6,'2025-11-04 20:28:58',1,2,NULL,'FINALIZADO',200000.00),(7,'2025-11-04 20:56:18',1,2,NULL,'FINALIZADO',99999999.99),(8,'2025-11-04 20:56:30',1,2,NULL,'FINALIZADO',99999999.99),(9,'2025-11-04 17:12:43',1,2,NULL,'PENDENTE',99999999.99),(10,'2025-11-04 17:12:46',1,2,NULL,'PENDENTE',99999999.99),(11,'2025-11-04 17:12:48',1,2,NULL,'PENDENTE',99999999.99),(12,'2025-11-04 17:12:50',1,2,NULL,'PENDENTE',99999999.99),(13,'2025-11-04 17:12:52',1,2,NULL,'PENDENTE',99999999.99),(14,'2025-11-04 17:13:01',1,2,NULL,'PENDENTE',600000.00),(15,'2025-11-04 17:13:05',1,2,NULL,'PENDENTE',600000.00),(16,'2025-11-04 17:13:07',1,2,NULL,'PENDENTE',600000.00),(17,'2025-11-04 17:13:09',1,2,NULL,'PENDENTE',600000.00),(18,'2025-11-04 17:13:11',1,2,NULL,'PENDENTE',600000.00),(19,'2025-11-04 17:13:14',1,2,NULL,'PENDENTE',600000.00),(20,'2025-11-04 17:13:16',1,2,NULL,'PENDENTE',600000.00),(21,'2025-11-04 17:13:20',1,2,NULL,'PENDENTE',600000.00),(22,'2025-11-04 17:13:22',1,2,NULL,'PENDENTE',600000.00),(23,'2025-11-04 17:13:25',1,2,NULL,'PENDENTE',600000.00),(24,'2025-11-04 17:13:37',1,2,NULL,'PENDENTE',600000.00),(25,'2025-11-04 17:13:38',1,2,NULL,'PENDENTE',600000.00),(26,'2025-11-04 17:13:38',1,2,NULL,'PENDENTE',600000.00),(27,'2025-11-04 17:14:43',1,2,NULL,'PENDENTE',600000.00),(28,'2025-11-04 17:14:45',1,2,NULL,'PENDENTE',600000.00),(29,'2025-11-04 21:45:09',2,2,NULL,'FINALIZADO',550000.00),(30,'2025-11-04 21:46:16',3,2,NULL,'FINALIZADO',17777776.00),(31,'2025-11-06 19:15:37',2,2,NULL,'FINALIZADO',50000.00),(32,'2025-11-06 19:16:11',20,2,NULL,'FINALIZADO',1050000.00),(33,'2025-11-06 19:19:37',1,2,NULL,'FINALIZADO',600000.00),(34,'2025-11-06 19:22:43',4,2,NULL,'FINALIZADO',8500000.00),(35,'2025-11-06 15:23:32',4,2,NULL,'PENDENTE',10500000.00),(36,'2025-11-06 15:23:37',4,2,NULL,'PENDENTE',10500000.00),(37,'2025-11-06 19:23:48',4,2,NULL,'FINALIZADO',10500000.00),(38,'2025-11-06 15:24:53',20,2,NULL,'PENDENTE',100000.00),(39,'2025-11-06 15:25:00',20,2,NULL,'PENDENTE',200000.00),(40,'2025-11-06 19:25:06',20,2,NULL,'FINALIZADO',200000.00),(41,'2025-11-06 15:40:49',4,2,NULL,'PENDENTE',500000.00),(42,'2025-11-06 15:41:01',4,2,NULL,'PENDENTE',600000.00),(43,'2025-11-06 15:41:03',4,2,NULL,'PENDENTE',600000.00),(44,'2025-11-06 19:41:18',4,2,NULL,'FINALIZADO',600000.00),(45,'2025-11-06 19:51:12',4,2,NULL,'FINALIZADO',99999999.99),(46,'2025-11-06 15:53:24',20,2,NULL,'PENDENTE',6700000.00),(47,'2025-11-06 15:53:37',20,2,NULL,'PENDENTE',6700000.00),(48,'2025-11-06 15:53:37',20,2,NULL,'PENDENTE',6700000.00),(49,'2025-11-06 15:56:36',3,2,NULL,'FINALIZADO',50000.00),(50,'2025-11-06 19:57:00',20,2,NULL,'FINALIZADO',6700000.00),(51,'2025-11-06 15:58:49',20,2,NULL,'PENDENTE',250000.00),(52,'2025-11-06 15:58:52',20,2,NULL,'PENDENTE',250000.00),(53,'2025-11-06 15:58:54',20,2,NULL,'PENDENTE',250000.00),(54,'2025-11-06 19:58:59',20,2,NULL,'FINALIZADO',250000.00),(55,'2025-11-06 15:59:33',20,2,NULL,'PENDENTE',250000.00),(56,'2025-11-06 15:59:51',20,2,NULL,'PENDENTE',250000.00),(57,'2025-11-06 15:59:53',20,2,NULL,'PENDENTE',250000.00),(58,'2025-11-06 19:59:57',20,2,NULL,'FINALIZADO',250000.00),(59,'2025-11-06 16:16:48',20,2,NULL,'PENDENTE',1200000.00),(60,'2025-11-06 16:16:51',20,2,NULL,'PENDENTE',1200000.00),(61,'2025-11-06 20:16:57',20,2,NULL,'FINALIZADO',1200000.00),(62,'2025-11-06 16:28:13',1,2,NULL,'PENDENTE',250000.00),(63,'2025-11-06 20:28:28',1,2,NULL,'FINALIZADO',250000.00),(64,'2025-11-06 17:42:41',1,2,NULL,'PENDENTE',3000000.00),(65,'2025-11-06 21:42:48',1,2,NULL,'FINALIZADO',3000000.00),(66,'2025-11-06 21:45:25',1,2,NULL,'FINALIZADO',45.00),(67,'2025-11-06 17:45:59',1,2,NULL,'PENDENTE',15.00),(68,'2025-11-06 17:46:01',1,2,NULL,'PENDENTE',15.00),(69,'2025-11-06 21:46:05',1,2,NULL,'FINALIZADO',15.00),(70,'2025-11-07 15:22:09',1,2,NULL,'FINALIZADO',300000.00),(71,'2025-11-07 19:27:22',21,2,NULL,'FINALIZADO',2550000.00),(72,'2025-11-07 15:28:18',21,2,NULL,'PENDENTE',1300000.00),(73,'2025-11-07 15:28:23',21,2,NULL,'PENDENTE',1300000.00),(74,'2025-11-07 19:28:38',21,2,NULL,'FINALIZADO',1300000.00),(75,'2025-11-07 15:29:38',21,2,NULL,'PENDENTE',450000.00),(76,'2025-11-07 19:29:53',21,2,NULL,'FINALIZADO',450000.00),(77,'2025-11-07 15:32:05',21,2,NULL,'PENDENTE',50000.00),(78,'2025-11-07 19:32:18',21,2,NULL,'FINALIZADO',50000.00),(79,'2025-11-07 15:33:51',4,2,NULL,'FINALIZADO',250000.00),(80,'2025-11-07 15:34:35',21,2,NULL,'PENDENTE',250000.00),(81,'2025-11-07 15:38:54',1,2,NULL,'FINALIZADO',200000.00),(82,'2025-11-07 19:39:14',21,2,NULL,'FINALIZADO',250000.00),(83,'2025-11-07 15:39:37',21,2,NULL,'PENDENTE',300000.00),(84,'2025-11-07 19:39:44',21,2,NULL,'FINALIZADO',300000.00),(85,'2025-11-07 15:41:11',4,2,NULL,'FINALIZADO',4500.00),(86,'2025-11-07 16:06:15',1,2,NULL,'FINALIZADO',200000.00),(87,'2025-11-07 16:09:12',2,2,NULL,'FINALIZADO',200000.00),(88,'2025-11-07 16:09:31',21,2,NULL,'PENDENTE',200000.00),(89,'2025-11-07 16:16:50',1,2,NULL,'FINALIZADO',50000.00),(90,'2025-11-07 20:16:53',21,2,NULL,'FINALIZADO',200000.00),(91,'2025-11-07 16:17:44',21,2,NULL,'PENDENTE',250000.00),(92,'2025-11-07 20:19:05',21,2,NULL,'FINALIZADO',250000.00),(93,'2025-11-07 20:21:44',1,2,NULL,'FINALIZADO',550000.00),(94,'2025-11-07 20:23:02',1,2,NULL,'FINALIZADO',15.00),(95,'2025-11-07 20:25:39',21,2,NULL,'FINALIZADO',15.00),(96,'2025-11-07 16:26:26',21,2,NULL,'PENDENTE',250000.00),(97,'2025-11-07 16:26:36',21,2,NULL,'PENDENTE',250000.00),(98,'2025-11-07 20:26:43',21,2,NULL,'FINALIZADO',250000.00),(99,'2025-11-07 17:18:15',1,2,NULL,'PENDENTE',50000.00),(100,'2025-11-07 17:18:18',1,2,NULL,'PENDENTE',50000.00),(101,'2025-11-07 17:18:25',1,2,NULL,'PENDENTE',50000.00),(102,'2025-11-07 17:18:25',1,2,NULL,'PENDENTE',50000.00),(103,'2025-11-07 17:18:39',1,2,NULL,'PENDENTE',50000.00),(104,'2025-11-07 17:18:45',1,2,NULL,'PENDENTE',50000.00),(105,'2025-11-07 21:18:50',1,2,NULL,'FINALIZADO',50000.00),(106,'2025-11-10 15:32:16',4,2,NULL,'FINALIZADO',15.00),(107,'2025-11-10 17:01:02',20,2,NULL,'FINALIZADO',7500.00),(108,'2025-11-10 21:22:51',1,103,NULL,'FINALIZADO',15.00),(109,'2025-11-11 15:22:02',3,2,NULL,'FINALIZADO',3000.00),(110,'2025-11-11 19:42:25',24,2,NULL,'FINALIZADO',10000.00),(111,'2025-11-11 19:42:29',20,2,NULL,'FINALIZADO',7500.00),(112,'2025-11-11 19:53:10',1,2,NULL,'FINALIZADO',10000.00),(113,'2025-11-11 15:53:30',1,2,NULL,'PENDENTE',10000.00),(114,'2025-11-11 16:23:08',4,2,NULL,'FINALIZADO',15.00),(115,'2025-11-13 15:46:49',21,2,NULL,'FINALIZADO',4500.00),(116,'2025-11-14 15:47:52',1,2,NULL,'FINALIZADO',4500.00),(117,'2025-11-14 15:48:42',4,2,NULL,'FINALIZADO',4515.00),(118,'2025-11-14 17:04:52',21,2,NULL,'FINALIZADO',4500.00),(119,'2025-11-14 17:31:39',21,2,NULL,'FINALIZADO',99999999.99),(120,'2025-11-14 17:34:29',21,2,NULL,'FINALIZADO',99999999.99),(121,'2025-11-17 15:44:00',1,2,NULL,'FINALIZADO',48.00),(122,'2025-11-17 15:45:10',4,2,NULL,'FINALIZADO',100.00),(123,'2025-11-18 15:51:09',24,2,NULL,'FINALIZADO',120.00),(124,'2025-11-18 15:52:33',3,2,NULL,'FINALIZADO',3120.00),(125,'2025-11-18 16:07:06',1,2,NULL,'FINALIZADO',2400.00),(126,'2025-11-18 17:00:05',4,2,NULL,'FINALIZADO',520.00),(127,'2025-11-18 17:09:01',1,2,NULL,'FINALIZADO',520.00),(128,'2025-11-18 17:12:13',1,2,NULL,'FINALIZADO',100.00),(129,'2025-11-18 17:14:53',1,2,NULL,'FINALIZADO',520.00),(130,'2025-11-18 17:16:44',4,2,NULL,'FINALIZADO',100.00);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL CHECK (`preco` > 0),
  `descricao` text DEFAULT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  `reservado` int(11) NOT NULL DEFAULT 0,
  `id_cat` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `status` enum('ATIVADO','DESATIVADO') NOT NULL DEFAULT 'ATIVADO',
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`quantidade` >= `reservado`),
  CONSTRAINT `CONSTRAINT_2` CHECK (`reservado` >= 0)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'produto teste.',1.00,'grãos.',23,0,1,'prod_690503184550c.jfif','DESATIVADO'),(2,'Enilda Caceres',0.30,'thiago',38,0,1,'prod_690517cf16c91.png','DESATIVADO'),(3,'Soja',2222222.00,'soja',2222207,0,1,'prod_6908f3e1eaab5.png','DESATIVADO'),(4,'Trigo',100.00,'Grãos',169,0,1,'prod_690900d0efc57.png','ATIVADO'),(5,'222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222',2222222.00,'22',222,0,1,'prod_690a503368cf9.jpg','DESATIVADO'),(6,'wagaersgfsegrasdvawsfdQwDFWfwdwuKCFGWYFGWYGDWUYGFWYGFGI32Y7183Y4E8712YE8712G3R782TR782TDU7G273GD7Q2G3RYGQ273TGR72GRQ273GRTQ723TGR73TGR7Q2TGR273TRGQUWG',100.00,'HFIWUHERFUWAGHEIWGUEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEYRY2874RYF3Q4H87RITDQ287QEGSUWJGHDUYWGFUWYJAEGHDQIUWHEDIUQWJGDGQUY3WEGHFBUYWEGFUQEGRQYWGRQYUWGJQWEBFJAHBFJDFGSYFGWUYEJRFGU3WYJEGRHI2QUWK3JEHDBUYQWJFGDVCUEJADGHBQWIUY3RGQ2GRQWUYGRYWUGRWYJGDWEUYGF',16,0,1,'prod_690a50dda3b11.png','DESATIVADO'),(7,'⠁ ⠂ ⠃ ⠄ ⠅ ⠆ ⠇ ⠈ ⠉ ⠊ ⠋ ⠌ ⠍ ⠎ ⠏ ⠐ ⠑ ⠒ ⠓ ⠔ ⠕ ⠖ ⠗ ⠘ ⠙ ⠚ ⠛ ⠜ ⠝ ⠞ ⠟ ⠠ ⠡ ⠢ ⠣ ⠤ ⠥ ⠦ ⠧ ⠨ ⠩ ⠪ ⠫ ⠬ ⠭ ⠮ ⠯ ⠰ ⠱ ⠲ ⠳ ⠴ ⠵ ⠶ ⠷ ⠸ ⠹ ⠺ ⠻ ⠼ ⠽ ⠾ ⠿ ⡀ ⡁ ⡂ ⡃ ⡄ ⡅ ⡆ ⡇ ⡈ ⡉ ⡊ ⡋ ',90099.94,'⠁ ⠂ ⠃ ⠄ ⠅ ⠆ ⠇ ⠈ ⠉ ⠊ ⠋ ⠌ ⠍ ⠎ ⠏ ⠐ ⠑ ⠒ ⠓ ⠔ ⠕ ⠖ ⠗ ⠘ ⠙ ⠚ ⠛ ⠜ ⠝ ⠞ ⠟ ⠠ ⠡ ⠢ ⠣ ⠤ ⠥ ⠦ ⠧ ⠨ ⠩ ⠪ ⠫ ⠬ ⠭ ⠮ ⠯ ⠰ ⠱ ⠲ ⠳ ⠴ ⠵ ⠶ ⠷ ⠸ ⠹ ⠺ ⠻ ⠼ ⠽ ⠾ ⠿ ⡀ ⡁ ⡂ ⡃ ⡄ ⡅ ⡆ ⡇ ⡈ ⡉ ⡊ ⡋ ⡌ ⡍ ⡎ ⡏ ⡐ ⡑ ⡒ ⡓ ⡔ ⡕ ⡖ ⡗ ⡘ ⡙ ⡚ ⡛ ⡜ ⡝ ⡞ ⡟ ⡠ ⡡ ⡢ ⡣ ⡤ ⡥ ⡦ ⡧ ⡨ ⡩ ⡪ ⡫ ⡬ ⡭ ⡮ ⡯ ⡰ ⡱ ⡲ ⡳ ⡴ ⡵ ⡶ ⡷ ⡸ ⡹ ⡺ ⡻ ⡼ ⡽ ⡾ ⡿ ⢀ ',744,0,1,'prod_690a518b9c13f.png','DESATIVADO'),(8,'????',40.04,'????',56,0,1,'prod_690a520ec6f12.png','DESATIVADO'),(9,'???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ',50.56,'???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ???? ',647,0,1,'prod_690a529add02f.png','DESATIVADO'),(10,'﷽',90.09,'﷽',999,0,1,'prod_690a52f8c78cf.png','DESATIVADO'),(11,'teste de servico',10000.00,'teste',5,0,7,'prod_690a5cda2c479.png','DESATIVADO'),(12,'pá',120.00,'pá',85,0,2,'prod_690ce8cec1577.jpg','DESATIVADO'),(13,'praga ruim',22222.22,'teste',100000000,0,6,'prod_690ce918dc4e3.jpg','DESATIVADO'),(14,'Maria Tênis',50000.00,'teste',4324,0,6,'prod_690cea14b0eba.jpg','DESATIVADO'),(15,'Soja',100.00,'É soja',210,0,1,'prod_690d0822d13fd.png','ATIVADO'),(16,'Soja',1500.00,'É soja',8,0,1,'prod_690d08230854a.png','DESATIVADO'),(17,'teste analise',300.00,'tejsite',123,0,7,'prod_690e52fe3ffa8.png','DESATIVADO'),(18,'irrigador',2500000.00,'Isso irriga',20,0,5,'prod_690e532ddf31a.png','DESATIVADO'),(19,'irrigador',250.00,'Ele irriga',30,0,5,'prod_690e539df3cd0.png','DESATIVADO'),(20,'semente de morango',111111.00,'sementes de morango',6,0,1,'prod_690e53b213b94.jfif','ATIVADO'),(21,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',1.22,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',22,0,5,'prod_690e56304699a.jpg','DESATIVADO'),(22,'TESTE VINI',1000.00,'TESTE ADM',0,0,7,'prod_6912472f1bce9.png','DESATIVADO'),(23,'teste',1111.11,'teste',19,0,6,'prod_6913875257ab2.jpg','DESATIVADO'),(24,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',2222222.00,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',11,0,7,'prod_69139724b810b.jpg','DESATIVADO'),(25,'pgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg',43.43,'terrraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',8,0,7,'prod_691398b4cf158.gif','DESATIVADO'),(26,'testeservi',22222.22,'teste',231,0,7,'prod_69139afdadb2a.jpg','DESATIVADO'),(27,'pgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg',43.43,'tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt',8,0,2,'prod_69139dae13b65.gif','DESATIVADO'),(28,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',2222222.00,'ad',22222,0,7,'prod_6914e8cf7ffd3.jpg','DESATIVADO'),(29,'MEOWL',1.00,'meo',1,0,7,'prod_6916249455ef7.webp','DESATIVADO'),(30,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',22222.22,'teste',222222222,0,6,'prod_69163142ceca9.jpg','DESATIVADO'),(31,'testee',100.00,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',14,0,4,'prod_69163fae64348.jpg','DESATIVADO'),(32,'teste',100.00,'test',16,0,6,'prod_691772ea81c6d.jpg','DESATIVADO'),(33,'semente de morango',150000.00,'morango',1,0,1,'prod_69177440a44dc.webp','DESATIVADO'),(34,'semente de morango',99999999.99,'semente de morango',1,0,1,'prod_691774dff3b62.jfif','DESATIVADO'),(35,'semente de morango',1500.00,'def',1,0,1,'prod_6917750d498f6.jfif','DESATIVADO'),(36,'semente de morango',150000.00,'ff',1,0,1,'prod_691775343f673.webp','DESATIVADO'),(37,'semente de morango',1500.00,'dfg',1,0,1,'prod_69177571d30f8.jfif','DESATIVADO'),(38,'teste11',22222.22,'1',2147483647,0,6,'prod_691b6c9b7df2b.jpg','DESATIVADO'),(39,'testeservi',22222.22,'222',2147483647,0,4,'prod_691b70b927246.jpg','DESATIVADO'),(40,'burguer',1110101.11,'nham nham',234,0,1,'prod_691b70e6cb5a6.png','DESATIVADO'),(41,'Arroz',777.00,'Muitos sacos de arrozes',500,0,1,'prod_691b7579532eb.png','ATIVADO'),(42,'thiago',90099.94,'t',10,0,7,'prod_691b8755a3734.png','ATIVADO');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL CHECK (`preco` > 0),
  `descricao` text DEFAULT NULL,
  `id_cat` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `status` enum('ATIVADO','DESATIVADO') NOT NULL DEFAULT 'ATIVADO',
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`),
  CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,'MEOWL',1.00,'é o meowl',7,'serv_69162461b2b4e.webp','DESATIVADO'),(2,'MEOWL',150000.00,'gvdxdg',7,'serv_691624a8f14ef.webp','DESATIVADO'),(3,'Maria',5000000.00,'uuhiuhiuhiuh',7,'serv_691643b2816ef.jpg','DESATIVADO'),(4,'teste',10000.00,'Controle de pragas',6,'serv_691772be38918.png','DESATIVADO'),(5,'teste',10000.00,'aaaaaaaaaaaaaaaaaaaa',4,'serv_6917730bb8aee.jpg','DESATIVADO'),(6,'Maria Tênis',5000000.00,'nfkydmj',7,'serv_691cbeaa4b5e7.png','DESATIVADO');
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `tipo` enum('admin','vendedor') NOT NULL,
  `telefone` char(11) DEFAULT NULL,
  `CPF` char(11) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `cep` char(8) NOT NULL,
  `status` enum('ATIVADO','DESATIVADO') NOT NULL DEFAULT 'ATIVADO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `CPF` (`CPF`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'Maria','maria@agroplants.com','$2y$10$fx.JsedKptduUzsdMz.0XOyPyIc/C8BZuhBUreIfAlXkbcqiSOISS','vendedor','11988887777','','1995-06-14','user_69162989f41bf.jpg','10101010','ATIVADO'),(4,'Paulo Silva','paulo.silva@agrotech.com','$2y$10$N.n0q.q5j5Gu8h27vAI/CO2Hg5SIqf0JntIeK3O.FQE6iSq9gxLZS','admin','11987654321','123.456.789','1988-04-12',NULL,'12312312','ATIVADO'),(39,'Adm','testeadm@gmail.com','$2y$10$4efmc3yBPmbYZrQu78b4auL.x8c6Almy0YN3FmcSSDLKHQ4IxVhL2','admin','40028922','000.000.001','2000-09-11','','19209200','ATIVADO'),(103,'VINICIUS CRUZ LOPES','viniv@hotmail.com','$2y$10$OTQSoXYjENZjeApo8S1TLel4VeYVuS09H1GM.eTLvfQLhlKiTPfze','vendedor','67981806326','676.295.910','1999-01-01','','79095-16','DESATIVADO'),(104,'Sabrina Luana','Sabrina@gmail.com','$2y$10$kobQ.L2skslrS0u8AmwqMOAj195izhqWBpQzrsCcMeStJ8PG9M2Fe','vendedor','47583611846','856392758','2000-08-23','','84937447','ATIVADO'),(105,'claudio ronaldo','claudio@gmail.com','$2y$10$IEaTrzItJTvUaruPi/NqU.PH5P1WNeYxV2T4Z93l27A.lGq.GWhbm','vendedor','67998512355','321.651.245','1995-12-12','','32032001','DESATIVADO'),(106,'Yuri','yurimaedanick019@gmail.com','$2y$10$o2CT/3wKanWAYBLXgvJF.eAOYgk9Cji6uODSpFK53HzjarKJqXFei','admin','11111111111','11111111111','2000-01-01',NULL,'11111111','ATIVADO'),(107,'sonic','teste12@gmail.com','$2y$10$KXMVUfzkkM3jjq4s1snhHeO4XXc.SXUkC5goB64SJIAIJiM/AN21i','vendedor','67991307007','213214324','2342-02-02','','79065-20','DESATIVADO');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venda`
--

DROP TABLE IF EXISTS `venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_venda` datetime NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL CHECK (`total` > 0),
  `tipo` enum('produto','servico') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_pedido` (`id_pedido`),
  KEY `id_vendedor` (`id_vendedor`),
  CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venda`
--

LOCK TABLES `venda` WRITE;
/*!40000 ALTER TABLE `venda` DISABLE KEYS */;
INSERT INTO `venda` VALUES (10,'2025-11-07 19:22:45',70,2,1,300000.00,'produto'),(13,'2025-11-07 19:39:03',81,2,1,200000.00,'produto'),(14,'2025-11-07 19:45:30',85,2,4,4500.00,'produto'),(16,'2025-11-07 20:23:05',94,2,1,15.00,'produto'),(17,'2025-11-07 20:25:03',87,2,2,200000.00,'produto'),(18,'2025-11-07 20:25:44',95,2,21,15.00,'produto'),(19,'2025-11-07 20:26:48',98,2,21,250000.00,'produto'),(20,'2025-11-10 19:32:31',106,2,4,15.00,'produto'),(21,'2025-11-10 20:59:50',105,2,1,50000.00,'produto'),(24,'2025-11-14 19:48:01',116,2,1,4500.00,'produto'),(25,'2025-11-14 19:49:00',117,2,4,4515.00,'produto'),(26,'2025-11-14 21:04:58',118,2,21,4500.00,'produto'),(27,'2025-11-14 21:31:46',119,2,21,99999999.99,'produto'),(28,'2025-11-14 21:34:36',120,2,21,99999999.99,'produto'),(29,'2025-11-18 19:51:20',123,2,24,120.00,'produto'),(30,'2025-11-18 19:52:42',124,2,3,3120.00,'produto'),(31,'2025-11-18 19:55:38',121,104,1,48.00,'produto'),(32,'2025-11-18 19:56:52',122,2,4,220.00,'produto'),(33,'2025-11-18 20:07:16',125,2,1,2400.00,'produto'),(34,'2025-11-18 21:09:14',127,2,1,520.00,'produto'),(35,'2025-11-18 21:09:46',126,2,4,520.00,'produto'),(36,'2025-11-18 21:12:26',128,2,1,100.00,'produto'),(37,'2025-11-18 21:15:09',129,2,1,520.00,'produto'),(38,'2025-11-18 21:16:55',130,2,4,100.00,'produto');
/*!40000 ALTER TABLE `venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database '143p2'
--

--
-- Dumping routines for database '143p2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-18 16:39:04
