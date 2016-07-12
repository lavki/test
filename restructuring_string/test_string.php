<?php

    // array with words
    $test_string = array(
        array('Пожалуйста',   'Просто'),
        array('удивительное', 'крутое',    'простое'),
        array('быстро',       'мгновенно', 'случайным образом', 'каждый раз')
    );
    
    
    // shuffle the words
    $count_up      = count($test_string);
    $shuffle_words = array();
    
    for($i = 0; $i < $count_up; $i++)
    {
        $shuffle           = shuffle($test_string[$i]);
        $shuffle_words[$i] = $test_string[$i];
    }

?>