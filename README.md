# TodoList Laravel Application

## Descrição

Aplicação simples de gerenciamento de tarefas (todos) construída em Laravel.  
Permite criar, listar, editar, filtrar por status, visualizar detalhes, deletar (soft delete) e associar tarefas a usuários autenticados.

Autenticação feita com Laravel Breeze para simplicidade e recursos modernos.

---

## Instruções para rodar localmente

### Requisitos

- PHP >= 8.x
- Composer
- MySQL (ou outro banco compatível)
- Node.js e npm (para assets, se aplicável)

### Passos para instalação

1. Clone o repositório:
```bash
git clone https://github.com/seuusuario/seurepositorio.git
cd seurepositorio
```

2. Instale as dependências PHP:
```bash
composer install
```

3. Copie o arquivo de ambiente e configure as variáveis:
```bash
cp .env.example .env
```
- Edite .env para configurar o banco de dados, por exemplo:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```
4. Rode as migrations para criar as tabelas no banco (incluindo as do Breeze):
```bash
php artisan migrate
```

5. (Opcional) Rode o seeder, se houver dados iniciais:
```bash
php artisan db:seed
```

6. Inicie o servidor local:
```bash
php artisan serve
```

### Decisões tomadas e melhorias futuras

- Uso de Laravel Breeze para autenticação simples e rápida.

- Implementação de soft deletes para permitir recuperação de tarefas excluídas.

- Relacionamento entre usuário e tarefas: um usuário pode ter várias tarefas (1:N).

- Filtragem por status para melhor organização.

- Datas exibidas no formato brasileiro (pt_BR).

- A autenticação vincula automaticamente as tarefas ao usuário logado.

### Melhorias futuras possíveis:

- Adicionar autorização mais fina para garantir que usuários manipulem somente suas tarefas.

- Melhorar a interface com feedbacks visuais e notificações.

- Implementar busca e ordenação avançadas.
