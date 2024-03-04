// use shop; // connexion et ou création de la base de données si elle n'existe pas

db.createCollection("inventory");

db.inventory.insertMany([{
    "sale": true, "price": 0.99,
    "society": "Alex", type: "postcard", qty: 19,
    size: { h: 11, w: 29, uom: "cm" },
    status: "A",
    tags: ["blank", "blank", "blank"],
    "year": 2019
},
{
    "sale": false,
    "price": 1.99,
    "society": "Alan",
    type: "journal",
    qty: 25,
    size: { h: 14, w: 21, uom: "cm" },
    status: "A",
    tags: ["blank", "red", "blank", "blank"],
    "year": 2019
},
{
    "sale": true,
    "price": 1.5,
    "society": "Albert",
    type: "notebook",
    qty: 50,
    size: { h: 8.5, w: 11, uom: "in" },
    status: "A",
    tags: ["gray"],
    year: 2019
},
{
    "sale": true,
    "price": 7.99,
    "society": "Alice",
    type: "lux paper",
    qty: 100,
    size: { h: 8.5, w: 11, uom: "in" },
    status: "D",
    year: 2020
},
{
    "sale": true,
    "price": 2.99,
    "society": "Sophie",
    type: "planner",
    qty: 75,
    size: { h: 22.85, w: 30, uom: "cm" },
    status: "D",
    tags: ["gel", "blue"],
    year: 2017
},
{
    "sale": false,
    "price": 0.99,
    "society": "Phil",
    type: "postcard",
    qty: 45,
    size: { h: 10, w: 15.25, uom: "cm" },
    status: "A",
    tags: ["gray"],
    year: 2018
},
{
    "sale": true,
    "price": 4.99,
    "society": "Nel",
    type: "journal",
    qty: 19,
    size: { h: 10, w: 21, uom: "cm" },
    status: "B",
    tags: ["blank", "blank", "blank", "red"],
    "year": 2019,
    level: 100
},
{
    "sale": true,
    "price": 4.99,
    "society": "Alex",
    type: "journal",
    qty: 15,
    size: { h: 17, w: 20, uom: "cm" },
    status: "C",
    tags: ["blank"],
    "year": 2019
},
{
    "sale": false,
    "price": 5.99,
    "society": "Tony",
    type: "journal",
    qty: 100,
    size: { h: 14, w: 21, uom: "cm" },
    status: "B",
    tags: ["blank", "blank", "blank", "red"],
    "year": 2020
},
]);


// la somme des quantités des produits par type
//  _id : "$type" pour regrouper en fonction des type
db.inventory.aggregate([
    { $group: { _id: "$type", count: { $sum: 1 } } }
])

// somme des quantités par type journal
db.inventory.aggregate([
    { $match: { type: "journal" } }, // match correspond à un where en SQL 
    { $group: { _id: "$type", total: { $sum: "$qty" } } }
])

// filtrer avec match, attention il faut absolument mettre l'attribut _id dans le $group le fait de mettre null sa regroupe tous les documents
db.inventory.aggregate([
    { $match: { type: "journal" } }, // match correspond à un where en SQL 
    { $group: { _id: null, total: { $sum: "$qty" } } }
])

// compter le nombre de documents avec un aggregate
db.inventory.aggregate([
    { $group: { _id: null, count: { $sum: 1 } } }
])


// somme des prix
db.inventory.aggregate([
    { $group: { _id: "$type", total: { $sum: "$price" } } }
])


// total des prix multiplié par leur quantité respective regroupé par type
db.inventory.aggregate([
    { $group: { _id: "$type", total: { $sum: { $multiply: ["$price", "$qty"] } } } }
])

// supposons que l'on ait une TVA 20% et que les prix soient HT 
db.inventory.aggregate([
    { $group: { _id: "$type", total: { $sum: { $multiply: ["$price", "$qty", 1.2] } } } }
])

// 02. Affichez les noms de sociétés depuis 2018 avec leur quantité (sans agrégation).

db.inventory.find(
    { year: { $gte: 2018 } },
    { _id: 0, society: 1, year: 1 }
)

// 03. Affichez les types des articles pour les sociétés dont le nom commence par A.
db.inventory.find(
    { society: /^A/ },
    { _id: 0, type: 1, society: 1 }
)

// 04. Affichez le nom des sociétés dont la quantité d'articles est supérieur à 45.

db.inventory.find(
    { qty: { $gt: 45 } },
    { _id: 0, society: 1, qty: 1 }
)

// 05. Affichez le nom des sociétés dont la quantité d'article(s) est strictement supérieur à 45 et inférieur à 90.

db.inventory.find(
    { qty: { $gt: 45, $lt: 90 } },
    { _id: 0, society: 1, qty: 1 }
)

// 06. Affichez le nom des sociétés dont le statut est A ou dont le type est journal.

db.inventory.find(
    {
        $or: [
            { type: "journal" },
            { status: "A" }
        ]
    },
    { _id: 0, society: 1, qty: 1, status: 1 }
)

// ==============
// 7. Affichez le nom des sociétés dont le statut est A ou le type est journal et la quantité inférieur strictement à 100.
// ==============

db.inventory.find(
    {
        $and: [
            { qty: { $lt: 100 } },
            {
                $or: [{ status: "A" }, { type: "journal" }]
            }
        ]
    }).sort({ society: 1 }).forEach(invent => {
        console.log(invent.society, invent.qty);
    });

// ==============
// 8. Affichez le type des articles qui ont un prix de 0.99 ou 1.99 et qui sont true pour la propriété sale ou ont une quantité strictement inférieur à 100.
// ==============

db.inventory.find(
    {
        $and: [
            { $or: [{ price: 0.99 }, { price: 1.99 }] },
            { $or: [{ sale: true }, { qty: { $lt: 45 } }] }
        ]
    },
    { society: 1 }
).sort({ society: 1 })

// 09. Affichez le nom des sociétés et leur(s) tag(s) si et seulement si ces sociétés ont au moins un tag.

db.inventory.find(
    {
        tags : { $exists : true }
    },
    {_id : 0, society : 1, tags : 1}
)

// 10. Affichez le nom des sociétés qui ont au moins un tag blank.

db.inventory.find(
    {
        tags : "blank"
    },
    {_id : 0, society : 1, tags : 1}
)

// avec un in 
db.inventory.find(
    {
        tags : { $in : ["blank"]}
    },
    {_id : 0, society : 1, tags : 1}
)

// limit
db.inventory.find().sort( { society: 1 } ).limit( 3 );
db.inventory.find().limit( 3 ).sort( { society: 1 } );


// Augmentation 

db.inventory.updateMany(
    { $or : [ 
        { status : "C" },
        { status : "D" },
    ] },
    { 
        $mul : { qty : 1.5 }
    }
)

// Augmentez maintenant de 150% les documents ayant un status A ou B et au moins un tag blank.

