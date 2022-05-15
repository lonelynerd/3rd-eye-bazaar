### Projet d'application Web
3rd Eye Bazaar
===
Projet de :
- Théo SALLES
- Louis DUMONTIER

## Important

Suite à des problèmes concernant la création d'une base de données sur le serveur de la Fac, nous avons été contraint d'utiliser une base locale à nos PCs respectifs. 

Ainsi, pour vérifier le bon fonctionnement de ce site, vous devez créer vous-même la base. 

### Etape 1 :
- A travers l'interface de votre choix, créez une base de données. Le nom de la base, le nom d'utilisateur ainsi que le mot de passe doit être choisi par vos soins. **Gardez-ces valeurs de côté, ils seront utiles plus tard !**

### Etape 2 :
- A l'aide des fichiers **.sql** présents dans le dossier **db**, veuillez importer la configuration des deux tables **product** et **account**. Selon l'interface choisie, vous devrez soit choisir l'option **Importer...** et choisir le(s) fichier(s) **.sql**, soit ouvrir les deux fichiers avec un logiciel de traitement de texte et copier-coller leurs contenus dans un invite SQL.

### Etape 3 :

- Dans le fichier **database.php**, veuillez renseigner dans l'ordre :
    - **DBURL** -> L'adresse d'accès à la base de données. Si vous utilisez **LAMP** ou **XAMPP** par exemple, l'adresse sera **"localhost"**
    - **DBUSR** -> Le nom d'utilisateur
    - **DBPWD** -> Le mot de passe
    - **DBNAM** -> Le nom de la base de données
```php

<?php

define("DBURL","[veuillez compléter la donnée]");

define("DBUSR","[veuillez compléter la donnée]");

define("DBPWD","[veuillez compléter la donnée]");

define("DBNAM","[veuillez compléter la donnée]");

?>

```
- Si une de ces valeur n'est pas renseignée, une erreur s'affichera dés l'ouverture du fichier **index.php**.

## A propos du .htaccess

- En cas d'erreur 404, 403 ou 500, une page personnalisée est censé être affichée, ces pages étant respectivement **404.php**, **403.php**, **500.php**. Si une page blanche s'affiche en place et lieu du fichier erreur, veuillez éditer le fichier **.htaccess** avec l'adresse **DIRECTE** vers les fichiers susnomés.

## Arborescence du projet

```

3rdEyeBazaar
│   README.md
│   .htaccess -> fichier gérant la page à afficher en cas d'erreur
|   trash.old -> fichier contenant des versions obselètes de certaines fonctions
|
└───css -> contient tous les fichiers css des pages php
|
└───ct -> contient les messages envoyés à travers l'outil "Contact Us"
|
└───db -> contient les fichiers de génération de tables pour la base de données
|
└───ft -> contient les polices de caractères
|
└───im -> contient les images utilisés par le site
|   |
|   └───sk -> contient les fichiers vectoriels servant de base pour certaines images du site
|   |
|   └───tr -> archive contenant des anciennes versions de certaines images de im
|
└───im-part -> contient les images utilisés par les annonces postés sur le site
|
└───vd -> contient des vidéos utilisés par le site

```