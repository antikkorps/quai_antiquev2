# Documentation du Site Quai Antique

## Bienvenue sur la documentation du Site Quai Antique.

Vous pouvez accéder au projet en ligne en [cliquant ici]()

Il s'agit de l'ECF studi

## Installer le projet

---

### Prérequis:

- Serveur web (Apache ou Nginx) si vous souhaitez déployer le site en ligne
- php 8.0 ou supérieur
- MySQL ou MariaDB
- Composer

### Les différentes étapes:

il suffit de taper depuis votre terminal :

```
git clone https://github.com/antikkorps/planB.git
```

Ce qui vous permettra de télécharger le code source sur votre machine locale.

puis

```
composer install
```

Qui permettra d'installer l'ensemble des dépendances nécessaires au bon fonctionnement du projet.

Enfin

```
npm install
```

Qui installera les dépendances js.

**A ce stade là, vous disposer du projet sur votre ordinateur.**

---

Il ne vous reste plus quà connecter votre Base de donnée avant de pouvoir lancer le serveur local et donc de pouvoir consulter le site. Le projet a été construit sur une base de données MySQL.

Vous trouverez un fichier sql qui vous permettra d'insérer un certain nombre de données dans le site et qui va également créer un utilisateur client et un utilisateur admin.

Les crédentiels pour ces deux utilisateurs seront:

username: user@test.com mot de passe: password

username: admin@test.com mot de passe: password

Renseigner les éléments de la base de donnée dans le fichier .env.example puis de le renommer .env

puis créer la base de donnée avec la commande suivante :

```
php bin/console doctrine:database:create
```

Importer les différentes tables du projet:

```
php bin/console doctrine:migrations:migrate
```

---

A ce stade, nous n'avons plus qu'à lancer le server local avec la commande:

```
symfony server:start
```

---

Enfin j'attire votre attention sur le fait que l'ensemble des variables d'environnement (DATABASE_URL et MAILER_DSN) sont à compléter pour pouvoir tester l'intégralité des fonctionnalités en local et notamment les fonctionnalités de réservation / confirmation par mail des réservations ou les ré-initialisations de mots de passe.

Vous pouvez pour le mailer utiliser [mailtrap](https://mailtrap.io/) qui fournit un compte gratuit qui vous permettra de réaliser des tests. il vous faudra également, après avoir rempli les éléments du mail et effectué une réservation, par exemple, taper la commande:

```
php bin/console messenger:consume async
```

Cela permettra d'envoyer toutes les requêtes asynchrone du messenger. Une fois fait, vous pourrez constater l'arrivée du mail dans [mailtrap](https://mailtrap.io/)

## Documents complémentaires

---

- Base de donnée SQL
- Wireframe
- Charte Graphique
- Diagramme UML
- Trello
- Documentation Technique
- Manuel D'utilisation du site
