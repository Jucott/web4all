# 🚀 Glossaire

⬜ À faire

🟡 En cours

✅ Terminé

❌ Bloqué


# 📊 Tableau de suivi des spécifications fonctionnelles

| ID     | Catégorie | Fonctionnalité | Description courte | Données principales | Statut |
|--------|------------|---------------|--------------------|---------------------|--------|
| SFx1 | Gestion d'accès | Authentification & gestion des accès | Connexion / Déconnexion + gestion des rôles | email, mot de passe, rôle | ⬜ |
| SFx2 | Entreprises | Rechercher & afficher entreprise | Recherche multicritères + avis + offres liées | nom, description, contact, nb candidatures, moyenne évaluations | 🟡 |
| SFx3 | Entreprises | Créer entreprise | Création fiche entreprise | nom, description, contact | ✅ |
| SFx4 | Entreprises | Modifier entreprise | Modification fiche entreprise | nom, description, contact | ✅ |
| SFx5 | Entreprises | Évaluer entreprise | Notation entreprise | évaluation | ⬜ |
| SFx6 | Entreprises | Supprimer entreprise | Suppression entreprise | - | ✅ |
| SFx7 | Offres | Rechercher & afficher offre | Recherche multicritères offre | entreprise, titre, description, compétences, rémunération, date, nb candidatures | ⬜ |
| SFx8 | Offres | Créer offre | Création offre | compétences, titre, description, entreprise, rémunération, date | ⬜ |
| SFx9 | Offres | Modifier offre | Modification offre | compétences, titre, description, entreprise, rémunération, date | ⬜ |
| SFx10 | Offres | Supprimer offre | Suppression offre | - | ⬜ |
| SFx11 | Offres | Statistiques offres | Carrousel indicateurs clés | répartition durée, top wishlist, total offres, moyenne candidatures | ⬜ |
| SFx12 | Pilotes | Rechercher & afficher pilote | Recherche compte pilote | nom, prénom | ⬜ |
| SFx13 | Pilotes | Créer pilote | Création compte pilote | nom, prénom | ⬜ |
| SFx14 | Pilotes | Modifier pilote | Modification compte pilote | nom, prénom | ⬜ |
| SFx15 | Pilotes | Supprimer pilote | Suppression compte pilote | - | ⬜ |
| SFx16 | Étudiants | Rechercher & afficher étudiant | Recherche + état recherche stage | nom, prénom, email | ⬜ |
| SFx17 | Étudiants | Créer étudiant | Création compte étudiant | nom, prénom, email | ⬜ |
| SFx18 | Étudiants | Modifier étudiant | Modification compte étudiant | nom, prénom, email | ⬜ |
| SFx19 | Étudiants | Supprimer étudiant | Suppression compte étudiant | - | ⬜ |
| SFx20 | Candidatures | Postuler à une offre | Envoi CV + LM | offre, CV, LM | ⬜ |
| SFx21 | Candidatures | Voir candidatures étudiant | Liste des offres postulées | offre, CV, LM | ⬜ |
| SFx22 | Candidatures | Voir candidatures des élèves (pilote) | Liste des candidatures des étudiants du pilote | offre, CV, LM | ⬜ |
| SFx23 | Wish-list | Afficher wish-list | Voir offres ajoutées | - | ⬜ |
| SFx24 | Wish-list | Ajouter à wish-list | Ajouter offre | offre | ⬜ |
| SFx25 | Wish-list | Retirer de wish-list | Supprimer offre de la liste | offre | ⬜ |
| SFx27 | Transversal | Pagination | Pagination sur listes | - | ⬜ |
| SFx28 | Transversal | Mentions légales | Conformité légale | - | ⬜ |
| BONUS | Bonus | PWA (Accès mobile) | Installation comme app mobile | - | ⬜ |



# 🛠️ Tableau de suivi des spécifications techniques

| ID | Exigence | Description | Statut |
|----|----------|------------|--------|
| STx1 | Architecture MVC | MVC obligatoire | ✅ |
| STx2 | Qualité code | HTML5 sémantique, validation W3C, CSS structuré, POO PHP, PSR-12 | ✅ |
| STx3 | Validation formulaires | Validation Front (HTML/JS) + Back (PHP) | ✅ |
| STx4 | Pas de CMS | Aucun CMS autorisé | ✅ |
| STx5 | Frameworks | Pas de React/Vue/Laravel/Symfony | ✅ |
| STx6 | Stack technique | Apache, HTML/CSS/JS, PHP, SGBD SQL | ✅ |
| STx7 | Template engine | Moteur de template backend obligatoire | ✅ |
| STx8 | Clés étrangères | Utilisation FK en base | ✅ |
| STx9 | Vhost statique | Vhost pour ressources statiques | 🟡 |
| STx10 | Responsive | Responsive + menu burger | ✅ |
| STx11 | Sécurité | Cookies sécurisés, hash mdp, anti SQLi/XSS/CSRF, HTTPS | 🟡 |
| STx12 | SEO | Meta, Hn, alt, <3s chargement, sitemap, robots.txt | ⬜ |
| STx13 | Routage | Système de routing backend | ✅ |
| STx14 | Tests unitaires | Tests PHPUnit sur au moins 1 contrôleur | ⬜ |

# 🔥 Stack technique

- ✅ : Apache2
- ✅ : Postgresql
    - : ✅ Base de données
- ✅ : PHP
