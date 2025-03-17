<?php
require_once("DBRepository.php");

class EvaluationRepository extends DBRepository
{

    //Récupère toutes les évaluations qui ne sont pas "supprimées" (deleted_at IS NULL).
    public function getAll()
    {
        // on utilise les requetes préparées pour éviter les injections SQL !!!
        $sql = "SELECT * FROM evaluations ";
        try {
            // permet de preparer la requete sql
            $statement = $this->db->prepare($sql);
            // permet d'executer la requete sql en passant les parametres
            $statement->execute();
            // fetchAll est une méthode qui permet de récuperer la liste des données 
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $error) {
            error_log("Une erreur lors de la récupération des étudiants actifs.");
            throw $error;
        }
    }

    //Récupère une évaluation par son ID (même si elle est "supprimée").
    public function getEvaluationById(int $id)
    {
        $sql = "SELECT
                    e.*,
                    u1.email AS created_by_email,
                    u2.email AS updated_by_email
                FROM
                    evaluations e
                LEFT JOIN users u1 ON e.created_by = u1.id
                LEFT JOIN users u2 ON e.updated_by = u2.id
                WHERE e.id = :id
                LIMIT 1";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération de l'évaluation d'id $id : " . $error->getMessage());
            throw $error;
        }
    }

    // Ajout d'une évaluation
    public function add($nom, $semestre, $type, $createdBy)
    {
        $sql = "INSERT INTO evaluations
                    (nom, semestre, type, created_at, created_by)
                VALUES
                    (:nom, :semestre, :type, NOW(), :created_by)";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'semestre' => $semestre,
                'type' => $type,
                'created_by' => $createdBy,
            ]);
            $result = $this->db->lastInsertId();
            return $result ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout de l'évaluation « $nom » : " . $error->getMessage());
            throw $error;
        }
    }

    //Modifie une évaluation existante.
    public function edit($id, $nom, $semestre, $type, $updatedBy)
    {
        $sql = "UPDATE evaluations
                SET
                    nom        = :nom,
                    semestre   = :semestre,
                    type       = :type,
                    updated_at = NOW(),
                    updated_by = :updated_by
                WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'semestre' => $semestre,
                'type' => $type,
                'updated_by' => $updatedBy,
                'id' => $id,
            ]);

            // rowCount() >= 0 => la requête a bien été exécutée
            // rowCount() > 0  => indique qu'une ligne a réellement été mise à jour
            return $statement->rowCount() >= 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification de l'évaluation d'id $id : " . $error->getMessage());
            throw $error;
        }
    }

    //Désactive (soft-delete) une évaluation en renseignant deleted_at et deleted_by.
    public function desactivate($id, $deletedBy)
    {
        $sql = "UPDATE evaluations
                SET deleted_at = NOW(),
                    deleted_by = :deleted_by
                WHERE id = :id
                AND deleted_at IS NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'deleted_by' => $deletedBy,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la désactivation de l'évaluation d'id $id : " . $error->getMessage());
            throw $error;
        }
    }

    //Réactive une évaluation "supprimée" en mettant deleted_at et deleted_by à NULL.
    public function activate($id, $updatedBy)
    {
        // On réinitialise deleted_at et deleted_by
        $sql = "UPDATE evaluations
                SET
                    deleted_at = NULL,
                    deleted_by = NULL,
                    updated_at = NOW(),
                    updated_by = :updated_by
                WHERE id = :id
                AND deleted_at IS NOT NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'updated_by' => $updatedBy,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la réactivation de l'évaluation d'id $id : " . $error->getMessage());
            throw $error;
        }
    }

    //Supprime définitivement une évaluation (hard delete).
    public function delete(int $id)
    {
        $sql = "DELETE FROM evaluations WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression définitive de l'évaluation d'id $id : " . $error->getMessage());
            throw $error;
        }
    }
}
