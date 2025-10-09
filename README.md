## NOME DO PROJETO:

Sistema de Doações de Materiais Escolares

## 1- INTEGRANTES:

- Nome: André Luiz Oliveira Zampieri
    - RA: 14623
- Nome: Eduardo Henrique
    - RA: 14565
- Nome: Gabriel Henrique Friedrichsen
    - RA: 14552
- Nome: Hendreu Satoshi Itami Zampieri
    - RA: 240061
- Nome: Thiago Vinicius Santos da Silva
    - RA: 240055

## 2- OBJETIVO DO SISTEMA:

   O principal objetivo do sistema é cadastrar instituições de ensino (escolas, faculdades, universidades etc.), além do cadastro de estudantes e materiais escolares, que permitem o controle de estoque e o registro de doações, para melhor organização de instituições colaboradoras e entidades que necessitam de doações. Tendo como público-alvo estudante de baixa renda, que poderão receber doações por meio das instituições cadastradas.

   Ao se cadastrar, a instituição ou o aluno, poderão escolher entre ser um colaborador ou receptor, caso escolha ser um colaborador, definirá um ponto para coletar as doações, e para distribui-las á alunos que  já se cadastraram no site.

   No site, os internautas poderão visualizar instituições colaboradoras e os pontos de coleta e doação. Já os administradores terão acesso a todas doações e a todos beneficiados, além de uma lista dos cadastros realizados na plataforma, podendo gerenciar estoques e destinar a outras instituições mais necessitadas.

## 3- FUNCIONALIDADES PRINCIPAIS:

### CADASTRO DE INTITUICAO

Permitir o registro da instituição com os campos **nome, CNPJ/CPF, telefone, endereço, e-mail e senha**.

Também será possível cadastrar **estudantes vinculados à instituição**, armazenando informações como **nome, CPF, idade/série e e-mail**.

### AUTENTICACOS (LOGIN)

O sistema contará com uma tela de login para **instituições**, utilizando e-mail/CPF/CNPJ e senha, e outra tela para **estudantes** vinculados a uma instituição.

Haverá opção de **recuperação de senha por e-mail**.

O acesso será validado de acordo com **níveis de permissão diferentes**: administrador do site, administrador da instituição e estudante.

### CADASTRO DE ITENS EM ESTOQUE

O sistema permitirá o cadastro de materiais escolares, como **cadernos, mochilas, lápis, canetas, borrachas, réguas, livros** etc., com os campos **nome, descrição e quantidade**.

Somente administradores do site e da instituição poderão **adicionar, editar ou remover** materiais.

### REGISTRO DE DOACOES

As doações poderão ser registradas pela instituição através da seleção de um estudante, escolha do material e definição da quantidade.

Apenas administradores do site e da instituição terão permissão para registrar doações.

### RELATORIOS/LISTAGENS

**Listagem de estudantes beneficiados**, vinculando-os às doações recebidas.

Relatórios detalhados por:

- **Instituição:** histórico de doações realizadas.
- **Estudante:** itens recebidos e quantidade total.
- **Material:** quais materiais foram doados e em quais quantidades.

Exportação de relatórios em **PDF**.

## 4- MODELO DE DADOS

tirar o tipo institucional

refazer o banco, está confuso 

![image.png](attachment:f66af622-1283-47da-b37e-e411dcccad91:image.png)

