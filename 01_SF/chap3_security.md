# Security 

:shell: si vous devez retirer la table user ainsi que l'entité User
```bash
composer require --dev symfony/profiler-pack
composer require symfony/security-bundle
# ajoutez username 
php bin/console make:user
php bin/console make:migration

# choix 1 
php bin/console make:auth 

# création d'un user avec mot de passe
php bin/console debug:autowiring Password

```

Dans une méthode de controller on peut créer un user pour tester la connexion

```php
  public function index(
        Request $request,
        Yams $yams,
        SessionInterface $session,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $em
    ): Response {

        $user = new User();
        $user->setUsername('alice')
            ->setEmail('alice@alice.fr')
            ->setPassword($hasher->hashPassword($user, 'alice'))
            ->setRoles([]);
        $em->persist($user) ;
        $em->flush() ;
    // ... du code

    }

```

Ou créez l'utilisateur dans la base de données directement, vérifiez que l'utilisateur est bien créé.

```bash
# alice password 
INSERT INTO user (id, email, username, roles, password, is_verified) 
VALUES
(1, 'alice@alice.fr', 'alice', '[\"ROLE_ADMIN\"]', '\$2y$13$ykMD1/BMm71ioeyjVi.wqu9qKGK7FasVXYWKTk8Q9f/0Q1iLnZBlm', 1 );

UPDATE user SET roles ='[\"ROLE_ADMIN\"]', password = '\$2y$13$ykMD1/BMm71ioeyjVi.wqu9qKGK7FasVXYWKTk8Q9f/0Q1iLnZBlm' WHERE id = 1 ;
```

- configuration 

```yaml
# config/packages/security.yaml
security:
    # ...

    providers:
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email

``` 
```yaml

 remember_me:
                secret:   '%kernel.secret%' # required
                lifetime: 604800 # 1 week in seconds
```