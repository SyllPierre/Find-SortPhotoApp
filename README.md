# Find-SortPhotoApp
Projet de fin d'année de M2-E-Services.

Voici le projet d'application photo :

Pour utiliser l'application il faut posséder sur votre machine :

 - `php`
 - `apache2`
 - `mySql`
 - `phpMyadmin`

Dans le dossier `PhotoApp` il y a un fichier `initDb.sql` que vous devez exécuter dans votre base de données.

Ensuite, n'oubliez pas de changer vos identifiants de connexion dans `db_conn.php`.

Ensuite, lancer l'application et c'est bon, vous pouvez utiliser l'application et vous n'avez plus rien à toucher.



[Voici une vidéo de présentation de l'utilisation de l'application](https://www.youtube.com/watch?v=j6KB8G3duwU) : `https://www.youtube.com/watch?v=j6KB8G3duwU`.



Pour les choix techniques, j'ai utilisé la solution php car c'est un language que je connais très bien pour pouvoir faire quelque chose de propre rapidement. Sans parler de la gestion des formulaires et du diaporama qui a été nettement facilité avec ce language (surtout qu'il existe beaucoup de documentation et d'exemples sur ce language sur internet).

L'architecture est simple et basique, il y peu de pages.

Pour la code, il n'y a rien de très compliqué à expliquer, j'utilise beaucoup de formulaires pour récupérer les données à Upload ou à utiliser pour le diaporama.

Il y a également un peu de `javascript` pour le diaporama pour démarrer, arrêter le diaporama ou encore gérer la transition du diaporama. 
