<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com AJAX</title>
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <button id="botao">Carregar JSON</button>
        <div id="listagem"></div>
        <script src="jquery.js"></script>
        <script>
            $('button#botao').click(function(){
               $('div#listagem').css('display','block');
                carregarDados();
            });
            function carregarDados(){
                $.getJSON('_json/produtos.json', function(arquivo){
                    var elemento;
                    elemento = "<ul>";

                   $.each(arquivo,function(i,valor){
                       elemento +="<li class='nome'>" + valor.nomeproduto + "</li>";
                       elemento +="<li class='preco'>" + valor.precounitario + "</li>";
                   });
                    elemento += "</ul>";

                    $('div#listagem').html(elemento);
                });
        }

        </script>
    </body>
</html>