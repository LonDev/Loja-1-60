-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Set-2017 às 00:10
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NOME` varchar(50) CHARACTER SET utf8 NOT NULL,
  `CPF_CNPJ` varchar(50) CHARACTER SET utf8 NOT NULL,
  `DIVIDA_ATIVA` tinyint(1) NOT NULL,
  `VALOR_DIVIDA` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `NOME`, `CPF_CNPJ`, `DIVIDA_ATIVA`, `VALOR_DIVIDA`, `created_at`, `updated_at`) VALUES
(1, 'Tester', '321123123123', 0, 0, '2016-10-20 04:24:45', '2016-10-20 07:45:50'),
(3, 'Dois de tres 4', '9876543210', 0, 0, '2016-10-20 07:24:14', '2016-10-20 07:24:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `nome_loja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `paginacao` int(11) NOT NULL,
  `descricao_nota` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fundo_venda` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`id`, `nome_loja`, `paginacao`, `descricao_nota`, `created_at`, `updated_at`, `fundo_venda`) VALUES
(1, 'menina', 50, '', '2017-09-26 22:08:36', '2017-09-26 22:08:36', 'C:\\wamp\\tmp\\php5FFA.tmp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `descricao_notas`
--

CREATE TABLE `descricao_notas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nota` bigint(20) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `unitario` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `descricao_notas`
--

INSERT INTO `descricao_notas` (`id`, `id_nota`, `descricao`, `quantidade`, `unitario`, `total`) VALUES
(4, 123, 'BALA DE GOMA', 5, 10, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `REFERENCIA` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRICAO` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `NOME` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `FORNECEDOR` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `MEDIDA` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `PRECO` double NOT NULL,
  `CUSTOCOMPR` double NOT NULL,
  `MARGEMLUCRO` double NOT NULL,
  `LUCROVAREJO` double NOT NULL,
  `MARGEMATACADO` double NOT NULL,
  `PRECOATACADO` double NOT NULL,
  `SETOR` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `QTD_ATUAL` int(20) NOT NULL,
  `QTD_MINIM` int(20) NOT NULL,
  `QTD_INICIO` int(20) NOT NULL,
  `ULT_VENDA` date NOT NULL,
  `OBS` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `QTD_VEND` int(20) NOT NULL,
  `CUS_VEND` decimal(20,0) NOT NULL,
  `ATIVO` tinyint(1) NOT NULL,
  `VISIVEL` tinyint(1) NOT NULL,
  `LOCAL` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id`, `created_at`, `updated_at`, `REFERENCIA`, `DESCRICAO`, `NOME`, `FORNECEDOR`, `MEDIDA`, `PRECO`, `CUSTOCOMPR`, `MARGEMLUCRO`, `LUCROVAREJO`, `MARGEMATACADO`, `PRECOATACADO`, `SETOR`, `QTD_ATUAL`, `QTD_MINIM`, `QTD_INICIO`, `ULT_VENDA`, `OBS`, `QTD_VEND`, `CUS_VEND`, `ATIVO`, `VISIVEL`, `LOCAL`) VALUES
(5140, '2017-09-26 22:07:53', '2017-09-26 22:07:53', '123', 'BALA DE GOMA', '', 'armazem', 'KG', 12, 10, 20, 2, 10, 11, 'setor padrão', 9, 2, 0, '0000-00-00', '', 0, '0', 1, 1, 'local padrão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedors`
--

CREATE TABLE `fornecedors` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `telefone_1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefone_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefone_representante` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `representante` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `operadora` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_representante` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` int(11) NOT NULL,
  `incricao_estado` int(11) NOT NULL,
  `limite` int(11) NOT NULL,
  `prazo` int(11) NOT NULL,
  `forma_entrega` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `fornecedors`
--