- Esquema escrito
    
    O modelo de dados foi estruturado para gerenciar as doações de materiais escolares e doações financeiras. Ele contempla as entidades principais do sistema, seus atributos e os relacionamentos entre elas:
    
    - **Usuário**: representa todos os tipos de usuários do sistema (pessoas doadoras, instituições doadoras, pessoas recebedoras, instituições recebedoras e administradores). Cada usuário possui informações como nome, email, telefone e tipo de usuário.
    - **Instituição**: armazena os dados das instituições parceiras, podendo ser coletoras ou receptoras de doações. Uma instituição está sempre vinculada a um usuário responsável.
    - **Ponto de Coleta**: representa os locais físicos onde podem ser entregues os materiais, sempre associados a uma instituição.
    - **Material**: controla os itens de material escolar cadastrados no sistema (caderno, lápis, mochila etc.), com quantidade em estoque.
    - **Doação**: centraliza os registros de doações realizadas, podendo ser doação de materiais ou doação em dinheiro. Possui atributos como tipo de doação, data e status.
    - **Itens de Doação**: detalha os materiais incluídos em uma doação do tipo material, vinculando quantidade e tipo de item.
    - **Registro Financeiro**: usado para controlar as doações financeiras, armazenando o valor, forma de pagamento e comprovante, quando necessário.
    
    Os relacionamentos seguem a lógica do negócio:
    
    - Um usuário pode estar vinculado a várias instituições.
    - Um usuário pode realizar várias doações.
    - Cada doação pode conter múltiplos itens de materiais ou um registro financeiro.
    - Uma instituição pode ter vários pontos de coleta.
    
    Esse modelo garante flexibilidade ao sistema, permitindo registrar tanto doações em materiais, que afetam o estoque, quanto doações em dinheiro, que são registradas de forma financeira.
    

## 5- PROTOTIPO DAS TELAS

### TELA DE CADASTRO (Instituição e Estudante)

- Campos: nome, cpf/cnpj, telefone, endereco, email, senha + botão “Cadastrar”.

### TELA DE LOGIN (Instituição e Estudante)

- Campos: email ou cpf/cnpj, senha + botão “Entrar”.

Ao realizar o login pegar do banco de dados o ID para ver se é  admin do site/app, admin da instituição ou estudante

### DESHBOARD

ADMIN DO SITE:

- Menu lateral com opções: “perfil”, “Instituições”, "relatórios”.

perfil: poderá colocar foto, edita nome, email, telefone

Instituições: ira aparecer todas Instituições cadastradas no site/app.

Ao escolher a instituição, poderá ver quantos alunos tem cadastrado na instituição, materiais que a instituição possui cadastrada e quantidade  e também quais alunos receberam as doações e quantidades

ADMIN DA INSTITUICAO:

- Menu lateral com opções: “perfil”, “Estudantes”, “Materiais”, “Doações”, "relatórios”.

perfil: poderá colocar foto, edita nome, email, telefone

estudantes: poderá ver quantos alunos tem cadastrado na instituição, ao escolher estudante poderá ver se já solicitou a doação e também quais materiais

materiais: poderá ver oque a oque e a quantidade de materiais que ja foram doadas totais

doações: poderão ver as solicitações de doação

ESTUDANTE:

- Menu lateral com opções: “perfil”,  “Materiais”, “solicitar Doações”, “relatórios”.

perfil: poderá colocar foto, edita nome, email, telefone

Materiais: poderá ver os status dos materiais que já foi solicitado , se esta em transporte e aprovado ou cancelado

solicitar doação: onde ele ira solicitar os materiais

### TELA DE CADASTRO DE ITEM (Material Escolar)

Formulário com: nome, descrição, quantidade, botão “Salvar”

Apenas admin do site, admin da instituição poderá cadastrar/editar/remover os materiais

### TELA DE REGISTRO DE DOACAO

Selecionar estudante → escolher material → definir quantidade → endereço de destino → data prevista de entrega → botão “Registrar Doação”.

Apenas admin do site, admin da instituição poderá registrar/editar/remover os materiais

### LINK DAS TELAS PROTOTIPOS

https://www.figma.com/design/cTUWSW2QDmhDDQwwvYXPsg/Trabalho-Pojeto-de-Extens%C3%A3o---1%C2%B0-Bi?node-id=0-1&t=wmF3bcLeMOYF3hbc-1

![Captura de Tela 2025-09-14 às 18.06.09.png](attachment:eb64af1c-0010-40d2-8d91-ba5af4e121ea:Captura_de_Tela_2025-09-14_as_18.06.09.png)

## 6- FLUXO DO SISTEMA

### 6.1) Usuário acessa o sistema e realiza login (Instituição ou Estudante).

### 6.2) Ao logar como Instituição:

- Acessa dashboard.
- Cadastrar materiais no estoque.
- Registra doações para estudantes vinculados.
- Gera relatórios.

### 6.3) Ao logar como Estudante:

- Consulta seus dados e histórico de doações.
