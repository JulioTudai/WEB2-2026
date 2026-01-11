<?php

class ConfigApp{
    public static $ACTION ='action';
    public static $PARAMS ='params';
    public static $ACTIONS =[
        // url => nombre de la funcion
        '' => 'showTabla', //por defecto si viene vacio mostramos tabla
        'tabla' =>'showTabla',
        'about' => 'showAbout'
    ];
}

?>