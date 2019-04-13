<?php
    // Criar objeto de conexao
    $conecta = mysqli_connect("localhost","root","","mydata");
    if ( mysqli_connect_errno()  ) {
        die("Conexao falhou: " . mysqli_connect_errno());
    }

    // Consulta a tabela de transportadoras
    $tr = "SELECT * FROM transportadoras ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $tr .= "WHERE transportadoraID = {$id} ";
    } else {
        $tr .= "WHERE transportadoraID = 1 ";
    }

    // cria objeto com dados da transportadora
    $con_transportadora = mysqli_query($conecta,$tr);
    if(!$con_transportadora) {
        die("Erro na consulta");
    }
    $info_transportadora = mysqli_fetch_assoc($con_transportadora);

    // consulta aos estados
    $estados = "SELECT * ";
    $estados .= "FROM estados ";
    $lista_estados = mysqli_query($conecta, $estados);
    if(!$lista_estados) {
       die("erro no banco"); 
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com AJAX</title> 
        
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <main>  
            <div id="janela_formulario">
                
                <form id="formulario_transportadora">
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["nometransportadora"])  ?>" name="nometransportadora" id="nometransportadora">

                    <label for="endereco">Endereço</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["endereco"])  ?>" name="endereco" id="endereco">

                    <label for="cidade">Cidade</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["cidade"])  ?>" name="cidade" id="cidade">

                    <label for="estados">Estados</label>
                    <select id="estados" name="estados"> 
                        <?php 
                            $meuestado = $info_transportadora["estadoID"];
                            while($linha = mysqli_fetch_assoc($lista_estados)) {
                                $estado_principal = $linha["estadoID"];
                                if($meuestado == $estado_principal) {
                        ?>
                            <option value="<?php echo $linha["estadoID"] ?>" selected>
                                <?php echo utf8_encode($linha["nome"]) ?>
                            </option>
                        <?php
                                } else {
                        ?>
                            <option value="<?php echo $linha["estadoID"] ?>" >
                                <?php echo utf8_encode($linha["nome"]) ?>
                            </option>                        
                        <?php 
                                }
                            }
                        ?>
                    </select>
                    
                    <input type="hidden" name="transportadoraID" value="<?php echo $info_transportadora["transportadoraID"] ?>">
                    <input type="submit" value="Confirmar alteração">  
                    
                    <div id="mensagem">
                        <p></p>
                    </div>
                </form> 
                
            </div>
        </main>
        
        <script src="jquery.js"></script>
        <script>
            $('#formulario_transportadora').submit(function(e) {
                e.preventDefault();
                var formulario = $(this);
                var retorno = alterarFormulario(formulario)
            });
            
            function alterarFormulario(dados) {
                $.ajax({
                    type:"POST",
                    data:dados.serialize(),
                    url:"alterar_transportadora.php",
                    async:false
                }).done(function(data){
                    $sucesso = $.parseJSON(data)["sucesso"];
                    $mensagem = $.parseJSON(data)["mensagem"];
                    
                    if($sucesso){
                        $('#mensagem p').html($mensagem);
                    }else{
                        $('#mensagem p').html($mensagem); 
                    }
                }).fail(function(){
                     $('#mensagem p').html("Erro no sistema, tente mais tarde.");
                }).always(function(){
                     $('#mensagem').show();
                });
            }
        </script>
    </body>
</html>