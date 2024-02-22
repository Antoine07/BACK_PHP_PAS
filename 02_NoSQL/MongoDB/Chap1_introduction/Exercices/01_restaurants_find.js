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