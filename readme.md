# Intervenants
* Cédric Bernier <cedric.bernier@deboeck.com> : Développeur
* Marc Hendrix <marc.hendrix@deboeck.com> : Responsable produit
* Jérôme Klam <jerome.klam@deboeck.com> : Développeur
* Patrice Wilvers <patrice.wilvers@deboeck.com> : Développeur

# TODO
* Automatiser l'export des "data"
* Tout intégrer en non phar (cf libs, ...)

# Installation

## VirtualHost



# Déploiement

## Important

* On ne développe que dans les branches. Jamais sur master
* Faites régulièrement un Pull pour récupérer les drnières modifs
* N'hésitez pas à créer des branches pour des corrections de bug

## Documenter

Les fichiers au format .md (format utilisé dans gitlab nativement) servent de base pour la documentation
* Il faut savoir que gitlab affiche automatiquement le fichier readme.md lorsque l'on navigue dans un répertoire.
* A la racine du projet c'est la doc principale qui permet également d'aiguiller vers les autres fichiers .md (readme ou autres)
* Un fichier release-fr.md (on verra pour un nl, en) est utilisé pour centraliser les modifications faites. Il remplace les anciens fichiers de /doc/release

PS : outil : MarkdownPad2 par exemple


## Déployer

* Préparation
    * Mettre à jour les docs si besoin
    * Mettre à jour le fichier release-fr.md
    * Faire un commit / push avec explications
* Gitlab
    * Le développement se fait sur des branches
    * Le déploiement est basé par défaut sur master
    * Il faut donc effectuer des merge-request pour "pousser" une branche vers "master"
    * On reprend le projet en local (pull) pour vérifier que tout est bon
* Jenkins
    * TOut d'abord un ci (vérifier qu'il soit bien vert) http://10.10.10.137:8080/view/dbdig-ci/job/dbdig-dms/
    * Et si tout est ok un deploy un choississant l'environnement (vérifier le ci avant) http://10.10.10.137:8080/view/dbdig-deploy/job/dbdig-dms.deploy/


# Utile

* Comment développement [doc/dev.md](doc/dev.md)

* Déploiement srv-web-edu [https://git.larciergroup.com/dbdig/srv-web-edu/blob/master/projects/dms/readme.md](https://git.larciergroup.com/dbdig/srv-web-edu/blob/master/projects/dms/readme.md "Readme")



