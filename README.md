

# Portal de Notícias

Este é um portal de notícias desenvolvido com PHP, MySQL (usando PDO), HTML e CSS. O projeto inclui funcionalidades de cadastro e login de usuários, publicação de notícias, e visualização de notícias publicadas.

## Funcionalidades

- **Cadastro de usuário**: Os usuários podem se cadastrar com nome, sexo, telefone, e-mail e senha.
- **Login de usuário**: Usuários podem fazer login para acessar o portal.
- **Publicação de notícias**: Usuários logados podem publicar novas notícias, incluindo título, autor, data, conteúdo e foto.
- **Visualização de notícias**: O portal exibe todas as notícias publicadas.

## Estrutura do Banco de Dados

### Banco de Dados: `bdcrud`

Este arquivo SQL é um dump do banco de dados gerado pelo phpMyAdmin, contendo as instruções necessárias para recriar as tabelas e inserir os dados para o banco de dados chamado `bdcrud`. Abaixo está a descrição das tabelas e seus dados.

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

## Instalação

### 1. Requisitos

- PHP
- MySQL
- Servidor Apache (para rodar PHP)
- Acesso ao terminal para rodar o script SQL no banco de dados

### 2. Passos para instalar

#### Clonar o repositório:
Se você ainda não tem o repositório, clone-o para o seu ambiente local:

```bash
git clone https://github.com/seuusuario/ProjetoCrud
```

#### Importar o banco de dados:

No seu banco de dados MySQL, crie o banco `bdcrud` e importe o arquivo SQL com as tabelas e dados iniciais:

```sql
CREATE DATABASE bdcrud;
USE bdcrud;
-- Aqui você insere o SQL para criar e popular as tabelas conforme a descrição acima.
```

#### Configuração do servidor local:

- Se você estiver usando o XAMPP ou WAMP, mova o projeto para o diretório `htdocs` e abra no navegador através do `localhost/portal-de-noticias`.
- Se estiver usando um servidor Apache ou Nginx em produção, configure a aplicação como um site no seu servidor.

### 3. Dependências

O projeto não possui dependências externas, mas você pode adicionar um gerenciador de pacotes como o Composer se desejar adicionar bibliotecas PHP adicionais.

## Estrutura de Arquivos

- `/classes`
  - `Database.php`
  - `Noticias.php`
  - `Usuario.php`
- `/config`
  - `config.php`
- `/uploads`
  - (diretório para armazenar imagens das notícias)
- `/includes`
  - `db.php`
  - `header.php`
  - `footer.php`
- `/projetocrud`
  - `cadastronoticias.php`
  - `deletar.php`
  - `deletarNot.php`
  - `editar.php`
  - `editarNoticias.php`
  - `gerenciador.php`
  - `gerenciaUsu.php`
  - `index.php`
  - `login.php`
  - `logout.php`
  - `portal.php`
  - `registrar.php`
  - `salvarnoticias.php`

---
