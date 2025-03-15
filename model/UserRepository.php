<?php

    require_once("DBRepository.php");
    
    class UserRepository extends DBRepository
    {
        // Permet d'authentifier un utilisateur
        public function login($email,$password)
        {
            $sql = "SELECT * FROM users WHERE email = :email AND etat=1";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute(['email' => $email]);
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                if($user && password_verify($password,$user['password'])){
                    return $user;
                }
                return false;
            } catch (PDOException $error) {
                error_log("Erreur lors de la connexion de l'utilisateur");
                throw $error;
            }
        }

        //Permet de créer un compte utilisateur
        public function register($nom, $photo, $password,$email,$role, $telephone, $adresse,$created_at, $created_by)
        {
            $sql = "INSERT INTO users (nom, photo, password, email, role, telephone, adresse, created_at,created_by)
                    VALUES (:nom, :photo, :password, :email, :role, :telephone, :adresse, NOW(), :created_by) ";

            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    "nom"=> $nom,
                    "photo"=> $photo,
                    "password"=> $password,
                    "email"=> $email,
                    "role"=> $role,
                    "telephone"=> $telephone,
                    "adresse"=> $adresse,
                    "created_at"=> $created_at,
                    "created_by"=> $created_by
                    ]);
                    $lastInsertID = $statement->lastInsertId();
                    return $lastInsertID ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de la création de l'utilisateur $nom " . $error->getMessage());
                throw $error;
            }
        }
        //Récupérer la liste des users
        public function getAll(int $etat, string $role = null)
        {
            $sql = "SELECT * from users u WHERE u.etat = :etat ";

            if ($role) {
                $sql .= "AND u.role = :role";
            }

            try {
                $statement = $this->db->prepare($sql);
                $params = ['etat' => $etat];
                
                if ($role) {
                    $params['role'] = $role;
                }

                $statement->execute($params);
                return $statement->fetchAll(PDO::FETCH_ASSOC) ?: null;

            } catch (PDOException $error) {
                $etatLabel = $etat == 1 ? "actives" : "supprimés";
                error_log("Erreur lors de la recupération des $etatLabel" . $error->getMessage());
                throw $error;
            }
        }

        //Récupérer un user via son id
        public function getById(int $id)
        {
            $sql = "SELECT * FROM users WHERE id = :id";

            try {

                $statement = $this->db->prepare($sql);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->execute();
                return $statement->fetch(PDO::FETCH_ASSOC) ?: null;

            } catch (PDOException $error) {
                error_log("Erreur lors de la recupération de l'utilisateurs d'id $id " . $error->getMessage());
                throw $error;
            }
        }

        //Récupérer un user via son id
        public function getUserByEmail($email)
        {
            $sql = "SELECT * FROM users WHERE email = :email";

            try {

                $statement = $this->db->prepare($sql);
                $statement->execute(['email' => $email]);
                return $statement->fetch(PDO::FETCH_ASSOC) ?: null;

            } catch (PDOException $error) {
                error_log("Erreur lors de la recupération de l'utilisateurs d'email $email " . $error->getMessage());
                throw $error;
            }
        }

        //Permet d'ajouter une nouvelle user
        public function edit($id, $nom, $adresse, $telephone, $photo, $email, $role, $updated_by)
        {
            $sql = "UPDATE users
                    SET nom = :nom, adresse = :adresse, telephone = :telephone, photo = :photo,
                    email = :email, role = :role, updated_at = NOW(), updated_by=:updated_by WHERE id = :id ";

            try {

                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'nom' => $nom,
                    'adresse' => $adresse,
                    'telephone' => $telephone,
                    'photo' => $photo,
                    'email' => $email,
                    'role' => $role,
                    'updated_by' => $updated_by,
                    'id' => $id
                ]);

                $rowAffected = $statement->rowCount();
                return $rowAffected >= 0; //true si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors la modification le l'utilisateur $nom " . $error->getMessage());
                throw $error;
            }
        }

        //Permet de désactiver un user
        public function desactivate($id, $deleted_by)
        {
            $sql = "UPDATE users SET etat = 0, deleted_at = NOW(), deleted_by = :deleted_by WHERE id = :id";

            try {

                $statement = $this->db->prepare($sql);
                $statement->execute(['deleted_by' => $deleted_by, 'id' => $id]);
                return $statement->rowCount() > 0;

            } catch (PDOException $error) {
                error_log("Erreur lors de la désactivation d'utilisateur d'id $id " . $error->getMessage());
                throw $error;
            }
        }

        //Permet  d'activer un user ou une user
        public function activate($id, $updated_by)
        {
            $sql = "UPDATE users SET etat = 1, updated_at = NOW(), updated_by = :updated_by WHERE id = :id";

            try {
                $statement = $this->db->prepare($sql);
                $statement->execute(['updated_by' => $updated_by, 'id' => $id]);
                return $statement->rowCount() > 0;
            } catch (PDOException $error) {
                error_log("Erreur lors de l'activation de l'utilisateur d'id $id " . $error->getMessage());
                throw $error;
            }
        }

        public function updatePassword($userId, $hashedPassword)
        {
            $sql = "UPDATE users SET password = :password, updated_at = NOW(), updated_by = :updated_by WHERE id = :id";

            try {

                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'password' => $hashedPassword,
                    'updated_by' => $userId,
                    'id' => $userId
                ]);

                return $statement->rowCount() > 0;

            } catch (PDOException $error) {
                error_log("Erreur lors de la modification du mot de passe " . $error->getMessage());
                throw $error;
            }
        }
    }
?>