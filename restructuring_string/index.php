<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Перестройка предложения</title>
        <link href="css/style.css" rel="stylesheet" />
    </head>

    <body>


        <header>
            <h1>Перестройка предложения</h1>
        </header>
            
        <div class="container">
        
<?php include_once 'test_string.php'; 

    echo '<p><b>' . $shuffle_words[0][0] . '</b> сделайте так, чтобы это <b>' 
                  . $shuffle_words[1][0] . '</b> тестовое предложение изменялось <b>' 
                  . $shuffle_words[2][0] . '</b>.</p>';
?>
            
        
        </div><!-- /.container -->

    </body>
</html>