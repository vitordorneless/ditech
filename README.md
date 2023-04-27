# Desafio_Tecnico

O desafio técnico para desenvolvedor consiste em duas etapas:
Primeira Etapa
Desenvolva em PHP, um sistema que resolva o seguinte problema:
Devido ao grande fluxo de funcionários de uma empresa, foi identificado a
necessidade de um sistema de fila virtual para uso de salas de reuniões.
Este sistema deve obedecer os seguintes requisitos:
● Possuir cadastro de usuários (crud)
● Possuir cadastro de salas (crud)
● Login de usuários
● O sistema deve possuir uma interface em html.
● Reserva de salas por usuários
○ Após logado, usuário poderá efetuar reserva de salas.
○ Deverá possuir uma visualização de todas as salas e os horários vagos e
ocupados.
○ Um usuário não pode reservar mais de 1 sala no mesmo período
○ 1 sala não pode estar reservado por mais de 1 usuário no mesmo período,
simultaneamente.
○ As reservas de salas tem duração de 1 hora, ou seja, posso reservar a sala
as 14:00, e ela estará “bloqueada” para reserva até o próximo horário 15:00.
○ Deverá ser possível a remoção da reserva de uma sala apenas pelo próprio
reservante.
O sistema deverá ser versionado no gitlab.com ou github.com, com commits frequentes e
explicativos. Deverá possuir um dump do banco de dados versionado dentro do arquivo
dump/init.sql de seu projeto, para que possa ser implementado e testado em um servidor local
Instruções
1. Você deverá desenvolver um sistema em PHP que resolva o problema descrito no
PDF em anexo;
2. O sistema deverá ser versionado no ​gitlab.com ​ ou ​github.com