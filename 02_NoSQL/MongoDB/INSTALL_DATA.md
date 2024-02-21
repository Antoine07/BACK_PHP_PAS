# MongoDB commands

```bash
# docker ou avec login/pass
# mongoimport --host localhost --port 27017 --username root --password example --authenticationDatabase admin --db ny --collection Restaurants --file restaurants.json

# En local dans le dossier des données
mongoimport --host=localhost --port=27017 --db=ny --collection=Restaurants --file=restaurants.json
```

