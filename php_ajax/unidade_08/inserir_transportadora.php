  <?php
    $conecta = mysqli_connect("localhost","root","","mydata");
    if ( mysqli_connect_errno()  ) {
        die("Conexao falhou: " . mysqli_connect_errno());
    }

    if(isset($_POST["nometransportadora"])) {
        $nome       = utf8_decode($_POST["nometransportadora"]);
        $endereco   = utf8_decode($_POST["endereco"]);
        $cidade     = utf8_decode($_POST["cidade"]);
        $estado     = $_POST["estados"];
        
        $inserir     = "INSERT INTO transportadoras ";
        $inserir    .= "(nometransportadora,endereco,cidade,estadoID) ";
        $inserir    .= "VALUES ";
        $inserir    .= "('$nome','$endereco','$cidade', $estado)"; 
        
        $retorno = array();
        $operacao_insercao = mysqli_query($conecta,$inserir);
        if($operacao_insercao){
            $retorno["Sucesso"] = true;
            $retorno["mensagem"] = "Transportadora inserida com sucesso.";
        }else{
            $retorno["Falha"] = false;
            $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
        }
        echo json_encode($retorno);
    }
?>