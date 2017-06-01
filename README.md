# abacate.Senai-php
Trabalho em PHP do Senai - BA para criação de um sistema Web básico com o intuito de reforçar no aprendizado de HTML/CSS/PHP

/*questão do problema*/
Uma empresa de engenharia elétrica precisa de um software para auxiliar no cálculo de pontos de iluminação e tomadas de residências. Considerando a planta baixa anexada a essa atividade, desenvolva o algoritmo necessário para atender a necessidade do cliente.

A aplicação deverá solicitar os seguintes dados:

• Número de Cômodos

• Área e perímetro de cada cômodo

• Identificação do cômodo

• Tomadas de uso específico (Ferro de Passar, Chuveiro, Máquina de Lavar, Micro-Ondas, Ar condicionados) — Especificar quantidade e item. Usar a tabela de potências em anexo.

Após a inserção dos dados a aplicação deverá retornar as seguintes informações:

• Quantidade de tomadas por cômodo

• Potência de tomadas por Cômodo

• Potência de iluminação por Cômodo

• Potência total de uso específico

• Potência total instalada na residência

Obs: Para a realização dos cálculos considerar as seguintes instruções:

Tomadas:

a) Em banheiros, deve ser previsto pelo menos um ponto de tomada, próximo ao lavatório

b) Em cozinhas, copas, copas-cozinhas, áreas de serviço, cozinha-área de serviço, lavanderias e locais análogos, deve ser previsto no mínimo um ponto de tomada para cada 3,5 m, ou fração, de perímetro.

c) Em salas e dormitórios devem ser previstos pelo menos um ponto de tomada para cada 5 m, ou fração, de perímetro.

d) As 3 primeiras tomadas da cozinha, banheiros e área de serviço devem ser de 600VA, as demais tomadas podem ser de 100VA e para as tomadas específicas seguir a tabela em anexo.

e) O cálculo de tomas é medido por perímetro.

Iluminação:

a) O cálculo de iluminação é medido por area do cômodo

b) Os 6 primeiros m² recebe 100VA de potência e a cada 4m² restante, acrescenta-se 60VA. Caso não complete os 4m² é desconsiderado o valor restante;

c) Caso a área não complete os 6m², considerar 100VA.

TABELA DE PONTOS ESPECÍFICOS

DESCRIÇÃO/POTENCIA

Chuveiro/4.4KVA

Ferro de Passar/1.2KVA

Ar condicionado/2.5KVA

Máquina de Lavar/1KVA

Microondas/2KVA
