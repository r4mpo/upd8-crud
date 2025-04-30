-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/04/2025 às 06:28
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `upd8-crud`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cidades`
--

INSERT INTO `cidades` (`id`, `created_at`, `updated_at`, `nome`, `estado`) VALUES
(1, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'São Paulo', 'SP'),
(2, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Rio de Janeiro', 'RJ'),
(3, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Belo Horizonte', 'MG'),
(4, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Salvador', 'BA'),
(5, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Fortaleza', 'CE'),
(6, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Curitiba', 'PR'),
(7, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Manaus', 'AM'),
(8, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Recife', 'PE'),
(9, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Porto Alegre', 'RS'),
(10, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Belém', 'PA'),
(11, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Goiânia', 'GO'),
(12, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Guarulhos', 'SP'),
(13, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Campinas', 'SP'),
(14, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'São Luís', 'MA'),
(15, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Maceió', 'AL'),
(16, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Natal', 'RN'),
(17, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Teresina', 'PI'),
(18, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Campo Grande', 'MS'),
(19, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'São Bernardo do Campo', 'SP'),
(20, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Nova Iguaçu', 'RJ'),
(21, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'João Pessoa', 'PB'),
(22, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'São José dos Campos', 'SP'),
(23, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Santo André', 'SP'),
(24, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Jaboatão dos Guararapes', 'PE'),
(25, '2025-04-30 07:28:13', '2025-04-30 07:28:13', 'Osasco', 'SP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `endereco` varchar(60) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `created_at`, `updated_at`, `cpf`, `nome`, `data_nascimento`, `sexo`, `endereco`, `estado`, `cidade_id`) VALUES
(1, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '12345678901', 'João Silva', '1990-05-15', 'M', 'Rua das Flores, 123', 'SP', 1),
(2, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '98765432100', 'Maria Oliveira', '1985-11-23', 'F', 'Av. Brasil, 456', 'RJ', 2),
(3, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '11122233344', 'Carlos Pereira', '1978-02-08', 'M', 'Praça Central, 789', 'MG', 3),
(4, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '55566677788', 'Ana Souza', '1992-07-19', 'F', 'Rua Alegre, 321', 'BA', 4),
(5, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '44433322211', 'Pedro Lima', '1988-09-30', 'M', 'Av. Paulista, 654', 'SP', 1),
(6, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '99988877766', 'Fernanda Gomes', '1995-04-12', 'F', 'Rua da Paz, 789', 'CE', 5),
(7, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '22233344455', 'Marcos Dias', '1982-01-05', 'M', 'Travessa Sol, 12', 'PR', 6),
(8, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '77766655544', 'Patrícia Andrade', '1991-03-18', 'F', 'Rua das Palmeiras, 50', 'AM', 7),
(9, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '88877766655', 'Ricardo Mota', '1987-10-11', 'M', 'Av. Atlântica, 900', 'PE', 8),
(10, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '33322211100', 'Luciana Castro', '1993-12-22', 'F', 'Rua Verde, 77', 'RS', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(55, '0001_01_01_000001_create_cache_table', 1),
(56, '0001_01_01_000002_create_jobs_table', 1),
(57, '2025_03_04_001830_create_users_table', 1),
(58, '2025_03_04_001921_create_personal_access_tokens_table', 1),
(59, '2025_03_04_174200_create_sessions_table', 1),
(60, '2025_04_27_115746_create_cidades_table', 1),
(61, '2025_04_27_115787_add_unique_index_to_cidades_table', 1),
(62, '2025_04_27_120633_create_representantes_table', 1),
(63, '2025_04_27_125746_create_clientes_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `representantes`
--

CREATE TABLE `representantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `endereco` varchar(60) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `representantes`
--

