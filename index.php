<!DOCTYPE html>
<html>
  <head>
    <title>Upload de arquivo</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
      html, body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      }
      body, div, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #666;
      }
      body {
      background-image: url("C:/xampp/htdocs/desafio-php-2021/simplesvet-DER.png") no-repeat center;
      background-size:cover;
      }
      h1 {
      margin: 0 0 10px 0;
      font-weight: 400;
      }
      .main-block {
      display: flex;
      width: 70%;
      padding: 10px 0; 
      border-radius: 5px;
      box-shadow: 1px 1px 8px 0px #666; 
      background: #fff;
      }
      .block-item {
      width: 50%;
      padding: 20px; 
      }
      .block-item.right {
      border-left: 1px solid #aaa;
      }
      .btn {
      display: flex;
      align-items: center;
      width: 50%;
      height: 40px;
      margin: 10px 0;
      outline: none;
      border: 0;
      border-radius: 5px;
      box-shadow: 2px 2px 2px #666;
      background: #e8e8e8;
      color: #fff;
      cursor: pointer;
      }
      .btn:hover {
      transform: scale(1.03);
      }
      .azul {
      background: #3a589e;
      font-size:18px;
      
      }
      .azul-claro {
      background: #429cd6;
      font-size:18px;
      }
      #inline {
    display: inline;
    }
    </style>
  </head>
  <body>
    <div class="main-block">
      <div class="block-item left" align="justify" >
        <h1>Gerador de CSV SimplesVet</h1>
        <p>Geração de dois arquivos .csv (Clientes.csv e Animais.csv) em PHP para armazenar os dados que estão no banco de dados ComplicadoVet e o upload desses dois arquivos gerados para ser adicionado no banco de dados SimplesVet.
        </p>
      </div>
      <div class="block-item right">
        <form enctype="multipart/form-data" method="POST" action="processamento.php">
			<input type="file" name="arquivo[]" multiple="multiple" /> <br>
			<input class="btn azul" name="enviar" type="submit" value="Enviar">
		</form>
        <form method="post" action="animaisCSV.php">  
            <input class="btn azul-claro" type="submit" name="export" value="Animais.csv" class="btn btn-primary" />  
        </form>  
        <form method="post" action="clientesCSV.php">  
            <input class="btn azul-claro" type="submit" name="export" value="Clientes.csv" class="btn btn-info" />  
        </form> 
      </div>
    </div>
  </body>
</html>