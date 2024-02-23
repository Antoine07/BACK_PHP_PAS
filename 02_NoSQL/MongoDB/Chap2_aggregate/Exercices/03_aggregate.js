
// use ny 

db.restaurants.aggregate([
    { $match : {
        cuisine : "American",
        "grades.grade" : "A"
    }} ,
    { $project : {
        _id : 0,
        cuisine : 1,
        fullAddress : {
            $concat : [
                "$address.building",
                " ",
                "$address.street",
                " ",
                "$address.zipcode"
            ]
        },
        fullName : {
            $concat : ["$name", " (" , { $toUpper : "$borough" } , ")"]
        }
    }}
])