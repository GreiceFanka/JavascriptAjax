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
                    <input type="text" value="" name="nometransportadora" id="nometransportadora">
                    
                    <label for="cep">CEP (ex: 58000-100)</label>
                    <input type="text" value="" name="cep" id="cep" maxlength="9">
                    
                    <label for="endereco">Endereço</label>
                    <input type="text" value="" name="endereco" id="endereco">

                    <label for="cidade">Cidade</label>
                    <input type="text" value="" name="cidade" id="cidade">

                    <label for="estado">Estado</label>
                    <input type="text" value="" name="estado" id="estado">

                    <label for="bairro">Bairro</label>
                    <input type="text" value="" name="bairro" id="bairro">
                    
                    <input type="submit" value="Confirmar alteração">  
                    
                    <div id="mensagem">
                        <p></p>
                    </div>
                </form> 
                
            </div>
        </main>
        
        <script src="_js/jquery.js"></script>
        <script>
            $('#cep').blur(function(e){
                var cep = $('#cep').val();
                var url = "http://viacep.com.br/ws/" + cep + "/json";
                var validacep = /^[0-9]{5}-?[0-9]{3}$/;
                
                if(validacep.test(cep)){
                    $('#mensagem').hide();
                    pesquisarCep(url);
                }else{
                    $('#mensagem').show();
                    $('#mensagem p').html("CEP inválido.");
                }
            });
            
            function pesquisarCep(endereco){
                $.ajax({
                    type:"GET",
                    url:endereco,
                    async:false
                }).done(function(data){
                    $('#bairro').val(data.bairro);
                    $('#endereco').val(data.logradouro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                }).fail(function(){
                    console.log("Erro");
                });
            }
        </script>
    </body>
</html>