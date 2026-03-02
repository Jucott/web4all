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

| ID    | Catégorie       | Fonctionnalité                        | Description courte                             | Données principales                                                              | Statut |
| ----- | --------------- | ------------------------------------- | ---------------------------------------------- | -------------------------------------------------------------------------------- | ------ |
| SFx1  | Gestion d'accès | Authentification & gestion des accès  | Connexion / Déconnexion + gestion des rôles    | email, mot de passe, rôle                                                        | ⬜      |
| SFx2  | Entreprises     | Rechercher & afficher entreprise      | Recherche multicritères + avis + offres liées  | nom, description, contact, nb candidatures, moyenne évaluations                  | 🟡      |
| SFx3  | Entreprises     | Créer entreprise                      | Création fiche entreprise                      | nom, description, contact                                                        | ✅      |
| SFx4  | Entreprises     | Modifier entreprise                   | Modification fiche entreprise                  | nom, description, contact                                                        | ✅      |
| SFx5  | Entreprises     | Évaluer entreprise                    | Notation entreprise                            | évaluation                                                                       | ⬜      |
| SFx6  | Entreprises     | Supprimer entreprise                  | Suppression entreprise                         | -                                                                                | ✅      |
| SFx7  | Offres          | Rechercher & afficher offre           | Recherche multicritères offre                  | entreprise, titre, description, compétences, rémunération, date, nb candidatures | ⬜      |
| SFx8  | Offres          | Créer offre                           | Création offre                                 | compétences, titre, description, entreprise, rémunération, date                  | ⬜      |
| SFx9  | Offres          | Modifier offre                        | Modification offre                             | compétences, titre, description, entreprise, rémunération, date                  | ⬜      |
| SFx10 | Offres          | Supprimer offre                       | Suppression offre                              | -                                                                                | ⬜      |
| SFx11 | Offres          | Statistiques offres                   | Carrousel indicateurs clés                     | répartition durée, top wishlist, total offres, moyenne candidatures              | ⬜      |
| SFx12 | Pilotes         | Rechercher & afficher pilote          | Recherche compte pilote                        | nom, prénom                                                                      | ⬜      |
| SFx13 | Pilotes         | Créer pilote                          | Création compte pilote                         | nom, prénom                                                                      | ⬜      |
| SFx14 | Pilotes         | Modifier pilote                       | Modification compte pilote                     | nom, prénom                                                                      | ⬜      |
| SFx15 | Pilotes         | Supprimer pilote                      | Suppression compte pilote                      | -                                                                                | ⬜      |
| SFx16 | Étudiants       | Rechercher & afficher étudiant        | Recherche + état recherche stage               | nom, prénom, email                                                               | ⬜      |
| SFx17 | Étudiants       | Créer étudiant                        | Création compte étudiant                       | nom, prénom, email                                                               | ⬜      |
| SFx18 | Étudiants       | Modifier étudiant                     | Modification compte étudiant                   | nom, prénom, email                                                               | ⬜      |
| SFx19 | Étudiants       | Supprimer étudiant                    | Suppression compte étudiant                    | -                                                                                | ⬜      |
| SFx20 | Candidatures    | Postuler à une offre                  | Envoi CV + LM                                  | offre, CV, LM                                                                    | ⬜      |
| SFx21 | Candidatures    | Voir candidatures étudiant            | Liste des offres postulées                     | offre, CV, LM                                                                    | ⬜      |
| SFx22 | Candidatures    | Voir candidatures des élèves (pilote) | Liste des candidatures des étudiants du pilote | offre, CV, LM                                                                    | ⬜      |
| SFx23 | Wish-list       | Afficher wish-list                    | Voir offres ajoutées                           | -                                                                                | ⬜      |
| SFx24 | Wish-list       | Ajouter à wish-list                   | Ajouter offre                                  | offre                                                                            | ⬜      |
| SFx25 | Wish-list       | Retirer de wish-list                  | Supprimer offre de la liste                    | offre                                                                            | ⬜      |
| SFx27 | Transversal     | Pagination                            | Pagination sur listes                          | -                                                                                | ⬜      |
| SFx28 | Transversal     | Mentions légales                      | Conformité légale                              | -                                                                                | ⬜      |
| BONUS | Bonus           | PWA (Accès mobile)                    | Installation comme app mobile                  | -                                                                                | ⬜      |



