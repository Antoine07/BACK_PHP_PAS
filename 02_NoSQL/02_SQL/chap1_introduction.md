# Introduction aux Fonctions JSON en SQL

JSON (JavaScript Object Notation) est un format d'échange de données léger, facile à lire et à écrire pour les humains, et facile à analyser et à générer pour les machines. 

> [!NOTE] De nombreuses applications modernes utilisent JSON comme format de données. Les bases de données SQL ont introduit des fonctions spécifiques pour travailler efficacement avec les données JSON.

## Fonction JSON_EXTRACT

### Objectif

`JSON_EXTRACT` est une fonction SQL utilisée pour extraire des données d'un document JSON.

### Syntaxe

```sql
JSON_EXTRACT(json_doc, chemin)
```

### Exemple

Considérons une table `students` avec une colonne `notes` contenant des données JSON :

```sql
SELECT JSON_EXTRACT(notes, '$.grades[0]') AS first_grade FROM students;
```

Cette requête extrait la première note de la colonne JSON `notes`.

## Fonction JSON_TABLE

### Objectif

`JSON_TABLE` est une fonction SQL qui vous permet de transformer un objet JSON en un format relationnel.

### Syntaxe

```sql
JSON_TABLE(json_doc, chemin COLUMNS (nom_colonne type_de_données PATH chemin))
```

### Exemple

Supposons une table `employees` avec une colonne `employee_data` contenant des données JSON :

🥟

```sql
SELECT employee.*
FROM employees,
     JSON_TABLE(employee_data, '$'
       COLUMNS (employee_id INT PATH '$.id',
                employee_name VARCHAR(255) PATH '$.name',
                employee_salary DECIMAL PATH '$.salary')) AS employee;
```

🚀 Cette requête SQL utilise la fonction `JSON_TABLE` pour transformer des données JSON stockées dans la colonne `employee_data` de la table `employees` en colonnes relationnelles. Voici une explication plus détaillée :

```sql
SELECT employee.*
FROM employees,
     JSON_TABLE(
       employee_data, -- La colonne JSON à extraire
       '$'            -- Le chemin racine dans le JSON
       COLUMNS (
         employee_id INT PATH '$.id',                -- Extraction de la propriété 'id' du JSON
         employee_name VARCHAR(255) PATH '$.name',   -- Extraction de la propriété 'name' du JSON
         employee_salary DECIMAL PATH '$.salary'     -- Extraction de la propriété 'salary' du JSON
       )
     ) AS employee;
```


- `JSON_TABLE(...) AS employee`: Utilise la fonction `JSON_TABLE` pour transformer les données JSON de la colonne `employee_data`. 

- `employee.*`: Sélectionne toutes les colonnes de la table résultante avec l'alias `employee`, c'est-à-dire les colonnes extraites à partir du JSON.

- `JSON_TABLE(...)` : Spécifie la fonction `JSON_TABLE` qui prend deux arguments :
   - `employee_data`: La colonne JSON à extraire.
   - `'$'`: Le chemin racine dans le JSON à partir duquel les propriétés seront extraites.

- `COLUMNS (...)`: Définit les colonnes résultantes de la table, chacune correspondant à une propriété extraite du JSON.
   - `employee_id INT PATH '$.id'`: Extrait la propriété 'id' du JSON et la place dans la colonne `employee_id` de type `INT`.
   - `employee_name VARCHAR(255) PATH '$.name'`: Extrait la propriété 'name' du JSON et la place dans la colonne `employee_name` de type `VARCHAR(255)`.
   - `employee_salary DECIMAL PATH '$.salary'`: Extrait la propriété 'salary' du JSON et la place dans la colonne `employee_salary` de type `DECIMAL`. 

Ainsi, la requête sélectionne toutes les colonnes extraites du JSON de la colonne `employee_data` de la table `employees` et les renomme avec l'alias `employee`.

## Cas d'utilisation

1. **Extraction de Données** : Extraire des données spécifiques d'un document JSON, telles que des objets ou des tableaux imbriqués.

1. **Transformation de Données** : Convertir des données JSON en un format relationnel pour faciliter les requêtes.

## D'autres fonctions JSON

1. **`JSON_UNQUOTE`**: Cette fonction est utilisée pour supprimer les guillemets doubles entourant une chaîne JSON. Elle est souvent utilisée en conjonction avec `JSON_EXTRACT` pour obtenir une valeur non encadrée.

Exemple :
```sql
SELECT JSON_UNQUOTE(JSON_EXTRACT(column_name, '$.property')) AS property_value FROM table_name;
```

2. **`JSON_ARRAY` et `JSON_OBJECT`**: Ces fonctions permettent de créer respectivement un tableau JSON et un objet JSON. Elles sont utiles pour construire de nouvelles structures JSON lors de l'insertion ou de la mise à jour de données.

Exemple :
```sql
SELECT JSON_ARRAY(1, 2, 3) AS json_array;
SELECT JSON_OBJECT('key1', 'value1', 'key2', 'value2') AS json_object;
```

