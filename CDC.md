## Titre

Développement d’une application web pour la gestion des produits, ventes et clients d’un magasin de vente de jeux vidéos

## Contexte

M. Mega a récemment ouvert sa boutique spécialisé dans le jeu-vidéo nommé MégaMania. Son magasin connait un succès fulgurant et est sans cesse rempli de clients. Il compte aujourd’hui 150 clients inscrits dont 50 ayant souscris à un abonnement. Pour l’aider, M. Mega a à sa disposition 3 employés qu’il rémunère à un prix fixe plus un bonus en fonction du nombre de ventes dans le mois.

## Problématique

Cela fait maintenant 6 mois que son magasin est ouvert et M. Mega note toutes les ventes, et informations sur ses clients et employés sur des fichiers excel et même sur papier lorsqu’il n’a pas le temps de démarrer son ordinateur. Il doit rester souvent tard le soir pour organiser les données qu’il a noté tout au long de la journée et modifier certaines données en fonction des ventes du jour (exemple : les stocks).

Les problématiques :

- Comment passer moins de temps à gérer toutes ces informations ?
- Comment améliorer l’expérience utilisateur ?
- Comment gérer les stocks plus efficacement ?



## Besoins et contraintes

Besoins :

- Centraliser les produits, les employés, les clients et les ventes dans un seul endroit pour les administrer facilement
- Améliorer l’expérience utilisateur qui n’est pas la meilleur sur les moyens actuels

Contraintes :

- La solution devra fonctionner sur l’équipement informatique de la boutique : des ordinateurs sous Linux.
- La solution sera accessible depuis une interface web.

## Livrables

- La solution deployable via des conteneurs Docker
- La documentation contenant les procédures d'installation et de déploiement et le guide administrateur.

# Réponse au besoin

- **Fonctionnel** → Une IHM permettant de
    - Visualiser les employés, les commandes, les clients, les abonnements, les produits et les catégories.
    - Supprimer, ajouter ou modifier des commandes et des clients
- **Technique :**
    - Le tout relié à une BDD PostgreSQL persistant les données. Rapide, fiable et gratuit.
    - Utilisation de Docker pour simplifier la mise en place côté client (via le principe de VM)
    - La connexion avec la BDD sera réalisé à l’aide de Laravel. Ce framework PHP est maitrisé par les prestataires et permet un code maintenable et performant.
    - La partie visuelle de la webapp sera réalisé à l’aide de Vue.js. Framework simple d’utilisation, performant et qui met en avant la réusabilité du code → Gain de temps et maintenabilité pour les futurs dev.