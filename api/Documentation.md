# *Documentation de l'API AAA*

# ## Utilisation

L'API renvoie les données au format JSON. Elle ne s'utilise qu'avec GET et aucune authetification n'est requise. Elle permet de récupérer les données grâce à une requête du type: 
`GET http://{ip}/4eti-tidal-projet-tidal_grp_a_4/api/getdiseases.php` 
Cette requête permet de récupérer toutes les pathologies de la base de données. On peut, si l'on souhaite récupérer les information d'une seule pathologie en ajoutant `/{id}` à la fin de la requête.
Il est aussi possible de récupérer la liste des utilisateurs mais je n'ai malheureusement pas eu le temps de la finir. Actuellement, on récupère les données de chaque utilisateurs (son mot de passe compris ....). La requête fonctionne de la meme manière que la précédente:
`GET http://{ip}/4eti-tidal-projet-tidal_grp_a_4/api/getusers.php` et on peut ne récupérer que les infos d'un utilisateur: il suffit d'jouter `/{id}` de l'utilisateur'

