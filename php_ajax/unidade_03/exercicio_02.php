<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com AJAX</title>
    </head>

    <body>
        <div id="nome"></div> 

        <script src="jquery.js"></script>
        <script>
            $.ajax({
                url:'nome.php'
            }).then(sucesso,falha);
            
            function sucesso(valor){
                $('div#nome').html(valor);
            }
            function falha(){
                $('div#nome').html("Falha no carregamento");
            }

        </script>
    </body>
</html>