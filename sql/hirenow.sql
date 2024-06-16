-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2024 às 13:53
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hirenow`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos_curriculo`
--

CREATE TABLE `arquivos_curriculo` (
  `id_curriculo` int(11) NOT NULL,
  `arquivos_curriculo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `arquivos_curriculo`
--

INSERT INTO `arquivos_curriculo` (`id_curriculo`, `arquivos_curriculo`) VALUES
(2, 'C:\\xampp\\htdocs\\Hirenow\\Sistema\\Cand/armazenamento/Xeap2z/Portfolio.pdf'),
(3, 'C:\\xampp\\htdocs\\Hirenow\\Sistema\\Cand/armazenamento/FWTgxk/Portfolio.pdf'),
(4, 'C:\\xampp\\htdocs\\Hirenow\\Sistema\\Cand/armazenamento/au10C5/Portfolio.pdf'),
(7, 'C:\\xampp\\htdocs\\Hirenow\\Sistema\\Cand/armazenamento/phNZDd/Portfolio.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidatos`
--

CREATE TABLE `candidatos` (
  `id_usuario_candidato` int(11) NOT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `candidatos`
--

INSERT INTO `candidatos` (`id_usuario_candidato`, `data_nasc`) VALUES
(5, '2002-02-02'),
(8, '2004-08-10'),
(15, '2001-03-02'),
(22, '2000-04-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curriculo`
--

CREATE TABLE `curriculo` (
  `idCurriculo` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `escolaridade` varchar(45) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `linguas_estrangeiras` varchar(45) DEFAULT NULL,
  `habilidades_interpessoais` longtext DEFAULT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curriculo`
--

INSERT INTO `curriculo` (`idCurriculo`, `id_candidato`, `escolaridade`, `sexo`, `linguas_estrangeiras`, `habilidades_interpessoais`, `descricao`) VALUES
(2, 5, 'Ensino Superior', 'masculino', 'inglês', 'liderança - confiança - disposição', 'oi, bom dia'),
(3, 8, 'Ensino Superior', 'masculino', 'inglês - espanhol', 'confiança - comunicação', 'Bom dia'),
(4, 15, 'Pós Graduação', 'masculino', 'inglês - espanhol', 'liderança', 'Matheus'),
(7, 22, 'Ensino Superior', 'masculino', 'francês', 'comunicação - criatividade', 'Ryan :)');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_usuarios_empresa` int(11) NOT NULL,
  `cnpj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id_usuarios_empresa`, `cnpj`) VALUES
(14, 151243643),
(16, 242321756),
(23, 252345343),
(18, 1512324234);

-- --------------------------------------------------------

--
-- Estrutura da tabela `interessados`
--

CREATE TABLE `interessados` (
  `idInteressados` int(11) NOT NULL,
  `id_vaga` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `curriculo_candidato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `interessados`
--

INSERT INTO `interessados` (`idInteressados`, `id_vaga`, `id_candidato`, `curriculo_candidato`) VALUES
(19, 12, 15, 4),
(26, 12, 5, 2),
(27, 27, 5, 2),
(28, 25, 5, 2),
(34, 33, 22, 7),
(35, 33, 15, 4),
(39, 27, 22, 7),
(41, 12, 22, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `idchat` int(11) NOT NULL,
  `mensagem` varchar(300) NOT NULL,
  `data_msg` varchar(60) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`idchat`, `mensagem`, `data_msg`, `destinatario`, `destino`) VALUES
(1, '<b>MSG:</b> bom dia.; <br><br>', '06/06/2024 - 08h:12m\0', 16, 22),
(2, '<b>MSG:</b> bom dia empresa.; <br><br><b>MSG:</b> asdsadasd; <br><br>', '06/06/2024 - 08h:50m\0', 22, 16),
(4, '<b>MSG:</b> bom dia Ryan.; <br><br><b>MSG:</b> g morning tho; <br><br>', '06/06/2024 - 08h:52m\0', 14, 22),
(5, '<b>MSG:</b> opa; <br><br>', '06/06/2024 - 08h:51m\0', 22, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_empresa`
--

CREATE TABLE `perfil_empresa` (
  `id_empresa` int(11) NOT NULL,
  `area` varchar(45) NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `perfil_empresa`
--

INSERT INTO `perfil_empresa` (`id_empresa`, `area`, `descricao`) VALUES
(14, 'Marketing', 'Empresa de Marketing.'),
(16, 'Marketing', 'Mkt'),
(18, 'Finanças', 'awds'),
(23, 'Finanças', 'Giovanatto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `tipo` int(1) DEFAULT NULL COMMENT 'Lenda:\n1 = Candidatos;\n2 = Administradores;\n3 = Empresas.\n',
  `status_user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `nome`, `email`, `senha`, `tipo`, `status_user`) VALUES
(1, 'Administrador', 'admin@gmail.com', '986326dd3304822215147361252574c3', 1, 0),
(5, 'Rodrigo', 'r@gmail.com', '986326dd3304822215147361252574c3', 2, 0),
(8, 'Bryan', 'bryan@gmail.com', '986326dd3304822215147361252574c3', 2, 0),
(14, 'whiss', 'whiss@gmail.com', '986326dd3304822215147361252574c3', 3, 0),
(15, 'Matheus', 'matheus01@gmail.com', '986326dd3304822215147361252574c3', 2, 0),
(16, 'Deed', 'deed@gmail.com', '986326dd3304822215147361252574c3', 3, 0),
(18, 'Treet', 'treet@gmail.com', '986326dd3304822215147361252574c3', 3, 0),
(22, 'Ryan Aires', 'airesryan88@gmail.com', '986326dd3304822215147361252574c3', 2, 0),
(23, 'Leicht', 'leicht@gmail.com', '986326dd3304822215147361252574c3', 3, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

CREATE TABLE `vagas` (
  `idVagas` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `area` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL COMMENT '1 - Onlide\\n2 - Presencial',
  `requisitos` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `pagamento` decimal(8,2) NOT NULL,
  `status_vaga` int(1) NOT NULL,
  `denuncia_vaga` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`idVagas`, `id_empresa`, `titulo`, `area`, `tipo`, `requisitos`, `descricao`, `pagamento`, `status_vaga`, `denuncia_vaga`) VALUES
(12, 16, 'Gerenciamento de folhas de pagamentos.', 'Finanças', 'presencial', 'Graduação em Administração ou economia;', 'Salário: R$4000;\r\nVA e VT: R$250;', '4000.00', 0, '0'),
(25, 18, 'Social media', 'Marketing', 'online', 'Graduação em Marketing; Boa comunicação;', 'Salário e vales compatíveis com o mercado.', '6000.00', 0, '0'),
(27, 14, 'Estágio em engenharia civil', 'Engenharia', 'presencial', 'Cursando engenharia civil a partir do 2° semestre.', '   Bolsa-Auxílio: R$1000;\r\nVale-Transporte: R$200;   ', '1000.00', 0, '0'),
(33, 23, 'Criação de petições.', 'Direito', 'presencial', 'Superior em Direito; Aprovado na OAB;', 'Salário compatível com o mercado.', '5000.00', 0, '0');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivos_curriculo`
--
ALTER TABLE `arquivos_curriculo`
  ADD PRIMARY KEY (`id_curriculo`);

--
-- Índices para tabela `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id_usuario_candidato`),
  ADD KEY `fk_Candidato_Usuarios1_idx` (`id_usuario_candidato`);

--
-- Índices para tabela `curriculo`
--
ALTER TABLE `curriculo`
  ADD PRIMARY KEY (`idCurriculo`),
  ADD UNIQUE KEY `id_candidato_UNIQUE` (`id_candidato`);

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_usuarios_empresa`),
  ADD UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  ADD KEY `fk_Empresas_Usuarios1_idx` (`id_usuarios_empresa`);

--
-- Índices para tabela `interessados`
--
ALTER TABLE `interessados`
  ADD PRIMARY KEY (`idInteressados`),
  ADD KEY `vaga_01_idx` (`id_vaga`),
  ADD KEY `currículo_interessados_idx` (`curriculo_candidato`),
  ADD KEY `proposta_candidato_idx` (`id_candidato`);

--
-- Índices para tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `destino_msg_idx` (`destino`),
  ADD KEY `destinatario_idx` (`destinatario`);

--
-- Índices para tabela `perfil_empresa`
--
ALTER TABLE `perfil_empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Índices para tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`idVagas`),
  ADD KEY `id_empresa_idx` (`id_empresa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `curriculo`
--
ALTER TABLE `curriculo`
  MODIFY `idCurriculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `interessados`
--
ALTER TABLE `interessados`
  MODIFY `idInteressados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `idVagas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `arquivos_curriculo`
--
ALTER TABLE `arquivos_curriculo`
  ADD CONSTRAINT `id_do_curriculo` FOREIGN KEY (`id_curriculo`) REFERENCES `curriculo` (`idCurriculo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidatos`
--
ALTER TABLE `candidatos`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`id_usuario_candidato`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `curriculo`
--
ALTER TABLE `curriculo`
  ADD CONSTRAINT `id_candidato` FOREIGN KEY (`id_candidato`) REFERENCES `candidatos` (`id_usuario_candidato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_Empresas_Usuarios1` FOREIGN KEY (`id_usuarios_empresa`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `interessados`
--
ALTER TABLE `interessados`
  ADD CONSTRAINT `currículo_interessados` FOREIGN KEY (`curriculo_candidato`) REFERENCES `curriculo` (`idCurriculo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proposta_candidato` FOREIGN KEY (`id_candidato`) REFERENCES `candidatos` (`id_usuario_candidato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vaga_01` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`idVagas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `destinatario` FOREIGN KEY (`destinatario`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `destino_msg` FOREIGN KEY (`destino`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `perfil_empresa`
--
ALTER TABLE `perfil_empresa`
  ADD CONSTRAINT `id_perfil_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_usuarios_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_usuarios_empresa`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
