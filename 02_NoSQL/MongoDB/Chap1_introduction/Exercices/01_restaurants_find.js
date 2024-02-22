// comme un fetch en PHP vous devez itérer dessus pour récupérer les données

let cursorRestaurants2 = db.restaurants.find(); 
let count  = 0; 
for (const restaurant of db.restaurants.find()) {
    count = count + 1 ;
}

print(count);

// Exercice 
/*
 Combien y a t il de restaurants qui font de la cuisine italienne et qui ont eu au moins une fois un score de 10 ?

 Affichez également le nom, les scores et les coordonnées GPS de ces restaurants. Ordonnez les résultats par ordre décroissant sur les noms des restaurants.

*/

db.restaurants.find(
    {
        $and : [
        { cuisine : "Italian"},
        { "grades.score" : 10 }
        ]
    },
    {
        _id : 0,
        "grades.score"  : 1
    }
)

db.restaurants.find(
    {
        $and : [
        { cuisine : "Italian"},
        { "grades.score" : 10 }
        ]
    },
    {
        _id : 0,
        "grades.score"  : 1,
        name : 1
    }
).sort({ name : -1 })

// Nombre de restaurants 
db.restaurants.find(
    {
        $and : [
        { cuisine : "Italian"},
        { "grades.score" : 10 }
        ]
    },
    {
        _id : 0,
        "grades.score"  : 1
    }
).count()

// Combien de restaurant(s) Italian qui n'ont jamais obtenu de score 10 ? 

db.restaurants.find(
    {
        $and : [
        { cuisine : "Italian"},
        { "grades.score" : { $not : { $eq : 10 }} }
        ]
    },
    {
        _id : 0,
        "grades.score"  : 1
    }
).count()

// ou sinon on calcule la différence suivante 
let totalItalianResScore10 = db.restaurants.find(
    {
        $and : [
        { cuisine : "Italian"},
        { "grades.score" : 10 }
        ]
    },
    {
        _id : 0,
        "grades.score"  : 1
    }
).count()

let totalRestaurantItalian = db.restaurants.find(
    {
       cuisine : "Italian"
    },
    {
        _id : 0,
        "grades.score"  : 1
    }
).count()

print(totalRestaurantItalian - totalItalianResScore10);