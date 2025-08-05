# Sistema de Gestão de Empresas

Um sistema completo de gestão empresarial desenvolvido em PHP com interface moderna usando Bootstrap. O sistema permite gerenciar clientes, funcionários e usuários de forma eficiente e organizada.

## 📋 Descrição Geral

O **Sistema de Gestão de Empresas** é uma aplicação web desenvolvida para facilitar o controle e gerenciamento de dados empresariais. O sistema oferece funcionalidades completas de CRUD (Create, Read, Update, Delete) para três entidades principais:

- **Clientes**: Cadastro completo com dados pessoais, endereço e contatos
- **Funcionários**: Gestão de colaboradores com fotos e informações pessoais
- **Usuários**: Sistema de autenticação e controle de acesso administrativo

### Funcionalidades Principais

- ✅ **Gestão de Clientes**: Cadastro, edição, visualização e exclusão de clientes
- ✅ **Gestão de Funcionários**: Controle completo de dados dos colaboradores
- ✅ **Sistema de Usuários**: Autenticação e controle de acesso
- ✅ **Interface Responsiva**: Design moderno e adaptável a diferentes dispositivos
- ✅ **Sistema de Busca**: Filtros para localizar registros rapidamente
- ✅ **Upload de Imagens**: Suporte para fotos de funcionários e usuários
- ✅ **Validação de Dados**: Controles de entrada e formatação automática

## 🛠️ Tecnologias Utilizadas

### Backend
- **PHP 8.1+** - Linguagem principal do servidor
- **MySQL** - Sistema de gerenciamento de banco de dados
- **mysqli** - Driver de conexão com banco de dados

### Frontend
- **Bootstrap 5** - Framework CSS para interface responsiva
- **Font Awesome** - Ícones e elementos visuais
- **jQuery 3.7.1** - Biblioteca JavaScript
- **Tiny Slider** - Componente de carrossel

### Estrutura e Organização
- **Sistema de Templates** - Header e footer reutilizáveis
- **Sessões PHP** - Controle de estado e autenticação

## ⚙️ Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP 8.1** ou superior
- **MySQL 5.7** ou superior
- **Servidor Web** (Apache) ou **XAMPP**
- **Extensões PHP**:
  - mysqli
  - session
  - fileinfo (para upload de arquivos)

## 🚀 Instalação

### 1. Clone o Repositório

```bash
git clone https://github.com/seu-usuario/crud-bootstrap-php.git
cd crud-bootstrap-php
```

### 2. Configure o Servidor Web

Copie os arquivos para o diretório do seu servidor web:

```bash
# Para XAMPP (Windows)
C:\xampp\htdocs\crud-bootstrap-php\

# Para WAMP (Windows)
C:\wamp64\www\crud-bootstrap-php\

# Para MAMP (macOS)
/Applications/MAMP/htdocs/crud-bootstrap-php/
```

### 3. Configure o Banco de Dados

1. Acesse o phpMyAdmin ou seu cliente MySQL
2. Crie um novo banco de dados chamado `wda_crud`
3. Importe o arquivo `bd.sql` para criar as tabelas

```sql
-- Via linha de comando
mysql -u root -p
CREATE DATABASE wda_crud;
USE wda_crud;
SOURCE bd.sql;
```

## ⚙️ Configuração

### 1. Configuração do Banco de Dados

Edite o arquivo `config.php` com suas credenciais:

```php
// config.php
define("DB_NAME", "wda_crud");
define("DB_USER", "seu_usuario");
define("DB_PASSWORD", "sua_senha");
define("DB_HOST", "localhost");
```

### 2. Configuração da URL Base

Ajuste a URL base no arquivo `config.php`:

```php
// Para desenvolvimento local
define('BASEURL', '/crud-bootstrap-php/');

// Para produção
define('BASEURL', '/');
```

## 🎯 Como Usar

### 1. Acessando o Sistema

Abra seu navegador e acesse:

