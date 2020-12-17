Sistema de Gerenciamento do Viveiro de Mudas SGV – IFMG/SJE
<br>
O SGV realiza controle básico de todas os processos executados no viveiro, iniciando-se no plantio das mudas até a venda das mesmas. Além disso, através deste, se têm um acompanhamento real da localização das mudas dentro do viveiro.
 Para desenvolvimento desta aplicação foram usadas as seguintes tecnologias:
- Framework Laravel: Em busca deixar o visual mais agradável, fora utilizado o framework laravel. Este framework utiliza a linguagem base PHP. Em complemento visual, fora utilizado também o HTML, CSS e JS;
- Banco de Dados MySql: O SGBD utilizado foi o MySQL. Todos os s estão disponíveis nos migrations do código. Obs.: Será necessário rodar os comandos Seeders também, visto a necessidade dos primeiros registros na aplicação
- Docker: Para virtualização do sistema fora utilizado a tecnologia Docker. Para funcionamento do sistema os seguintes containers têm de ser executados: 
1)	NGINX
2)	MySql
3)	PHPMyAdmin
