<?php

class View{
    private static $Data;
    private static $Keys;
    Private static $Values;
    private static $Template;
    
    /**Carregar a template da view*/
    public static function Load($Template) {
        self::$Template = (string) $Template;
        self::$Template = file_get_contents(self::$Template . '.tpl.html');
    }
    
    /**Exibir Templade View*/
    public static function Show(array $Data) {
        self::setKeys($Data);
        self::setValues();
        self::showView();
    }
    
    /**Executar o tratamento dos campos para subtituição de chaves na view*/    
    public static function setKeys($Data) {
        self::$Data = $Data;
        self::$Keys = explode( '&', '#' . implode("#&#", array_keys(self::$Data)) . '#');
    }
    
    /** obtem os valores a serem inserido nas chaves*/
    public static function setValues() {
        self::$Values = array_values(self::$Data);
    }
    
    /** */
    public static function showView() {
        echo str_replace(self::$Keys, self::$Values, self::$Template);
    }
    
}