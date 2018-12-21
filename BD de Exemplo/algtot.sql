-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2017 at 12:12 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `algtot`
--
CREATE DATABASE IF NOT EXISTS `algtot` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `algtot`;

-- --------------------------------------------------------

--
-- Table structure for table `aplicacao`
--

CREATE TABLE IF NOT EXISTS `aplicacao` (
  `cdAplicacao` int(11) NOT NULL AUTO_INCREMENT,
  `aplicacao` varchar(30) NOT NULL,
  `cdGrupo` int(11) NOT NULL,
  PRIMARY KEY (`cdAplicacao`),
  KEY `cdGrupo` (`cdGrupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `aplicacao`
--

INSERT INTO `aplicacao` (`cdAplicacao`, `aplicacao`, `cdGrupo`) VALUES
(1, 'atividadesADM.php', 1),
(2, 'principalADM.php', 1),
(3, 'questaoADM.php', 1),
(4, 'rankingADM.php', 1),
(5, 'atividadesProfessor.php', 2),
(6, 'principalProfessor.php', 2),
(7, 'questaoProfessor.php', 2),
(8, 'rankingProfessor.php', 2),
(9, 'atividades.php', 3),
(10, 'principal.php', 3),
(11, 'questaoTipo1.php', 3),
(12, 'questaoTipo2.php', 3),
(13, 'questaoTipo3.php', 3),
(14, 'ranking.php', 3),
(15, 'usuariosADM.php', 1),
(16, 'tradutor.php', 1),
(17, 'tradutor.php', 2),
(18, 'tradutor.php', 3);

-- --------------------------------------------------------

--
-- Table structure for table `atividade`
--

CREATE TABLE IF NOT EXISTS `atividade` (
  `cdAtividade` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `dataCadastramento` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cdAtividade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `atividade`
--

INSERT INTO `atividade` (`cdAtividade`, `titulo`, `nivel`, `dataCadastramento`, `status`) VALUES
(15, 'logica basica', 1, '2017-05-20', 'ativo'),
(16, 'atividade 2', 1, '2017-05-20', 'deletado'),
(17, '"teste" ''Tes Teste" ''''s', 1, '2017-05-20', 'deletado'),
(18, 'logica basica 2', 1, '2017-06-05', 'ativo');

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `cdGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(20) NOT NULL,
  PRIMARY KEY (`cdGrupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`cdGrupo`, `grupo`) VALUES
(1, 'ADM'),
(2, 'Professor'),
(3, 'Aluno');

-- --------------------------------------------------------

--
-- Table structure for table `questao`
--

CREATE TABLE IF NOT EXISTS `questao` (
  `cdQuestao` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `dataCadastramento` date DEFAULT NULL,
  `pergunta` varchar(2000) DEFAULT NULL,
  `alternativaCorreta` varchar(2000) DEFAULT NULL,
  `alternativaIncorreta1` varchar(2000) DEFAULT NULL,
  `alternativaIncorreta2` varchar(2000) DEFAULT NULL,
  `alternativaIncorreta3` varchar(2000) DEFAULT NULL,
  `alternativaIncorreta4` varchar(2000) DEFAULT NULL,
  `dica` varchar(2000) DEFAULT NULL,
  `pontuacao` int(11) DEFAULT NULL,
  `cdAtividade` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tempoTotalQuestao` int(11) DEFAULT NULL,
  PRIMARY KEY (`cdQuestao`),
  KEY `cdAtividade` (`cdAtividade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `questao`
--

INSERT INTO `questao` (`cdQuestao`, `tipo`, `dataCadastramento`, `pergunta`, `alternativaCorreta`, `alternativaIncorreta1`, `alternativaIncorreta2`, `alternativaIncorreta3`, `alternativaIncorreta4`, `dica`, `pontuacao`, `cdAtividade`, `status`, `tempoTotalQuestao`) VALUES
(30, 1, '2017-05-20', 'Considerando A = 10, B = 7 e C = 6, assinale a opção correta relacionada à lógica de programação.', '((B + A) > (C + C) AND (A != C) < (B != A))', '(A + 3) > (B + C) ', '((B * 4) >= (A + A * 2) AND (5 + 5) >= (A)) ', '((A + C) < (B * 2) OR (C + B * 3) < (A * 3)) ', '(C * 3) <= (3 + C * 2)', '', 30, 15, 'deletado', 1),
(31, 1, '2017-05-20', 'Sendo a e b variáveis inteiras em um programa, a expressão lógica: NÃO ((a > b) OU (a = b))', '(a < b);', '(a <= b);', '(a >= b);', '(a > b);', 'NÃO (a = b).', '', 20, 15, 'deletado', 1),
(32, 1, '2017-05-20', 'Marque a alternativa que corresponde a declaração de uma variável nesta versão do portugol.', 'variavel inteiro a;', 'variável inteiro a;', 'vari inteiro a;', 'inteiro a;', 'var a;', '', 10, 15, 'deletado', 1),
(39, 3, '2017-05-21', 'Qual das funções abaixo poderão  mostrar uma mensagem na tela, segundo essa sintaxe do portugol? ', 'escreva("Ola mundo");', 'escreva(Ola mundo);', 'escr(Ola mundo);', 'escreval(Ola mundo);', 'escreva("Ola mundo);', '', 10, 15, 'deletado', 1),
(38, 2, '2017-05-20', 'Organize em sequencia as instruções abaixo de maneira mais parecido com as ações que fazemos no momento em que acordamos. ', 'Acordar;\r\nLevantar;\r\nEscovar os Dentes;\r\nTomar café;\r\nEscovar os Dentes;', NULL, NULL, NULL, NULL, '', 50, 15, 'ativo', 1),
(40, 3, '2017-05-21', 'Escreva um algoritmo que some leia duas variáveis inteiras, e mostre a soma destas, em seguida assinale a alternativa que melhor corresponde ao algoritmo para esta questão.', 'declaração de variaveis inteiras; ler variaveis; somar variaveis; mostrar o resultado da soma;', 'ler variaveis; somar variaveis; mostrar o resultado da soma;', 'declaração de variaveis inteiras;  mostrar o resultado da soma;', 'declaração de variaveis reais; ler variaveis; somar variaveis; mostrar o resultado da multiplicacao;', 'declaração de variaveis caractere; ler variaveis; somar variaveis; mostrar o resultado da soma;', 'Você pode consultar a sintaxe do potugol clicando no botão "Sintaxe";', 60, 15, 'ativo', 20),
(41, 1, '2017-05-22', 'Alguns meses tem 30 dias, outros 31 dias. Quantos meses do ano tem 28 dias?', '12', '1', '2', '3', '4', '', 50, 15, 'ativo', 1),
(42, 1, '2017-05-22', 'Você encontrou uma caixa de fósforo, com apenas um palito num quarto escuro e frio. No quarto há uma lamparina à querosene e lenha seca. O que você acenderia primeiro?', 'O fósforo', 'A caixa', 'O quarto', 'A lamparina', 'A lenha', '', 10, 15, 'deletado', 1),
(43, 1, '2017-05-22', 'Um fazendeiro possui 17 vacas. Todas exceto nove, morreram. Quantas vacas sobraram?', '9', '17', '1', '10', '7', '', 5, 15, 'deletado', 1),
(44, 1, '2017-05-22', 'Qual o dobro da metade de dois?', '2', '4', '3', '1', '6', '', 10, 15, 'deletado', 1),
(45, 2, '2017-06-05', 'Organiza ai pa noiz parça', '1;\r\n2;\r\n3;', NULL, NULL, NULL, NULL, 'Você precisará utilizar uma estrutura de repetição como o "enquanto" para responder essa questão!', 20, 18, 'ativo', 2),
(46, 2, '2017-06-05', 'rganiza de novo ai mais decrecente', '3;\r\n2;\r\n1;', NULL, NULL, NULL, NULL, 'Você precisará utilizar uma estrutura de repetição como o "enquanto" para responder essa questão!', 10, 18, 'ativo', 2),
(47, 2, '2017-06-05', 'quero ver do inicio ao fim s', 'ver inicio;\r\nver meio;\r\nver fim;', NULL, NULL, NULL, NULL, 'Você precisará utilizar uma estrutura de repetição como o "enquanto" para responder essa questão!', 30, 18, 'ativo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `cdGrupo` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `nivel1` decimal(10,0) DEFAULT NULL,
  `nivel2` decimal(10,0) DEFAULT NULL,
  `nivel3` decimal(10,0) DEFAULT NULL,
  `nivel4` decimal(10,0) DEFAULT NULL,
  `nivel5` decimal(10,0) DEFAULT NULL,
  `pontuacaoTotal` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`cdUsuario`),
  KEY `cdGrupo` (`cdGrupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`cdUsuario`, `usuario`, `senha`, `cdGrupo`, `email`, `status`, `data`, `nivel1`, `nivel2`, `nivel3`, `nivel4`, `nivel5`, `pontuacaoTotal`) VALUES
(78, 'root', 'root', 1, 'root@root.com', 'ativo', '2017-05-19', '0', '0', '0', '0', '0', '0'),
(79, 'Edu', 'root', 3, 'eduardogbi51@hotmail.com', 'ativo', '2017-05-19', '220', '0', '0', '0', '0', '220'),
(80, 'woquiton', 'root', 2, 'woquiton@gmail.com', 'ativo', '2017-05-19', '0', '0', '0', '0', '0', '0'),
(81, 'tinga', 'root', 3, 'tinga@hotmail.com', 'ativo', '2017-05-20', '75', '0', '0', '0', '0', '75'),
(82, 'nando', 'root', 3, 'nando@gmail.com', 'ativo', '2017-05-20', '75', '0', '0', '0', '0', '75'),
(83, 'ton', 'root', 3, 'ton@gmail.com', 'ativo', '2017-05-20', '110', '0', '0', '0', '0', '110'),
(91, 'tato', 'root', 3, 'tato@hotmail.com', 'ativo', '2017-05-20', '85', '0', '0', '0', '0', '85'),
(86, 'moni', 'root', 3, 'moni@gmail.com', 'ativo', '2017-05-20', '40', '0', '0', '0', '0', '40'),
(90, 'mona', 'root', 3, 'mona@hotmail.com', 'ativo', '2017-05-20', '90', '0', '0', '0', '0', '90'),
(89, 'dida', 'root', 3, 'dida@gmail.com', 'ativo', '2017-05-20', '0', '0', '0', '0', '0', '0'),
(96, 'roote', 'root', 3, 'roote@ho.com', 'deletado', '2017-05-25', '0', '0', '0', '0', '0', '0'),
(93, 'ana', 'root', 3, 'ana@hotmail.com', 'ativo', '2017-05-20', '115', '0', '0', '0', '0', '115'),
(94, 'sophi', 'root', 3, 'sophi@gmail.com', 'ativo', '2017-05-20', '50', '0', '0', '0', '0', '50');

-- --------------------------------------------------------

--
-- Table structure for table `usuarioquestao`
--

CREATE TABLE IF NOT EXISTS `usuarioquestao` (
  `cdUsuarioQuestao` int(11) NOT NULL AUTO_INCREMENT,
  `cdUsuario` int(11) NOT NULL,
  `cdQuestao` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cdUsuarioQuestao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1120 ;

--
-- Dumping data for table `usuarioquestao`
--

INSERT INTO `usuarioquestao` (`cdUsuarioQuestao`, `cdUsuario`, `cdQuestao`, `status`) VALUES
(1097, 79, 46, 'acertou'),
(1098, 79, 45, 'acertou'),
(1099, 79, 47, 'acertou'),
(1100, 79, 38, 'acertou'),
(1101, 79, 40, 'acertou'),
(1102, 79, 41, 'acertou'),
(1103, 79, 45, 'errou'),
(1104, 79, 47, 'acertouDenovo'),
(1105, 79, 46, 'acertouDenovo'),
(1106, 79, 47, 'errou'),
(1107, 79, 46, 'errou'),
(1108, 79, 45, 'acertouDenovo'),
(1109, 79, 45, 'errou'),
(1110, 79, 46, 'errou'),
(1111, 79, 47, 'acertouDenovo'),
(1112, 79, 47, 'acertouDenovo'),
(1113, 79, 45, 'errou'),
(1114, 79, 46, 'errou'),
(1115, 79, 45, 'acertouDenovo'),
(1116, 79, 46, 'acertouDenovo'),
(1117, 79, 47, 'acertouDenovo'),
(1118, 79, 47, 'errou'),
(1119, 79, 45, 'errou');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
