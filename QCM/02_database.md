**QCM sur la Configuration et création de notre première base de données :**

**Question 01:**
Qu'est-ce qu'un ORM (Object Relational Mapper) dans le contexte de Symfony?

- [ ] Un outil de gestion des migrations de base de données.
- [ ] Un langage de requête pour interagir avec la base de données.
- [ ] Un outil permettant de faciliter l'interaction entre une application orientée objet et une base de données relationnelle.
- [ ] Une bibliothèque pour la création d'interfaces utilisateur.

---

**Question 02:**
Quelle commande est utilisée pour ajouter les dépendances [symfony/orm-pack](https://packagist.org/packages/symfony/orm-pack) et [symfony/maker-bundle](https://packagist.org/packages/symfony/maker-bundle) à un projet Symfony?

- [ ] `php bin/console make:entity`
- [ ] `composer require symfony/framework-bundle`
- [ ] `php bin/console doctrine:migrations:migrate`
- [ ] `composer require symfony/orm-pack symfony/maker-bundle`

---

**Question 03:**
Quelle est la commande pour créer une base de données configurée dans Symfony?

- [ ] `php bin/console doctrine:migrations:diff`
- [ ] `php bin/console doctrine:schema:update`
- [ ] `php bin/console doctrine:database:create`
- [ ] `php bin/console make:migration`

---

**Question 04:**
Comment ajoutez-vous des données d'exemple (DataFixtures) à votre base de données avec Symfony?

- [ ] `php bin/console make:entity`
- [ ] `php bin/console doctrine:migrations:generate`
- [ ] `php bin/console doctrine:fixtures:load`
- [ ] `php bin/console doctrine:database:seed`

---

**Question 05:**
Quelle est la commande pour générer un fichier de migration après avoir créé une entité dans Symfony?

- [ ] `php bin/console doctrine:database:create`
- [ ] `php bin/console make:entity`
- [ ] `php bin/console doctrine:schema:update`
- [ ] `php bin/console make:migration`

**QCM sur la Configuration et création de notre première base de données (Suite) :**

**Question 06:**
Quelle est la commande pour générer des données d'exemple avec [FakerPHP/Faker](https://fakerphp.github.io/) dans Symfony?

- [ ] `php bin/console make:fake-data`
- [ ] `php bin/console doctrine:migrations:fake`
- [ ] `composer require fakerphp/faker --dev`
- [ ] `php bin/console doctrine:data-faker:generate`

---

**Question 07:**
Pourquoi est-il nécessaire de générer un fichier de migration avant de créer la base de données?

- [ ] Pour définir les fixtures de la base de données.
- [ ] Pour déployer l'application sur un serveur distant.
- [ ] Pour activer les commandes de gestion des bases de données.
- [ ] Pour obtenir les requêtes SQL nécessaires à la création des tables.

---

**Question 08:**
Quelle est la raison d'être des DataFixtures dans Symfony?

- [ ] Pour gérer les migrations de base de données.
- [ ] Pour créer des entités dans le projet Symfony.
- [ ] Pour ajouter des données d'exemple à la base de données.
- [ ] Pour gérer les dépendances du projet Symfony.

---

**Question 09:**
Comment modifier une entité existante dans Symfony, en ajoutant de nouveaux champs?

- [ ] En modifiant directement la base de données avec des requêtes SQL.
- [ ] En utilisant la commande `php bin/console make:migration`.
- [ ] En créant une nouvelle entité et en supprimant l'ancienne.
- [ ] En modifiant le fichier `.env` directement.

---

**Question 10:**
Quelle est la commande pour afficher les données d'une table dans la base de données avec Symfony?

- [ ] `php bin/console make:query`
- [ ] `php bin/console doctrine:show-table`
- [ ] `php bin/console doctrine:query:sql`
- [ ] `php bin/console doctrine:database:show-data`