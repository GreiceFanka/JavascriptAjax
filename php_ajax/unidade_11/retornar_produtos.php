<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("localhost","root","","mydata");

    if(isset($_GET['categoriaID'])) {
        $catID = $_GET['categoriaID'];
    } else {
        $catID = 1;
    }

    $selecao  = "SELECT produtoID, nomeproduto FROM produtos ";
    $selecao .= "WHERE categoriaID = {$catID}";
    $produtos = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($produtos)) {
        $retorno[] = $linha;
    } 	

    echo json_encode($retorno);
    
    // fechar conecta
    mysqli_close($conecta);
?>