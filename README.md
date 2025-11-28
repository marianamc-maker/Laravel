# Laravel
Esse é o trabalho final da disciplina de tópicos especiais.

# Sistema de Gerenciamento de Livros – Laravel

Projeto desenvolvido como trabalho final da disciplina **Tópicos Especiais I**.  
O sistema implementa um CRUD completo para gerenciamento de livros, utilizando o framework **Laravel 10**.

---

## Funcionalidades Implementadas

- ✔ Cadastro de livros  
- ✔ Edição de livros  
- ✔ Exclusão de livros  
- ✔ Listagem completa  
- ✔ Upload de imagem da capa (PNG/JPG)  
- ✔ Validação de dados (Requisito da APS)  
- ✔ Persistência usando banco de dados  
- ✔ Estrutura MVC utilizada corretamente  
- ✔ Sessões para mensagens de sucesso  
- ✔ Rotas RESTful com `Route::resource`  

---

## Tecnologias Utilizadas

- **PHP 8.1+**
- **Laravel 10**
- **SQLite** (para facilitar a execução sem instalação de drivers)
- Blade Templates  
- Bootstrap (opcional)

---

## Banco de Dados

O projeto utiliza **SQLite** por ser a opção mais simples, leve e compatível com qualquer ambiente (inclusive Codespaces).  
O arquivo do banco está em:

database/database.sqlite
Se o arquivo não existir, crie-o com o comando:

bash
Copiar código
touch database/database.sqlite
 Como Executar o Projeto
1️⃣ Instalar dependências
nginx
Copiar código
composer install
npm install
2️⃣ Criar e configurar o arquivo .env
Copie:

bash
Copiar código
cp .env.example .env
No .env, configure o SQLite:

ini
Copiar código
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
3️⃣ Gerar chave da aplicação
vbnet
Copiar código
php artisan key:generate
4️⃣ Criar as tabelas do banco
nginx
Copiar código
php artisan migrate
5️⃣ Iniciar o servidor Laravel
nginx
Copiar código
php artisan serve --host=0.0.0.0 --port=8000
 Como Acessar o CRUD (IMPORTANTE)
Toda a aplicação está acessível através da rota:

--> /books

Exemplos:

Localhost
bash
Copiar código
http://localhost:8000/books
GitHub Codespaces
arduino
Copiar código
https://SEU-CODESPACE-8000.app.github.dev/books