INSERT INTO `fornecedors` (`id`, `created_at`, `updated_at`, `nome`, `endereco`, `numero`, `bairro`, `cep`, `cidade`, `estado`, `telefone_1`, `telefone_2`, `email`, `telefone_representante`, `representante`, `celular`, `operadora`, `email_representante`, `site`, `cnpj`, `incricao_estado`, `limite`, `prazo`, `forma_entrega`) VALUES
(731, NULL, '2017-09-26 22:09:11', 'ARMAZEM', 'rua 1', '123', '123', '123', 'mogi das cruzes', 'sp', '47901234', '', 'np@np.com', '', 'odilon', '', '', '', '', 0, 0, 0, 0, 'Selecione'),
(732, '2017-09-26 22:09:01', '2017-09-26 22:09:01', 'LOJA 2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 'Selecione');

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacaos`
--

CREATE TABLE `localizacaos` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `localizacaos`
--

INSERT INTO `localizacaos` (`id`, `created_at`, `updated_at`, `nome`) VALUES
(1, '2016-08-20 09:27:17', '2016-08-20 09:27:17', 'local padrão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medidas_config`
--

CREATE TABLE `medidas_config` (
  `id` int(11) NOT NULL,
  `paginacao` int(11) NOT NULL,
  `unidades` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `operadoras` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `forma_entrega` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `medidas_config`
--

INSERT INTO `medidas_config` (`id`, `paginacao`, `unidades`, `operadoras`, `forma_entrega`) VALUES
(2, 25, 'UN', 'OI', 'MOTOBOY'),
(3, 50, 'FD', 'VIVO', 'CORREIOS'),
(4, 80, 'CM', 'CLARO', 'OUTROS'),
(5, 100, 'ML', 'NEXTEL', ''),
(6, 150, 'KG', 'TIM', ''),
(7, 200, 'L', '', ''),
(8, 1000, 'GR', '', ''),
(9, 0, 'MM', '', ''),
(10, 0, 'MG', '', ''),
(11, 0, 'PC', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_nota` bigint(20) NOT NULL,
  `id_fornecedor` bigint(20) NOT NULL,
  `vencimento` varchar(50) NOT NULL,
  `total_nota` double NOT NULL,
  `tipo_nota` int(11) NOT NULL,
  `itens` int(11) NOT NULL,
  `quit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notas`
--

INSERT INTO `notas` (`created_at`, `updated_at`, `id`, `numero_nota`, `id_fornecedor`, `vencimento`, `total_nota`, `tipo_nota`, `itens`, `quit`) VALUES
('2017-09-26 22:07:12', '2017-09-26 22:07:12', 3, 123, 731, '26/09/2017', 54, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setors`
--

CREATE TABLE `setors` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `setors`
--

INSERT INTO `setors` (`id`, `created_at`, `updated_at`, `nome`) VALUES
(1, '2016-08-20 09:27:31', '2016-08-20 09:27:31', 'setor padrão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cargo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nivel_acesso` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `password`, `remember_token`, `created_at`, `updated_at`, `cargo`, `nivel_acesso`) VALUES
(1, 'odilon.silva', '$2y$10$vFaMUHSJve.KDuqxs.KWkuO87U10cFx3RiDYYIjFHGtYQz08km.BW', '1lO5wJDRSwlyHMM8guT6KPZQe9cDBJG9iPfwvU7iLpMGWuUPK5rvt1a1PuQV', '2016-08-18 04:34:03', '2016-10-21 07:56:49', 'gerente', 'administrador'),
(2, 'victor.silva', '$2y$10$0./msQeJI2htvj4mK/aaGuvCoRVBZ9dYDRLrSlYnZheXRj1osYgN2', 'k4IbzZC6Q8zLPWPuF5ZjWR5CClJCBgpzYCYovxx1ixBKnJlhv126bL7ROPNE', '2016-08-20 07:54:29', '2016-08-20 08:40:01', 'analista jr', 'administrador'),
(4, 'vendedor', '$2y$10$7WjuoPGnlDsKTOBvOADhEe4olaLtKh.iz6Vol4hhbTpC4OtA9xNhC', 'URW2iBcErEonqtprmkGXkU7iNPqko7iP8rX0rn2D5ZC89NhqX2NlrAgoTPbq', '2016-08-20 08:39:51', '2016-10-21 07:57:12', 'Vendedor', 'usuario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `itens` int(10) UNSIGNED NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `desconto` int(11) NOT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `parcelas` int(10) UNSIGNED NOT NULL,
  `juros` decimal(5,2) NOT NULL,
  `nome_representante` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `created_at`, `updated_at`, `itens`, `valor`, `desconto`, `cpf`, `parcelas`, `juros`, `nome_representante`, `descricao`) VALUES
(42, '2017-09-26 22:07:53', '2017-09-26 22:07:53', 1, '12.00', 0, 'Não obtido', 0, '0.00', 'Não obtido', '1xBALA DE GOMA 12.00\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `descricao_notas`
--
ALTER TABLE `descricao_notas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedors`
--
ALTER TABLE `fornecedors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localizacaos`
--
ALTER TABLE `localizacaos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medidas_config`
--
ALTER TABLE `medidas_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `setors`
--
ALTER TABLE `setors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `descricao_notas`
--
ALTER TABLE `descricao_notas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5141;
--
-- AUTO_INCREMENT for table `fornecedors`
--
ALTER TABLE `fornecedors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=733;
--
-- AUTO_INCREMENT for table `localizacaos`
--
ALTER TABLE `localizacaos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `medidas_config`
--
ALTER TABLE `medidas_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `setors`
--
ALTER TABLE `setors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
