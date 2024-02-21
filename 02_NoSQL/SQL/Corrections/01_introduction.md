# Tables students

```sql
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    notes JSON
);
```

Et elle contient des données de la manière suivante :

```sql

DELETE FROM students; 

INSERT INTO students (id, name, notes)
VALUES
    (1, 'Alice', '{"grades": [15, 18, 17, 11, 10]}'),
    (2, 'Bob', '{"grades": [12, 14, 16, 9, 13]}'),
    (3, 'Charlie', '{"grades": [20, 19, 18, 17, 16]}');
```

Maintenant, explorons quelques opérations avec les données JSON dans la table `students`.

## 1. Extraire une note spécifique d'un étudiant

Supposons que nous voulions extraire la deuxième note d'Alice. Utilisons `JSON_EXTRACT` pour y parvenir :

```sql
SELECT
    id,
    name,
    JSON_EXTRACT(notes, '$.grades[1]') AS second_grade
FROM students
WHERE name = 'Alice';
```

Résultat :

```
+----+-------+--------------+
| id | name  | second_grade |
+----+-------+--------------+
| 1  | Alice | 18           |
+----+-------+--------------+
```

## 2. Calculer la moyenne des notes

Calculons la moyenne des notes de chaque étudiant. Utilisons `JSON_TABLE` pour décomposer le tableau JSON des notes :

```sql
SELECT
    id,
    name,
    ROUND( AVG(grade), 1) AS average_grade
FROM students,
     JSON_TABLE(notes, '$.grades[*]' COLUMNS (grade INT PATH '$')) AS grades
GROUP BY id, name;
```

Résultat :

```
+----+---------+---------------+
| id | name    | average_grade |
+----+---------+---------------+
| 1  | Alice   | 14.2          |
| 2  | Bob     | 12.8          |
| 3  | Charlie | 18.0          |
+----+---------+---------------+
```

## 3. Mettre à jour une note spécifique

Supposons que nous voulions mettre à jour la troisième note de Bob. Utilisons `JSON_SET` pour réaliser cela :

```sql
UPDATE students
SET notes = JSON_SET(notes, '$.grades[2]', 15)
WHERE name = 'Bob';
```

Maintenant, les notes de Bob ont été mises à jour :

```sql
SELECT * FROM students WHERE name = 'Bob';
```

Résultat après la mise à jour :

```
+----+------+---------------------+
| id | name | notes               |
+----+------+---------------------+
| 2  | Bob  | {"grades": [12,14,15,9,13]} |
+----+------+---------------------+
```

Ces exemples illustrent comment utiliser les fonctions JSON dans MySQL pour effectuer des opérations sur des données JSON stockées dans une table relationnelle.

## 4. Ajouter une nouvelle note à un étudiant

Supposons que nous voulions ajouter une nouvelle note à la liste des notes d'Alice. Utilisons `JSON_ARRAY_APPEND` pour accomplir cela :

```sql
UPDATE students
SET notes = JSON_ARRAY_APPEND(notes, '$.grades', 14)
WHERE name = 'Alice';
```

Après cette mise à jour, la liste des notes d'Alice inclura maintenant la nouvelle note 14 :

```sql
SELECT * FROM students WHERE name = 'Alice';
```

Résultat après la mise à jour :

```
+----+-------+--------------------------+
| id | name  | notes                    |
+----+-------+--------------------------+
| 1  | Alice | {"grades": [15,18,17,11,10,14]} |
+----+-------+--------------------------+
```

## 5. Supprimer une note spécifique d'un étudiant

Supposons que nous voulions supprimer la quatrième note de Charlie. Utilisons `JSON_REMOVE` pour réaliser cela :

```sql
UPDATE students
SET notes = JSON_REMOVE(notes, '$.grades[3]')
WHERE name = 'Charlie';
```

Après cette mise à jour, la quatrième note de Charlie a été supprimée :

```sql
SELECT * FROM students WHERE name = 'Charlie';
```

Résultat après la mise à jour :

```
+----+--------+-----------------------+
| id | name   | notes                 |
+----+--------+-----------------------+
| 3  | Charlie| {"grades": [20,19,18,16]} |
+----+--------+-----------------------+
```

## 6. Fusionner des données JSON de deux étudiants

Supposons que nous voulions fusionner les données JSON de deux étudiants, par exemple, fusionner les notes d'Alice et de Bob. Utilisons `JSON_MERGE` pour accomplir cela :

```sql
SELECT
    JSON_MERGE(
        (SELECT notes FROM students WHERE name = 'Alice'),
        (SELECT notes FROM students WHERE name = 'Bob')
    ) AS merged_notes;
```

Résultat de la fusion des notes d'Alice et de Bob :

```
+------------------------------------------------------+
| merged_notes                                         |
+------------------------------------------------------+
| {"grades": [15,18,17,11,10,14,12,14,15,9,13]} |
+------------------------------------------------------+
```

Nombre de produits par pays d'origine :

```sql
SELECT origin->>"$.country" AS country, COUNT(*) AS num_products FROM products GROUP BY country;
```

Produits avec le plus de calories par portion :
```sql
SELECT name, calories->>"$.total" AS total_calories, calories->>"$.perServing" AS per_serving_calories
FROM products
ORDER BY per_serving_calories DESC
LIMIT 1;
```

Prix moyen des produits par pays d'origine :

```sql
SELECT origin->>"$.country" AS country, AVG(price) AS avg_price FROM products GROUP BY country;
```