```
http://localhost/crud-bootstrap-php/
```

### 2. Funcionalidades Disponíveis

#### Gestão de Clientes
- **URL**: `http://localhost/crud-bootstrap-php/customers/`
- **Funcionalidades**: Listar, adicionar, editar, visualizar e excluir clientes
- **Dados**: Nome, CPF/CNPJ, data de nascimento, endereço, telefones

#### Gestão de Funcionários
- **URL**: `http://localhost/crud-bootstrap-php/funcionario/`
- **Funcionalidades**: CRUD completo com upload de fotos
- **Dados**: Nome, endereço, data de nascimento, foto

#### Gestão de Usuários (Admin)
- **URL**: `http://localhost/crud-bootstrap-php/usuarios/`
- **Acesso**: Apenas para usuários administradores
- **Funcionalidades**: Controle de usuários do sistema

### 3. Exemplos de Uso

#### Adicionando um Cliente
1. Acesse "Clientes" → "Novo Cliente"
2. Preencha os dados obrigatórios
3. Clique em "Salvar"

#### Buscando Registros
1. Use o campo de busca em qualquer módulo
2. Digite parte do nome ou CPF
3. Clique em "Consultar"

## 📁 Estrutura de Pastas

```
crud-bootstrap-php/
├── assets/                 # Imagens e recursos estáticos
├── customers/              # Módulo de gestão de clientes
│   ├── add.php            # Adicionar cliente
│   ├── edit.php           # Editar cliente
│   ├── delete.php         # Excluir cliente
│   ├── view.php           # Visualizar cliente
│   ├── index.php          # Lista de clientes
│   ├── functions.php      # Funções específicas
│   └── modal.php          # Modais de confirmação
├── funcionario/            # Módulo de gestão de funcionários
│   ├── add.php            # Adicionar funcionário
│   ├── edit.php           # Editar funcionário
│   ├── delete.php         # Excluir funcionário
│   ├── view.php           # Visualizar funcionário
│   ├── index.php          # Lista de funcionários
│   ├── functions.php      # Funções específicas
│   └── modal.php          # Modais de confirmação
├── usuarios/               # Módulo de gestão de usuários
│   ├── add.php            # Adicionar usuário
│   ├── edit.php           # Editar usuário
│   ├── delete.php         # Excluir usuário
│   ├── view.php           # Visualizar usuário
│   ├── index.php          # Lista de usuários
│   ├── functions.php      # Funções específicas
│   └── modal.php          # Modais de confirmação
├── inc/                   # Arquivos de inclusão
│   ├── database.php       # Funções de banco de dados
│   ├── header.php         # Cabeçalho do site
│   ├── footer.php         # Rodapé do site
│   ├── login.php          # Sistema de login
│   ├── logout.php         # Sistema de logout
│   └── valida.php         # Validação de sessão
├── fotos/                 # Upload de imagens
├── css/                   # Arquivos CSS
├── js/                    # Arquivos JavaScript
├── config.php             # Configurações do sistema
├── bd.sql                 # Script do banco de dados
└── index.php              # Página principal
```

## 📄 Licença

Este projeto está sob a licença **MIT**. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

### Permissões da Licença MIT

- ✅ Comercial use
- ✅ Modificação
- ✅ Distribuição
- ✅ Uso privado
- ❌ Responsabilidade
- ❌ Garantia

## 📞 Contato

### Desenvolvedores
- **Nomes**: 
  - Gustavo Félix da Silva Camargo
  - Vinicius Ribeiro Lopes
- **Email's**: 
  - gustavofelix2007@gmail.com
  - vi1719nicius@gmail.com
- **LinkedIn's**:
  - https://www.linkedin.com/in/gustavo-camargo-70aa04214/
  - https://www.linkedin.com/in/vinicius-ribeiro-lopes-a34b34209/
- **GitHub's**:
  - https://github.com/Gustavo-Felix
  - https://github.com/ViniciusRibeiroLopes
---
