<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Скидка на продукты - тестовое задание</title>
        <link href="css/style.css" rel="stylesheet" />
    </head>

    <body>

        <header>
            <h1>Скидка на продукты</h1>
        </header>
            
        <div class="container">
            <form action="calculating.php" method="post">

                <?php require_once 'products.php';

                foreach ($products as $product)
                {
                    echo '<div class="product">
                            <h2>' . $product['name']  . '</h2>
                            <p>₴ ' . $product['price'] . '</p>
                            <p><input type="number" name="amount[' . $product['name'] . ']" min="0" max="10" /></p>
                            <input type="hidden" name="price[' . $product['name'] . ']" value="' . $product['price'] . '" />
                          </div><!-- /.product -->';
                }
                ?>

                <div class="clearfix"></div>
                
                <button type="submit" class="btn btn-primary btn-lg pull-right">
                    Расчитать итоговую сумму
                </button>
            </form>
        </div><!-- /.container -->

    </body>
</html>