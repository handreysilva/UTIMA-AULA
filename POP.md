# POP — Procedimento Operacional Padrão
## Implantação e operação local do Vitrine PDV

### 1. Objetivo
Padronizar a instalação, configuração, execução e verificação do Sistema PDV em ambiente local de desenvolvimento.

### 2. Pré-requisitos
- Windows 10/11 (ou ambiente equivalente).
- XAMPP com Apache, PHP 8+ e MySQL/MariaDB.
- Navegador atualizado.
- Git instalado (opcional, para versionamento).

### 3. Instalação
1. Copiar a pasta do projeto para o diretório `htdocs` do XAMPP.
2. Abrir o XAMPP Control Panel.
3. Iniciar os serviços Apache e MySQL.
4. Abrir `http://localhost/phpmyadmin/`.
5. Selecionar a aba SQL e executar `database/schema.sql`.
6. Abrir `config/database.php` e conferir host, banco, usuário e senha.
7. Abrir `http://localhost/sistema-pdv/` no navegador.

### 4. Operação
1. Acessar **Clientes** para cadastrar clientes, quando necessário.
2. Acessar **Produtos** para cadastrar produtos e informar preço e estoque inicial.
3. Acessar **Nova venda**, selecionar cliente (opcional), adicionar um ou mais produtos e quantidades.
4. Escolher a forma de pagamento e clicar em **Finalizar venda**.
5. Acessar **Relatórios** para consultar vendas e faturamento do dia.

### 5. Verificação
- A página inicial deve carregar sem erro de conexão.
- Os cadastros devem aparecer nas respectivas listagens.
- A venda deve aparecer no relatório.
- O estoque deve diminuir após uma venda concluída.
- Se faltar estoque, a operação deve ser cancelada sem gravar parcialmente a venda.

### 6. Solução de problemas
- **Erro de conexão:** verificar se MySQL está iniciado e conferir `config/database.php`.
- **Banco inexistente/tabela inexistente:** executar novamente `database/schema.sql` no banco correto.
- **Página não encontrada:** confirmar se a pasta está dentro do `htdocs` e se Apache está ativo.
- **Porta ocupada:** verificar conflito de portas do Apache/MySQL no XAMPP.

### 7. Publicação no GitHub
1. Criar repositório no GitHub.
2. Abrir terminal na pasta do projeto.
3. Executar `git init`, `git add .`, `git commit -m "Sistema PDV MVC"`.
4. Adicionar o endereço do repositório remoto e executar `git push -u origin main`.
5. Conferir se `README.md`, `POP.md`, `database/schema.sql` e as pastas do projeto foram enviados.

### 8. Segurança e encerramento
- Não enviar senhas reais ou dados pessoais para o repositório público.
- Em produção, usar HTTPS, autenticação, autorização por perfil, proteção CSRF, backups e logs.
- Ao terminar, encerrar o uso do sistema e desligar Apache/MySQL pelo XAMPP, se não forem mais necessários.
