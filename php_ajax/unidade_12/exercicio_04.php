<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com AJAX</title>
    </head>

    <body>

        <script src="_js/jquery.js"></script>
        <script>
            $.ajax({
                type:"GET",
                url:"http://api.openweathermap.org/data/2.5/weather?q=Warsaw&appid=011ddaadb976311b9bf54f963b6573f1",
                async:false
            }).done(function(data){
                console.log(data.main);
            }).fail(function(){
                console.log("Falha.");
            });
        </script>
    </body>
</html>