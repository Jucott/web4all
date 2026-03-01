# Projet web4all

## Livrable

Le bloc termine sans surprise par une soutenance. Durant cette dernière, vous allez vous positionner comme le prestataire (Web4All) qui vient montrer à son client CESI (le jury) le résultat de sa commande.

La soutenance peut être composée d'une petite présentation de 5 minutes et surtout d'une démonstration technique. Le temps étant compté, le jury pourra vous guider par ses questions pour vérifier telle ou telle spécificité (fonctionnelle comme technique). La séquence se terminera hors contexte par des questions/réponses individuelles permettant d'évaluer votre implication personnelle dans le projet.

## Cahier des charges du projet

La réalisation d'une application web pour les stages se trouve être un projet plein d'ambitions. Le site va permettre d'informatiser l'aide à la recherche de stages en regroupant toutes les offres de stage. Il permettra entre autres d'enregistrer les données des entreprises ayant déjà pris un stagiaire, ou qui en recherchent un.

Ceci facilitera l'orientation des nouveaux étudiants dans leurs recherches de stages.

Les offres de stage seront notamment enregistrées par compétences, ce qui permettra à l'étudiant de trouver un stage en rapport avec son profil. L'application doit fournir différentes interfaces à destination des différents profils d'utilisateurs.

Les profils d'utilisateurs sont l'administrateur, le pilote de promotion et l'étudiant. Parmi les fonctionnalités attendues figurent la gestion des rôles, la gestion des entreprises, la gestion des offres de stage et la gestion des candidatures. Selon le profil d'utilisateur, ce dernier pourra accéder à certains services et pas à d'autres. Seuls les administrateurs ont accès à l'ensemble des fonctionnalités proposées par la plateforme (ou presque).

Ce cahier des charges laisse place à des interprétations, différentes options possibles et des champs de liberté. Vous devez analyser, faire ressortir les zones d'ombre, les options et autres incertitudes de manière à réfléchir à la meilleure ligne de conduite pour votre groupe et ainsi le proposer à votre client.

Outre les fonctionnalités techniques, votre site devra s'adapter au mieux en fonction de l'équipement de l'utilisateur (responsive) et respecter les bonnes pratiques de codage côté back-end comme front-end.

Le site web doit être conçu pour répondre aux critères d’optimisation SEO de base (structure HTML, mots-clés, performance, sécurité) et chaque section importante du site doit inclure des balises meta adéquates.

Par ailleurs il va sans dire que vous veillerez à la conformité légale de votre site, notamment à ce que les mentions légales obligatoires soient présentes.

À noter qu'utiliser un serveur de base de données commun au groupe (dans la mesure du possible) simplifiera grandement le travail de l'équipe.

# Etat d'avancement du projet

## 🚀 Glossaire

⬜ À faire - 🟡 En cours - ✅ Terminé - ❌ Bloqué

## 📊 Tableau de suivi des spécifications fonctionnelles

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



## 🛠️ Tableau de suivi des spécifications techniques

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

## 🔥 Stack technique

- ✅ : Apache2
- ✅ : Postgresql
    - : ✅ Base de données
- ✅ : PHP
