<?php

/**
 * Modèle pour la table "postule".
 *
 */
class PostuleModel extends Model
{
    /** @var string Nom de la table */
    protected string $table = 'postule';

    /** @var string Clé primaire */
    protected string $primaryKey = '';


    public function getPostuleData(int $id): array
    {
        $db = Database::getInstance();

        // Requête pour récupérer la liste des offre postulées
        $sql = "
            SELECT 
                p.id_ident          ,
                p.id_offre          ,
                p.date_postule      ,
                p.cv                ,
                p.lettre_motivation ,
                p.file_lm           ,
                p.file_cv           ,
                o.titre             ,
                o.description       ,
                o.base_remuneration ,
                o.date_offre        ,
                e.nom
            FROM postule    p
            JOIN offre      o using (id_offre)
            JOIN entreprise e using (id_entreprise)
            WHERE p.id_ident = :id
            AND o.valide = true
            AND e.valide = true
            AND p.valide = true
            ORDER BY p.date_postule ASC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostuleDataByOffreAndIdent(int $id_offre, int $id_ident): array
    {
        $db = Database::getInstance();

        // Requête pour récupérer la liste des offre postulées
        $sql = "
            SELECT 
                p.*                 ,
                o.titre             ,
                o.description       ,
                o.base_remuneration ,
                o.date_offre        ,
                e.nom
            FROM postule    p
            JOIN offre      o using (id_offre)
            JOIN entreprise e using (id_entreprise)
            WHERE   o.id_offre = :id_offre
            AND     p.id_ident = :id_ident
            AND o.valide = true
            AND e.valide = true
            AND p.valide = true
            ORDER BY p.date_postule ASC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id_offre' => $id_offre, 'id_ident' => $id_ident]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}