## 🛠️ Tableau de suivi des spécifications techniques

| ID    | Exigence               | Description                                                      | Statut |
| ----- | ---------------------- | ---------------------------------------------------------------- | ------ |
| STx1  | Architecture MVC       | MVC obligatoire                                                  | ✅      |
| STx2  | Qualité code           | HTML5 sémantique, validation W3C, CSS structuré, POO PHP, PSR-12 | ✅      |
| STx3  | Validation formulaires | Validation Front (HTML/JS) + Back (PHP)                          | ✅      |
| STx4  | Pas de CMS             | Aucun CMS autorisé                                               | ✅      |
| STx5  | Frameworks             | Pas de React/Vue/Laravel/Symfony                                 | ✅      |
| STx6  | Stack technique        | Apache, HTML/CSS/JS, PHP, SGBD SQL                               | ✅      |
| STx7  | Template engine        | Moteur de template backend obligatoire                           | ✅      |
| STx8  | Clés étrangères        | Utilisation FK en base                                           | ✅      |
| STx9  | Vhost statique         | Vhost pour ressources statiques                                  | 🟡      |
| STx10 | Responsive             | Responsive + menu burger                                         | ✅      |
| STx11 | Sécurité               | Cookies sécurisés, hash mdp, anti SQLi/XSS/CSRF, HTTPS           | 🟡      |
| STx12 | SEO                    | Meta, Hn, alt, <3s chargement, sitemap, robots.txt               | ⬜      |
| STx13 | Routage                | Système de routing backend                                       | ✅      |
| STx14 | Tests unitaires        | Tests PHPUnit sur au moins 1 contrôleur                          | ⬜      |

## 🔥 Stack technique

- ✅ : Apache2
- ✅ : Postgresql
    - : ✅ Base de données
- ✅ : PHP


# VM Ubuntu 24.04 LTS virtualisée dans Oracle VirtualBox

Etapes préliminaires :

## Création de la VM Ubuntu 24.04 LTS

### Télécharger l'image ISO de Ubuntu

L'image ISO permettant l'installation se situe à cette adresse :

