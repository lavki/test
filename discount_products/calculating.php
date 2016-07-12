<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Скидка на продукты</title>
        <link href="css/style.css" rel="stylesheet" />
    </head>

    <body>

<?php require_once 'discount.php'; ?>
      
        <header>
            <h1>Стоимость продуктов</h1>
        </header>
            
        <div class="container">
<?php

    /* =========================================================
     * Блок программы, обрабатывающая передачу даных,- 
     * какой продукт и его количество выбрал посетитеь магазина
     * ========================================================= */
     
    $selected  = $_POST['amount'];   // name and amount of the product
    $price     = $_POST['price'];    // price of the product
    $purchase  = array();            // array for each product
    $count     = 0;                  // how many is selected products
    $count_cat = 0;                  // how many products by name
    
    foreach($selected as $product => $amount) // importation of products in an array
    {
        if(!$amount) continue;      // if no iset the product
        
        $count    += $amount;
        $purchase[$product] = array('name'   => $product,
                                    'amount' => $amount);
    }
    
    foreach($price as $key => $value)
    {
        if(isset($purchase[$key])) $purchase[$key]['price'] = $value; // array is finished
    }
    
    $count_cat = count($purchase);
    
    /* =========================================================
     * Блок программы, определяющий правило действующих скидок в 
     * интернет магазине. 
     * Правила скидок не меняются.
     * Продукты, которые участвуют в скидках можно изменить
     * Также можно изменить процент скидок в переменной "$percent"
     * ========================================================= */
    
    /* =========================================================
     * ============= DISCOUNT FOR PRODUCNS A and B =============
     * =========================================================*/ 
    if(isset($purchase['A']) &&    isset($purchase['B']) && 
             $purchase['A']['amount'] == $purchase['B']['amount'] && 
             $count_cat == 2)
    {
        echo discount_together($purchase, $count_cat, $count, $percent = 0.10, $pair = TRUE);
    }
    
    /* =========================================================
     * ============= DISCOUNT FOR PRODUCNS D and E =============
     * =========================================================*/ 
    elseif(isset($purchase['D']) &&    isset($purchase['E']) && 
                 $purchase['D']['amount'] == $purchase['E']['amount'] &&
                 $count_cat == 2)
    {
        echo discount_together($purchase, $count_cat, $count, $percent = 0.05, $pair = TRUE);
    }

    /* =========================================================
     * ============ DISCOUNT FOR PRODUCNS E, F and G ===========
     * =========================================================*/ 
    elseif(isset($purchase['E']) &&    isset($purchase['F']) &&    isset($purchase['G']) &&
                 $purchase['E']['amount'] == $purchase['F']['amount'] && 
                                             $purchase['F']['amount'] == $purchase['G']['amount'] && 
                                             $count_cat == 3)
    {
        echo discount_together($purchase, $count_cat, $count, $percent = 0.05, $pair = FALSE);
    }

    /* =========================================================
     * DISCOUNT FOR PRODUCNS [A and K] or [A and L] or [A and M]
     * =========================================================*/
    elseif(isset($purchase['A']) &&    isset($purchase['K']) && 
                 $purchase['A']['amount'] == $purchase['K']['amount'] || 
           isset($purchase['A']) &&    isset($purchase['L']) && 
                 $purchase['A']['amount'] == $purchase['L']['amount'] || 
           isset($purchase['A']) &&    isset($purchase['M']) && 
                 $purchase['A']['amount'] == $purchase['M']['amount'])
    {
        switch($purchase)
        {
            case isset($purchase['K']): $prod = $purchase['K']; break;
            case isset($purchase['L']): $prod = $purchase['L']; break;
            case isset($purchase['M']): $prod = $purchase['M']; break;
        }
        
        if($count == 2) echo discount_for_pair($purchase['A'], $prod, $percent = 0.05, $pair = FALSE);
        else echo discount_together($purchase, $count_cat, $count, $percent = NULL);
    }

    /* =========================================================
     * ======== DISCOUNT FOR 3, 4 or 5 PRODUCNS TOGETHER =======
     * =========================================================*/
    else
    {
        if($count == 3     && !isset($purchase['A']) && !isset($purchase['C']))
            echo discount_together($purchase, $count_cat, $count, $percent = 0.05);
        
        elseif($count == 4 && !isset($purchase['A']) && !isset($purchase['C']))
            echo discount_together($purchase, $count_cat, $count, $percent = 0.10);
        
        elseif($count == 5 && !isset($purchase['A']) && !isset($purchase['C']))
            echo discount_together($purchase, $count_cat, $count, $percent = 0.20);
        
        else
            echo discount_together($purchase, $count_cat, $count, $percent = NULL);
    }

?>
        </div><!-- /.container -->
    </body>
</html>