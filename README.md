Aqui está o conteúdo do README organizado de forma mais bonita e clara:

---

# Banco de Dados: `bdcrud`

Este arquivo SQL é um dump de banco de dados gerado pelo phpMyAdmin. Ele contém as instruções necessárias para recriar as tabelas e inserir os dados para o banco de dados chamado `bdcrud`. Abaixo está a descrição das tabelas e seus dados.

## Estrutura do Banco de Dados

### 1. Tabela: `noticias`
A tabela `noticias` armazena informações sobre as notícias, incluindo o título, autor, data de publicação, conteúdo e foto associada.

#### Estrutura:
```sql
CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,           -- Identificador único da notícia
  `titulo` varchar(255) NOT NULL,   -- Título da notícia
  `autor` int(11) NOT NULL,         -- ID do autor (referência à tabela `usuarios`)
  `data` date NOT NULL,             -- Data de publicação
  `noticia` text NOT NULL,          -- Conteúdo da notícia
  `foto` varchar(255) NOT NULL      -- Nome do arquivo de foto
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

#### Dados inseridos:
```sql
INSERT INTO `noticias` (`id`, `titulo`, `autor`, `data`, `noticia`, `foto`) 
VALUES
(4, 'extra1', 5, '2024-12-19', 'kjjkj', '674e3bd9cee13.png');
```

#### Índices:
```sql
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`);
```

#### Auto-incremento:
```sql
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
```

#### Chave estrangeira:
```sql
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id`);
```

### 2. Tabela: `usuarios`
A tabela `usuarios` armazena informações sobre os usuários, incluindo nome, sexo, telefone, e-mail e senha (criptografada).

#### Estrutura:
```sql
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,            -- Identificador único do usuário
  `nome` varchar(255) NOT NULL,      -- Nome do usuário
  `sexo` char(1) NOT NULL,           -- Sexo do usuário (M ou F)
  `fone` varchar(15) NOT NULL,       -- Número de telefone
  `email` varchar(100) NOT NULL,     -- E-mail do usuário
  `senha` varchar(255) NOT NULL      -- Senha criptografada do usuário
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

#### Dados inseridos:
```sql
INSERT INTO `usuarios` (`id`, `nome`, `sexo`, `fone`, `email`, `senha`) 
VALUES
(4, 'Raissa camboim', 'F', '89899989', 'raissa@gmail.com', '$2y$10$fxXHEDyyvwk0qjc1cJw5J.OjzZEELD5F0z50XFYN5CwiibWU2N492'),
(5, 'leon', 'M', '87878676', 'leon@gmail.com', '$2y$10$MKGu65hAr29nfMjj3OfKcubjoPGLKtQxtBn./Xs1qnsY0tvUbifvC'),
(6, 'julia', 'F', '23232232', 'ju@gmail.com', '$2y$10$mCZioGSN2XG4CCVV/oZG..QwDgeDi7cKIaerOJcGTIXPAvowglkf6');
```

#### Índices:
```sql
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
```

#### Auto-incremento:
```sql
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
```

## Resumo do Banco de Dados
- O banco de dados contém duas tabelas principais: `noticias` e `usuarios`.
- A tabela `noticias` guarda as informações sobre as notícias publicadas, com relação de autor a um usuário na tabela `usuarios`.
- A tabela `usuarios` guarda os dados dos usuários, incluindo suas credenciais de login (e-mail e senha).
- As tabelas possuem chaves primárias e índices apropriados para garantir a integridade e a eficiência nas buscas.

---

Este README fornece uma visão geral do banco de dados e como ele está estruturado para funcionar. Ele foi configurado para ser utilizado em um sistema que lida com notícias e usuários.