[Download](https://ubuntu.com/download/desktop)

récupérer le fichier `ubuntu-24.04.4-desktop-amd64.iso`

### Créer une nouvelle VM VirtualBox

#### Prérequis

S'assurer que VirtualBox 7.2.6 ([Download](https://www.virtualbox.org/wiki/Downloads)) soit bien installé sur le PC ainsi que "Oracle VirtualBox Extension Pack" ("VirtualBox 7.2.6 Extension Pack" -> Accept and download)

Un fois VirtualBox installé, installer l'extension pack.

Dans VirtualBox, Fichier - Outils - Extensions

Puis "Install" (-> pointer sur le fichier `Oracle_VirtualBox_Extension_Pack-7.2.6.vbox-extpack` fraîchement téléchargé)

#### Paramétrage de la nouvelle VM

Dans VirtualBox, faire : Machine - Nouvelle

- VM Name : le_nom_de_la_VM
- VM Folder : par défaut
- ISO Image : <non sélectionné>
- OS : Linux
- OS Distribution : Other Linux
- OS Version : Other Linux (64 bits)
- Specify virtual hardware
    - Base Memory : 4086 Mo
    - Number of CPU : 2
- Specify virtual hard disk
    - Disk Size : 20 Go


Une fois la VM définie, rajouter quelques paramètres :
- Affichage : Video Memory => 128 Mo
- Stockage : Cliquer sur "Controleur : IDE" puis sur le CDRom avec la croix verte (Add optical Drive)
    - Cliquer sur le bouton Ajouter
    - Sélectionner l'image ISO d'Ubuntu 24.04 LTS précédemment téléchargée (`ubuntu-24.04.4-desktop-amd64.iso`)
    - Cliquer sur "Ouvrir"
    - une fois la fenêtre fermée, Sélectionner-la puis cliquer sur "Choose"

Laisser tout le reste par défaut.

Démarrer la VM fraîchement paramétrée se laisser-vous guider pour l'installation jusqu'au bout.

Une fois fini on se retrouve avec une VM avec Ubuntu Desktop 24.04 LTS, de base, installée avec un user ({votre_user}) qui bénéficie des droits `sudo`.

## Les installations à faire

Dès que la VM a démarré, lancer un terminal et taper les commandes suivantes pour installer tous les paquest nécessaires au projet :

```bash
sudo apt update && sudo apt dist-upgrade -y
sudo apt install bzip2 tar gcc make perl terminator php apache2 PostgreSQL net-tools libapache2-mod-php8.3 libapache2-mod-php php-pgsql git
sudo a2enmod php8.3
```

Il vaut mieux installer les extensions VirtualBox afin (notamment) de bénéficier du "full screen" dans la VM.

Pour cela, Cliquer sur "Périphériques" - "Insérer l'image CD des additions invitées"

Puis dans la VM Ubuntu, dans un terminal :

```bash
cd /media/{votre_user}/VBox_GAs_7.2.6/
sudo ./VBoxLinuxAdditions.run 
reboot
```

On peut à présent passer en full screen.

## Les paramétrages à faire

### Apache 2

A mettre dans le fichier `/etc/apache2/sites-available/web4all.conf` qu'il faut créer pour le projet

```
VirtualHost *:80>
    ServerName web4all.local
    DocumentRoot /var/www/html/web4all/public

    <Directory /var/www/html/web4all/public>
#        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/web4all_error.log
    CustomLog ${APACHE_LOG_DIR}/web4all_access.log combined
</VirtualHost>

```

Puis taper :

```bash
sudo a2ensite web4all.conf
sudo a2dissite 000-default.conf
sudo a2enmod rewrite
sudo systemctl reload apache2
```

Puis éditer le fichier `/etc/hosts`

```
27.0.0.1 localhost web4all.local web4all.static
127.0.1.1 {votre_user}-VirtualBox


# The following lines are desirable for IPv6 capable hosts
::1     ip6-localhost ip6-loopback
fe00::0 ip6-localnet
ff00::0 ip6-mcastprefix
ff02::1 ip6-allnodes
ff02::2 ip6-allrouters

```

### Le projet web4all

Se placer dans le répertoire /var/www/html et lancer ces commandes

```bash
cd /var/www/html
mkdir web4all
git clone 'https://github.com/Jucott/web4all.git'



```


### Postgresql

A partie de {votre_user} lancer ces commandes afin de créer le user "web4all" dans la database ainsi que la database "web4all" du projet elle-même:

```bash
sudo su - postgres
psql
create user web4all with password 'web4all' createdb;
create database web4all;
alter database web4all owner to web4all;
\q
exit
```

Puis, en se plaçant dans le répetoire /var/www/html/web4all, installer la base de donnée ainsi :

```bash
cat sgbd.sql | psql -h 127.0.0.1 -U web4all web4all
Password for user web4all: web4all
CREATE....
CREATE....
ALTER....

```





### Git

```bash
git init
git add .
git config --global user.email "l_email_du_compte_GitHub"
git config --global user.name "Le_Nom_de_votre_compte_sur_GitHub"
git remote add origin https://github.com/Jucott/web4all.git
git commit -m "Initial commit"
git status
git branch -M main
git push -u origin main
```

## Conformité PSR-12

Installer VsCode + composer + php-cs-fixer

```bash
sudo snap install code --classic
sudo apt install composer
composer global require friendsofphp/php-cs-fixer
export PATH="$PATH:$HOME/.config/composer/vendor/bin"
echo 'export PATH="$PATH:$HOME/.config/composer/vendor/bin"' >> ~/.bashrc
```

Pour voir si cela marche :

```bash
cd /var/www/html/web4all
php-cs-fixer fix --dry-run --diff
```

Cela va afficher les différences entre ce qui est et ce qui est proposé.

En cas d'accord avec les modifications suggérées :

```bash
php-cs-fixer fix
```

Pour qu'à chaque sauvegarde dans Vscode, les modifications respectant la conformité PSR-12 soit respectées, il faut installer l'extension : "php cs fixer"


