CREATE TABLE `students` (
    `id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` CHAR(20) NOT NULL,
    `address` TEXT,
    `notes` JSON
) ENGINE = InnoDB;

INSERT INTO `students` SET `name` = 'Alice', `notes` = '[15, 18, 17, 11, 10]';
INSERT INTO `students` SET `name` = 'Bob', `notes` = '[14, 16, 20, 13, 12]';
INSERT INTO `students` SET `name` = 'Charlie', `notes` = '[19, 15, 18, 16, 14]';
INSERT INTO `students` SET `name` = 'David', `notes` = '[12, 12, 12, 19, 17]';
INSERT INTO `students` SET `name` = 'Emma', `notes` = '[16, 19, 20, 15, 14]';
INSERT INTO `students` SET `name` = 'Frank', `notes` = '[12, 15, 18, 20, 12]';
INSERT INTO `students` SET `name` = 'Grace', `notes` = '[17, 16, 15, 19, 18]';
INSERT INTO `students` SET `name` = 'Harry', `notes` = '[20, 18, 17, 15, 16]';
INSERT INTO `students` SET `name` = 'Ivy', `notes` = '[15, 14, 16, 18, 20]';
INSERT INTO `students` SET `name` = 'Jack', `notes` = '[19, 17, 16, 20, 18]';

SELECT
    notes -> '$[*]'
FROM
    students;

/*Calculer la moyenne des notes*/
SELECT
    `name`,
    AVG(note) AS average_note
FROM
    `students`,
    JSON_TABLE(`notes`, '$[*]' COLUMNS (note INT PATH '$')) AS extracted_notes
GROUP BY
    `name`;

/*Compter le nombre de 15 par étudiant */
SELECT
    `name`,
    COUNT(*) AS count_of_15
FROM
    `students`,
    JSON_TABLE(`notes`, '$[*]' COLUMNS (note INT PATH '$')) AS extracted_notes
WHERE
    extracted_notes.note = 12
GROUP BY
    `name`;
