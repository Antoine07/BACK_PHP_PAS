// comme un fetch en PHP vous devez itérer dessus pour récupérer les données

let cursorRestaurants2 = db.restaurants.find();
let count = 0;
for (const restaurant of db.restaurants.find()) {
    count = count + 1;
}

print(count);

// Exercice 
/*
 Combien y a t il de restaurants qui font de la cuisine italienne et qui ont eu au moins une fois un score de 10 ?

 Affichez également le nom, les scores et les coordonnées GPS de ces restaurants. Ordonnez les résultats par ordre décroissant sur les noms des restaurants.

*/

db.restaurants.find(
    {
        $and: [
            { cuisine: "Italian" },
            { "grades.score": 10 }
        ]
    },
    {
        _id: 0,
        "grades.score": 1
    }
)

db.restaurants.find(
    {
        $and: [
            { cuisine: "Italian" },
            { "grades.score": 10 }
        ]
    },
    {
        _id: 0,
        "grades.score": 1,
        name: 1
    }
).sort({ name: -1 })

// Nombre de restaurants 
db.restaurants.find(
    {
        $and: [
            { cuisine: "Italian" },
            { "grades.score": 10 }
        ]
    },
    {
        _id: 0,
        "grades.score": 1
    }
).count()

// Combien de restaurant(s) Italian qui n'ont jamais obtenu de score 10 ? 

db.restaurants.find(
    {
        $and: [
            { cuisine: "Italian" },
            { "grades.score": { $not: { $eq: 10 } } }
        ]
    },
    {
        _id: 0,
        "grades.score": 1
    }
).count()

// ou sinon on calcule la différence suivante 
let totalItalianResScore10 = db.restaurants.find(
    {
        $and: [
            { cuisine: "Italian" },
            { "grades.score": 10 }
        ]
    },
    {
        _id: 0,
        "grades.score": 1
    }
).count()

let totalRestaurantItalian = db.restaurants.find(
    {
        cuisine: "Italian"
    },
    {
        _id: 0,
        "grades.score": 1
    }
).count()

print(totalRestaurantItalian - totalItalianResScore10);

// 02

db.restaurants.find(
    {
        $and: [
            { "grades.grade": "A" },
            { "grades.score": { $gte: 20 } }
        ]
    },
    {
        _id: 0,
        "name": 1,
    }
).sort({ name: - 1 })

db.restaurants.find(
    {
        $and: [
            { "grades.grade": "A" },
            { "grades.score": { $gte: 20 } }
        ]
    },
    {
        _id: 0,
        "name": 1,
    }
).count()

// 04 méthode distinct
db.restaurants.distinct("borough")

// 05 méthode distinct
db.restaurants.distinct("cuisine", { borough: "Bronx" })

// 06 les restaurants du Bronx ayant eu 4 notations (grades)
db.restaurants.find(
    {
        $and: [
            { borough: "Bronx" },
            { "grades": { $size: 4 } }
        ]
    },
    {
        _id: 0,
        name: 1,
        grades: 1
    }
).sort({ name: - 1 })

// 07 Les restaurants du Bronx ayant eu A ou B dans leurs grades.grade

db.restaurants.find(
    {
        $and: [
            { borough: "Bronx" },
            { "grades.grade": { $in: ["A", "B"] } }
        ]
    },
    {
        _id: 0,
        name: 1,
        grades: 1
    }
)

// que des A dans grades
// pour chercher tous les types de notation grade on a fait db.restaurants.distinct("grades.grade")
db.restaurants.find(
    {
        $and: [
            { borough: "Bronx" },
            { "grades.grade": { $not: { $in: ['B', 'C', 'Not Yet Graded', 'P', 'Z'] } } }
        ]
    },
    {
        _id: 0,
        name: 1,
        grades: 1
    }
)

// 08 
db.restaurants.find(
    {
        $and: [
            { borough: "Bronx" },
            { "grades.0.grade": { $in: ["A", "B"] } }
        ]
    },
    {
        _id: 0,
        name: 1,
        grades: 1
    }
)

// 09 le i dans la regex indique insensible à la casse
db.restaurants.find({ name: /coffee/i }, { _id: 0, name: 1 })
db.restaurants.find({ name: /coffee/i }, { _id: 0, name: 1 }).count()

db.restaurants.find({ $and: [{ name: /coffee/i }, { borough: "Bronx" }] }, { _id: 0, name: 1 })
db.restaurants.find({ $and: [{ name: /coffee/i }, { borough: "Bronx" }] }, { _id: 0, name: 1 }).count()

// 10. Trouvez tous les restaurants avec Coffee ou Restaurant et qui ne contiennent pas le mot Starbucks
db.restaurants.find(
    {
        $and: [
            { name: { $in: [/Coffee/, /Restaurant/] } },
            { name: { $nin: [/Starbucks/] } }
        ]
    },
    { _id: 0, name: 1 }
)

// 11. Trouvez tous les restaurants 

db.restaurants.find({
    $and: [
        { name: { $regex: /coffee/i } },
        { borough: { $in: ['Bronx', 'Brooklyn'] } },
        { grades: { $size: 4 } }
    ]
}, { _id: 0, name: 1, borough: 1, grades: 1 })

// 12. Affichez les noms en majuscule

db.restaurants.find({
    $and: [
        { name: { $regex: /coffee/i } },
        { borough: { $in: ['Bronx', 'Brooklyn'] } },
        { grades: { $size: 4 } }
    ]
}, { name: { $toUpper: "$name" }, _id: 0 })

// 13. Affichez tous les scores que les restaurants ont pu avoir
db.restaurants.distinct("grades.score")

// 14. Quels sont les restaurants qui n'ont pas eu de score ? 
db.restaurants.find({"grades" : { $size : 0 } }, { _id : 0, grades : 1, name : 1} ).count()

//  il y a des restaurants sans grades.score ?
db.restaurants.find({"grades.score" : { $exists : false } }, { name : 1} ).count()

//  il y a des restaurants sans grades ?
db.restaurants.find({"grades" : { $exists : false } }, { name : 1} ).count()
db.restaurants.find({"grades.score" : -1 }, { name : 1} )

