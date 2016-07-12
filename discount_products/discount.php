<?php

// When you buy together two products - a discount of 5% or 10%
/* ============================================================
 * Функция относится толькко к парным продуктам
 * ============================================================*/
function discount_for_pair($var1, $var2, $percent, $pair)
{
    $amount   = $var1['amount'] + $var2['amount'];
    $total    = ($var1['price'] + $var2['price']) * $var1['amount']; // total price
    $discount = $total - ($total * $percent);                        // minus % form total price
        
    if($pair == FALSE)
    {
        $pair_or_not  = 'При покупке этих ' . $amount . ' продуктов действует скидка - 
                        ' . $percent . '%.<br />';
    }
    
    else
    {
        $pair_or_not  = 'При покупке этих ' . $amount . ' продуктов действует скидка - 
                        ' . $percent . '% (для каждой пары).<br />';
    }
    
    $message  = '<p>Выбран продукт ' . $var1['name'] . ' (' . $var1['amount'] . ' шт.) 
                 и продукт '         . $var2['name'] . ' (' . $var1['amount'] . ' шт.)<br />
                 ' . $pair_or_not . '
                 Всего продуктов: ' . $amount . '.</p>
                 <p>К оплате: <br />
                 <strike>₴ ' . $total    . '</strike> <br />
                 <strong>₴ ' . $discount . '</strong></p>';

    return $message;
}

// When you buy more then two products together and less then 6 - a discount of 5%, 10% or 20%;
function discount_together($data, $count_cat, $count, $percent, $pair = NULL) 
{
    $total = 0;
    $name  = '';
    $amount = $count;
    
    function answer($name, $amount, $total, $discount, $percent, $pair = NULL)
    {   
        if($percent == NULL)
        {
            $answer = '<p>Выбран продукт: ' . $name . '<br />
                      Всего продуктов: ' . $amount . '.</p>
                      <p>К оплате: <br />
                      <strong>₴ ' . $total    . '</strong></p>';
        }
        else
        {
            if($pair === TRUE)
            {
                $answer = '<p>Выбран продукт: ' . $name . '<br />
                      При покупке этих 2-х продуктов действует скидка - ' . $percent . '% (для каждой пары).<br />
                      Всего продуктов: ' . $amount . '.</p>
                      <p>К оплате: <br />
                      <strike>₴ ' . $total    . '</strike> <br />
                      <strong>₴ ' . $discount . '</strong></p>';
            }
            
            elseif($pair === FALSE)
            {
                $answer = '<p>Выбран продукт: ' . $name . '<br />
                      При покупке этих 3-х продуктов действует скидка - ' . $percent . '% (для каждой тройки).<br />
                      Всего продуктов: ' . $amount . '.</p>
                      <p>К оплате: <br />
                      <strike>₴ ' . $total    . '</strike> <br />
                      <strong>₴ ' . $discount . '</strong></p>';
            }
            
            else
            {
                $answer = '<p>Выбран продукт: ' . $name . '<br />
                      При покупке этих ' . $amount . ' продуктов действует скидка - ' . $percent . '%.<br />
                      Всего продуктов: ' . $amount . '.</p>
                      <p>К оплате: <br />
                      <strike>₴ ' . $total    . '</strike> <br />
                      <strong>₴ ' . $discount . '</strong></p>';
            }
        }
        
        return $answer;
    }
    
    if($percent == NULL)
    {
        foreach($data as $key => $value)
        {
            $total += $value['amount'] * $value['price'];
            $name  .= $value['name'] . ' ( ' . $value['amount'] . ' шт.), ';
            
        }
        
        $message = answer($name, $amount, $total, $discount = NULL, $percent);
    }
    
    else
    {
        if($count_cat == 1)
        {
            foreach($data as $key => $value)
            {
                $total = $value['amount'] * $value['price'];
                $name  .= $value['name'] . ' ( ' . $value['amount'] . ' шт.), ';
            }
            
            $discount = $total - ($total * $percent);
            $message  = answer($name, $amount, $total, $discount, $percent);
        }
        
        if($count_cat > 1 && $count_cat < 6)
        {
            if($pair == TRUE)
            {
                foreach($data as $key => $value)
                {
                    $total += $value['amount'] * $value['price'];
                    $name  .= $value['name'] . ' ( ' . $value['amount'] . ' шт.), '; 
                }
                
                $discount = $total - ($total * $percent);
                $message  = answer($name, $amount, $total, $discount, $percent, $pair);
            }
            
            elseif($pair == FALSE)
            {
                foreach($data as $key => $value)
                {
                    $total += $value['amount'] * $value['price'];
                    $name  .= $value['name'] . ' ( ' . $value['amount'] . ' шт.), '; 
                }
                
                $discount = $total - ($total * $percent);
                $message  = answer($name, $amount, $total, $discount, $percent, $pair);
            }
            
            else
            {
                foreach($data as $key => $value)
                {
                    $total += $value['amount'] * $value['price'];
                    $name  .= $value['name'] . ' ( ' . $value['amount'] . ' шт.), '; 
                }
                
                $discount = $total - ($total * $percent);
                $message  = answer($name, $amount, $total, $discount, $percent);
            }
        }
    }
    
    return $message;
}

?>