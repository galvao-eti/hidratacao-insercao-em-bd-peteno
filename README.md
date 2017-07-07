# hidratacao-insercao-em-bd-peteno

- Aluno: Rodrigo Cezar Peteno
- E-mail: rodrigopeteno@gmail.com

# Objetivo
1. Objetivo: Criar uma trait de hidratação que possa ser usada em qualquer classe
2. Demonstrar o uso dessa trait salvando um objeto usuario e um objeto produto na base de dados. Isso significa que o seu trabalho final deverá ter 2 classes (Usuario e Produto) e uma Trait.

# Conceito

Hidratação é o processo de receber uma estrutura de dados (tipicamente um array) e utilizá-la para inserir valores em um objeto. A principal dica é de que haja uma relação entre o array de dados e os objetos, ou seja, cada índice do array corresponda ao nome de um atributo do objeto.

# Instruções

- Faça o clone do repositório.
- Faça o composer install.
- Altere o arquivo 'config.json' que se encontra na raiz do projeto para os dados da sua conexão do seu banco:
```json
{
    "user": "NOME DE USUARIO",
    "pass": "SENHA DO BANCO DE DADOS",
    "dbase": "NOME DO BANCO",
    "host": "HOST",
    "port": PORTA
}
```