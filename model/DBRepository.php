<?php
    class DBRepository
    {
        // Attributs
        private $host;

        private $dbname;

        private $user;

        private $password;

        protected $db;

        public function __construct()
        {
            $this->host = getenv('DB_HOST') ?: "localhost";
            $this->dbname = getenv('DB_NAME')?: "sunu_etudiants";
            $this->user = getenv('DB_USER')?: "root";
            $this->password = getenv('DB_PASSWORD') ?: ""; 
            $this->getConnexion();
            // Test rapide
            //var_dump("Connexion OK avec la DB : " . $this->dbname);
        }

        // Cette méthode permet de se connecter a la BD
        private function getConnexion()
        {
            $dsn = "mysql:host={$this->host}; dbname={$this->dbname}";
            try {
                $this->db = new PDO($dsn,$this->user,$this->password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $error) {
                $this->handleError($error);
            }

            return $this->db;
        }

        private function handleError(PDOException $error)
        {
            error_log("Erreur de connexion a la BD" . $error->getMessage());
            die("Une erreur est survenue lors de la connexion a la base de données.");
        }

    }

?>