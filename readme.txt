14/09/2017

- Forkez le projet uploadImg sur votre compte
- Créez un projet pour travailler sur votre fork (et uniquement celui-là) (conseil: utilisez les branches pour vos différentes versions et pouvoir corriger une erreur éventuelle)
- Créez un formulaire de connexion sur toutes les pages permettant la connexion d'un utilisateur venant de la table users
- Créez un c/ConnectController.php
- Créez un m/Users.php et m/UsersManager.php
- Créez une les dossiers v/upload/original |  v/upload/resize |  v/upload/thumbs
- Lorsque l'on est pas connecté, on ne peut pas ajouter de photos
- Si on est connecté on peut ajouter une photo (! à l'id de l'utilisateur qui doit être ajouté à Images.php et ImagesManager.php, venant de votre session d'identification) et il existe un lien déconnexion

15/09/2017

Voir première partie finie sur https://github.com/mikhawa/uploadImg

- Créez un c/AdminController.php

index.php redirige vers les 3 contrôleurs suivant les besoins:

Donc: c/ImagesController.php => accueil et catégories hors connexion
donc: c/ConnectController.php => connexion et déconnexion
donc: c/AdmintController.php => On est connecté, accueil et catégories + formulaire d'envoie