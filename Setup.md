Instruções para execução do projeto:
1º Verificar se o projeto está conectado com o banco de dados complicadovet do seu banco de dados, através do arquivo config.php (linha 7: "dbname"=>complicadovet), caso não tenha com o banco de dados feito, ele está contido no projeto para ser executado (complicadovet.sql)
2º Criar também o banco de dados simplesvet que está contido no projeto (simplesvet.sql) no servidor, caso não tenha sido criado no seu banco de dados 
3º Atualizar o diretório da leitura de arquivos no arquivo processamento.php (linha 19), basta copiar o caminho até chega na pasta csvs, pois vai ser ali que ocorrerá a leitura dos csvs 
4º Ter o xampp ou outro programa que habilite o MySQL para ser executado no servidor local.


Execução:
1º Abrir a index.php no servido local , fazer o download tanto do arquivo animais.csv como de clientes.csv clicando nos respectivos botões da página.
2º Clicar no botão "escolher arquivos" para selecionar os dois arquivos que acabaram de serem gerados (localizados no diretório de downloads da máquina) para serem processados.
3º Após selecionado os arquivos, ele devem ser submetidos clicando no botão enviar, onde os dados vão ser processado de acordo as suas restrições e adicionado no banco de dados SimplesVet.
  No processamento, os arquivos que estão no diretório de download são importados para dentro do projeto na pasta csvs, assim permitindo que a leitura seja feita.
  Após o processamento, as informações que estavam no bd complicadovet, vão para o bd simplesvet que tem uma normativa mais organizada que a anterior. 
