<?php
class Manager 
{
    private static $pdo = null;
    protected $login;
    protected $mdp;
    protected $bd;
    protected $serveur;

    /**
     * Constructeur de la classe Manager
     */
    public function __construct() {
        $this->login = $_ENV["login"];
        $this->mdp = $_ENV["mdp"];
        $this->bd = $_ENV["bdd"];
        $this->serveur = $_ENV["serveur"];
    }

    /**
     * Connexion à la base de données, retourne l'objet PDO
     *
     * @return PDO
     */
    protected function dbConnect() : PDO
    {
        try
        {
            $conn = new PDO("mysql:host=$this->serveur;dbname=$this->bd", $this->login, $this->mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } 
        catch (PDOException $e) 
        {
            print "Erreur de connexion PDO ";
            die();
        }
    }
    
    /**
     * Retourne l'objet PDO de connexion à la base de données, le crée si il n'existe pas
     *
     * @return PDO
     */
    protected function getPDO() : PDO
        {
            
            if (!self::$pdo) {
                self::$pdo = $this->dbConnect();
            }
            return self::$pdo;
        }
    }
?>
