<?php
    require_once("DBRepository.php");
    class EtudiantRepository extends DBRepository 
    {

        // Récupére la liste des etudiants
        public function getAll(int $etat)
        {   
            // on utilise les requetes préparées pour éviter les injections SQL !!!
            $sql = "SELECT * FROM etudiants WHERE etat = :etat ";
            try {
                // permet de preparer la requete sql
                $statement = $this->db->prepare($sql);
                // permet d'executer la requete sql en passant les parametres
                $statement->execute([':etat' => $etat]);
                // fetchAll est une méthode qui permet de récuperer la liste des données 
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                error_log("Une erreur lors de la récupération des étudiants actifs.");
                throw $error;
            }
        }

        // Récupérer un etudiant via son id
        public function getEtudiantById(int $id)
        {
            // on utilise les requetes préparées pour éviter les injections SQL !!!
            $sql = "SELECT * FROM etudiants WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de la récupération de l'étudiant d'id $id " . $error->getMessage());
                throw $error;
            }
        }

        // Permet d'ajouter un etudiant
        public function add($nom,$photo,$email,$password,$matricule,$telephone,$adresse,$createdBy)
        {
            $sql = "INSERT INTO etudiants(nom,photo,email,password,matricule,telephone,adresse,etat,created_at,created_By) 
            VALUES(:nom,:photo,:email,:password,:matricule,:telephone,:adresse,default,Now(),:created_By)";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'nom' => $nom,
                    'photo'=> $photo,
                    'email' => $email,
                    'password'=> $password,
                    'matricule' => $matricule,
                    'telephone' => $telephone,
                    'adresse' => $adresse,
                    'created_By' => $createdBy
                ]);
                $result = $this->db->lastInsertId();
                return $result ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de l'ajout de l'étudiant " . $error->getMessage());
                throw $error;
            }
        }

        // La méthode permet de mettre à jour un etudiant
        public function edit($id,$nom,$prenom,$photo,$email,$password,$matricule,$telephone,$adresse,$updatedBy)
        {
            $sql = "UPDATE etudiants 
                    SET nom = :nom, prenom = :prenom, photo = :photo, email = :email, password = :password,
                    matricule = :matricule, telephone = :telephone, adresse = :adresse, updated_at = Now(), updated_By = :updated_By WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'photo' => $photo,
                    'email' => $email,
                    'password'=> $password,
                    'matricule' => $matricule,
                    'telephone' => $telephone,
                    'adresse' => $adresse,
                    'updated_By' => $updatedBy,
                    'id' => $id
                ]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0; // retourne true si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors de la mise à jour de l'étudiant " . $error->getMessage());
                throw $error;
            }
        }

        // Cette méthode permet de désactiver (supprimer) un etudiant
        public function delete($id,$deleted_By){
            $sql = "UPDATE etudiants SET etat = 0, deleted_at = Now(), deleted_By = :deleted_By WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'deleted_By' => $deleted_By, 
                    'id' => $id
                ]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0;
            } catch (PDOException $error) {
                error_log("Erreur lors de la suppression de l'étudiant d'id $id " . $error->getMessage());
                throw $error;
            }
        }

        // Cette méthode permet d'activer  un etudiant
        public function activer($id,$updated_By){
            $sql = "UPDATE etudiants SET etat = 1, updated_at = Now(), updated_By = :updated_By WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'deleted_By' => $updated_By, 
                    'id' => $id
                ]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0;
            } catch (PDOException $error) {
                error_log("Erreur lors de l'activation de l'étudiant  $id " . $error->getMessage());
                throw $error;
            }
        }

        // Cette méthode permet de supprimer définitivement un etudiant
        public function delete_by_id($id,$deleted_By){
            $sql = "DELETE FROM etudiants WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'deleted_By' => $deleted_By, 
                    'id' => $id
                ]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0;
            } catch (PDOException $error) {
                error_log("Erreur lors de la suppression définitive de l'étudiant d'id $id " . $error->getMessage());
                throw $error;
            }
        }
    }
?>