INSERT INTO `representantes` (`id`, `created_at`, `updated_at`, `cpf`, `nome`, `data_nascimento`, `sexo`, `telefone`, `email`, `endereco`, `estado`, `cidade_id`) VALUES
(1, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000001', 'José Representante 1', '1980-01-01', 'M', '(11) 91111-1111', 'jose.rep1@exemplo.com', 'Rua A, 100', 'SP', 1),
(2, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000002', 'Paula Representante 2', '1981-02-02', 'F', '(11) 92222-2222', 'paula.rep2@exemplo.com', 'Rua B, 200', 'SP', 1),
(3, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000003', 'Carlos Representante 3', '1982-03-03', 'M', '(11) 93333-3333', 'carlos.rep3@exemplo.com', 'Rua C, 300', 'SP', 1),
(4, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000004', 'Fernanda Representante 1', '1983-04-04', 'F', '(21) 94444-4444', 'fernanda.rep1@exemplo.com', 'Av. Leste, 400', 'RJ', 2),
(5, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000005', 'Rafael Representante 2', '1984-05-05', 'M', '(21) 95555-5555', 'rafael.rep2@exemplo.com', 'Av. Oeste, 500', 'RJ', 2),
(6, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000006', 'Juliana Representante 3', '1985-06-06', 'F', '(21) 96666-6666', 'juliana.rep3@exemplo.com', 'Av. Norte, 600', 'RJ', 2),
(7, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000007', 'Luiz Representante 1', '1986-07-07', 'M', '(31) 97777-7777', 'luiz.rep1@exemplo.com', 'Praça Alfa, 700', 'MG', 3),
(8, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000008', 'Bianca Representante 2', '1987-08-08', 'F', '(31) 98888-8888', 'bianca.rep2@exemplo.com', 'Praça Beta, 800', 'MG', 3),
(9, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000009', 'Eduardo Representante 3', '1988-09-09', 'M', '(31) 99999-9999', 'eduardo.rep3@exemplo.com', 'Praça Gama, 900', 'MG', 3),
(10, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000010', 'Tatiane Representante 1', '1989-10-10', 'F', '(71) 91000-0001', 'tatiane.rep1@exemplo.com', 'Rua Delta, 1000', 'BA', 4),
(11, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000011', 'Diego Representante 2', '1990-11-11', 'M', '(71) 92000-0002', 'diego.rep2@exemplo.com', 'Rua Epsilon, 1100', 'BA', 4),
(12, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000012', 'Isabela Representante 3', '1991-12-12', 'F', '(71) 93000-0003', 'isabela.rep3@exemplo.com', 'Rua Zeta, 1200', 'BA', 4),
(13, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000013', 'Márcio Representante 1', '1980-01-13', 'M', '(85) 91111-1113', 'marcio.rep1@exemplo.com', 'Rua Sol Nascente, 1300', 'CE', 5),
(14, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000014', 'Débora Representante 2', '1981-02-14', 'F', '(85) 92222-2214', 'debora.rep2@exemplo.com', 'Rua do Mar, 1400', 'CE', 5),
(15, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000015', 'Otávio Representante 3', '1982-03-15', 'M', '(85) 93333-3315', 'otavio.rep3@exemplo.com', 'Av. Ceará, 1500', 'CE', 5),
(16, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000016', 'Elaine Representante 1', '1983-04-16', 'F', '(41) 94444-4416', 'elaine.rep1@exemplo.com', 'Rua Paraná, 1600', 'PR', 6),
(17, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000017', 'Rodrigo Representante 2', '1984-05-17', 'M', '(41) 95555-5517', 'rodrigo.rep2@exemplo.com', 'Av. Curitiba, 1700', 'PR', 6),
(18, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000018', 'Renata Representante 3', '1985-06-18', 'F', '(41) 96666-6618', 'renata.rep3@exemplo.com', 'Rua das Araucárias, 1800', 'PR', 6),
(19, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000019', 'Bruno Representante 1', '1986-07-19', 'M', '(92) 97777-7719', 'bruno.rep1@exemplo.com', 'Av. Amazonas, 1900', 'AM', 7),
(20, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000020', 'Simone Representante 2', '1987-08-20', 'F', '(92) 98888-8820', 'simone.rep2@exemplo.com', 'Rua Manaus, 2000', 'AM', 7),
(21, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000021', 'Hugo Representante 3', '1988-09-21', 'M', '(92) 99999-9921', 'hugo.rep3@exemplo.com', 'Travessa Rio Negro, 2100', 'AM', 7),
(22, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000022', 'Tatiana Representante 1', '1989-10-22', 'F', '(81) 91000-0022', 'tatiana.rep1@exemplo.com', 'Av. Recife, 2200', 'PE', 8),
(23, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000023', 'Alex Representante 2', '1990-11-23', 'M', '(81) 92000-0023', 'alex.rep2@exemplo.com', 'Rua Boa Viagem, 2300', 'PE', 8),
(24, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000024', 'Camila Representante 3', '1991-12-24', 'F', '(81) 93000-0024', 'camila.rep3@exemplo.com', 'Rua Olinda, 2400', 'PE', 8),
(25, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000025', 'Vinícius Representante 1', '1980-01-25', 'M', '(51) 91111-1125', 'vinicius.rep1@exemplo.com', 'Av. Porto Alegre, 2500', 'RS', 9),
(26, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000026', 'Marina Representante 2', '1981-02-26', 'F', '(51) 92222-2226', 'marina.rep2@exemplo.com', 'Rua dos Andradas, 2600', 'RS', 9),
(27, '2025-04-30 07:28:13', '2025-04-30 07:28:13', '90000000027', 'Thiago Representante 3', '1982-03-27', 'M', '(51) 93333-3327', 'thiago.rep3@exemplo.com', 'Rua Gramado, 2700', 'RS', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Erick', 'erick@upd8', '$2y$12$G/88rtvHeFMkfmunl4a61e4/5pFidL.zI7CSLnzVYrVmdVeoD6omq', '2025-04-30 07:28:21', 'pUbhRAlxwQ', '2025-04-30 07:28:21', '2025-04-30 07:28:21');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cidades_nome_estado_unique` (`nome`,`estado`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_cpf_unique` (`cpf`),
  ADD KEY `clientes_cidade_id_foreign` (`cidade_id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `representantes_cpf_unique` (`cpf`),
  ADD UNIQUE KEY `representantes_email_unique` (`email`),
  ADD KEY `representantes_cidade_id_foreign` (`cidade_id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_cidade_id_foreign` FOREIGN KEY (`cidade_id`) REFERENCES `cidades` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `representantes_cidade_id_foreign` FOREIGN KEY (`cidade_id`) REFERENCES `cidades` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