3. **`JSON_ARRAYAGG` et `JSON_OBJECTAGG`**: Ces fonctions agrègent des valeurs en un tableau ou un objet JSON. Elles sont souvent utilisées avec des clauses GROUP BY.

Exemple :
```sql
SELECT employee_id, JSON_ARRAYAGG(skill) AS skills FROM employee_skills GROUP BY employee_id;
```

4. **`JSON_SET` et `JSON_INSERT`**: Ces fonctions permettent de mettre à jour ou d'insérer des valeurs dans un document JSON existant.

Exemple :
```sql
UPDATE table_name SET column_name = JSON_SET(column_name, '$.property', 'new_value') WHERE condition;
```

5. **`JSON_REMOVE`**: Cette fonction supprime une ou plusieurs propriétés d'un document JSON.

Exemple :
```sql
UPDATE table_name SET column_name = JSON_REMOVE(column_name, '$.property') WHERE condition;
```

6. **`JSON_MERGE` et `JSON_MERGE_PATCH`**: Ces fonctions fusionnent deux documents JSON. `JSON_MERGE` combine les propriétés, tandis que `JSON_MERGE_PATCH` met à jour les propriétés du premier document avec celles du second.

Exemple :
```sql
SELECT JSON_MERGE('{"a": 1}', '{"b": 2}') AS merged_json;
```

## Exercices 



```sql
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    notes JSON
);
```

🥟

```sql
INSERT INTO students (id, name, notes)
VALUES
    (1, 'Alice', '{"grades": [15, 18, 17, 11, 10]}'),
    (2, 'Bob', '{"grades": [12, 14, 16, 9, 13]}'),
    (3, 'Charlie', '{"grades": [20, 19, 18, 17, 16]}');
```


## 1. Extraire une note spécifique d'un étudiant

Supposons que nous voulions extraire la deuxième note d'Alice. Utilisons `JSON_EXTRACT` pour y parvenir.

Résultat :

```
+----+-------+--------------+
| id | name  | second_grade |
+----+-------+--------------+
| 1  | Alice | 18           |
+----+-------+--------------+
```

## 2. Calculer la moyenne des notes

Calculons la moyenne des notes de chaque étudiant. Utilisons `JSON_TABLE` pour décomposer le tableau JSON des notes.

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


Résultat après la mise à jour :

```
+----+------+---------------------+
| id | name | notes               |
+----+------+---------------------+
| 2  | Bob  | {"grades": [12,14,15,9,13]} |
+----+------+---------------------+
```

Bien sûr, continuons avec d'autres exemples d'opérations sur les données JSON dans la table `students`.

## 4. Ajouter une nouvelle note à un étudiant

Supposons que nous voulions ajouter une nouvelle note à la liste des notes d'Alice. Utilisons `JSON_ARRAY_APPEND` pour accomplir cela :

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


Résultat de la fusion des notes d'Alice et de Bob :

```
+------------------------------------------------------+
| merged_notes                                         |
+------------------------------------------------------+
| {"grades": [15,18,17,11,10,14,12,14,15,9,13]} |
+------------------------------------------------------+
```

## Pastries

Reprennez les données suivantes et créez une table pastry.

🥟

```sql
-- creation de la table pastry
CREATE TABLE pastry (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    origin JSON,
    calories JSON,
    price DOUBLE,
    image VARCHAR(100),
    quantity SMALLINT
);


INSERT INTO pastry (name, origin, calories, price, image, quantity)
VALUES
('Fondant suprême', '{"country": "France", "region": "Île-de-France"}', '{"total": 350, "perServing": 90}', 5.5, 'http://placehold.it/32x32', 4),
('Cake tout Chocolat', '{"country": "Belgium", "region": "Brussels"}', '{"total": 400, "perServing": 110}', 7.5, 'http://placehold.it/32x32', 3),
('Cake Framboise chocolat', '{"country": "France", "region": "Provence-Alpes-Côte d''Azur"}', '{"total": 320, "perServing": 80}', 6.5, 'http://placehold.it/32x32', 4),
('Brioche sucrée avec chocolat', '{"country": "France", "region": "Normandy"}', '{"total": 250, "perServing": 70}', 4.5, 'http://placehold.it/32x32', 3),
('Cake glacé fondant au chocolat', '{"country": "Switzerland", "region": "Zurich"}', '{"total": 380, "perServing": 95}', 8.5, 'http://placehold.it/32x32', 2),
('Éclairs au chocolat', '{"country": "France", "region": "Centre-Val de Loire"}', '{"total": 300, "perServing": 75}', 3.5, 'http://placehold.it/32x32', 5),
('Tarte poire chocolat', '{"country": "France", "region": "Brittany"}', '{"total": 420, "perServing": 100}', 9.5, 'http://placehold.it/32x32', 5),
('Banana au chocolat', '{"country": "United States", "region": "California"}', '{"total": 280, "perServing": 85}', 5.0, 'http://placehold.it/32x32', 3);

```

1. Calculez le nombre de produits par pays d'origine.
1. Calculez les pâtisseries avec le plus de calories par portion.
1. Calculez le prix moyen des produits par pays d'origine.