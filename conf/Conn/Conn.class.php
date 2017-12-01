<?php
abstract class Conn {
    private static $Host = HOST;
    private static $User = USER;
    private static $Pass = PASS;
    private static $Dbsa = DBSA;
    
    private static $Connect = null;
    
	//Conectar com banco de dados utilizando o PDO
    private static function Conectar() {
        try {
            if (self::$Connect == null):
                self::$Connect = new PDO('mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa, self::$User, self::$Pass);
            endif;
        } catch (PDOException $e) {
            echo 'Message: ' .$e->getMessage();
            die;
        }
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }    
    /** Retorna um objeto PDO Singleton Pattern. */
    protected static function getConn() {
        return self::Conectar();
    }
}
