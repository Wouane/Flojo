#TaggedTwitter 

##Concept
TaggedTwitter est fortement inspiré de Twitter, à l'exception que la communauté ne peut publier des messages portant que sur un seul sujet à la fois. 

Ce sujet (tag) est déterminé automiquement, et est modifié toutes les 10 minutes. 

##Cahier des charges, *a minima*, pour la V1

###Utilisateurs
Il doit évidemment être possible de s'inscrire sur le site. Il est d'ailleurs nécessaire de le faire avant de pouvoir poster ou consulter des messages, ou de visualiser les différents profils.

Au moment de l'inscription, seuls l'email, le pseudo et le mot de passe sont demandés. 

Une fois l'inscription réalisée, l'utilisateur est amené à compléter son profil, en y ajoutant une courte présentation de lui même (140 caractères max.), et une photo. 

###Tags
Les tags sont choisis parmi une base de tags, et le tag du moment est renouvelé à toutes les 10 minutes. 

Les messages postés pendant ces 10 minutes sont donc nécessairement reliés au tag actuel. Le tag actuel est graphiquement mis en évidence sur le site. 

Une liste des x derniers tags devrait être affichée, afin de permettre aux utilisateurs de voir les messages rédigés sur ceux-ci. 

###Messages
#####Création
Un message doit avoir au maximum 140 caractères. Il est possible d'y adjoindre, en plus, une url et/ou une image.

#####Lecture
La page principale du site pour les utilisateurs connectés affiche la liste de tous les messages, du plus récent au plus ancien. Le tag sur lequel ils portaient doit graphiquement être mis en évidence.

L'auteur (nom et pic), la date, le message, l'image et/ou l'url doivent être affichés, de même que le bouton "étoile" (favori), auprès duquel s'affiche le nombre d'étoiles reçues.

Il doit être possible de n'afficher que les messages portant sur un tag précis. 

Il doit être possible de n'afficher que les messages d'un utilisateur, en se rendant sur la page de celui-ci. 

Il doit être possible de n'afficher que les messages mis en favoris par n'importe quel utilisateur.

#####Modification/Suppresion
Une fois publié, un message ne peut plus être modifié. Il peut toutefois être supprimé par son auteur. 

#####Étoiles
Un utilisateur peut ajouter un message à sa liste de messages favoris, en cliquant sur l'étoile présente auprès de chaque message. En recliquant sur l'étoile, l'utilisateur retire le message de ses favoris. 

La liste des favoris est évidemment consultable par l'utilisateur, mais également par les autres. 

###Back-office
Les administrateurs du site ont évidemment besoin d'un back-office. Dans celui-ci, ils doivent pouvoir réaliser les actions suivantes : 

- Gérer les tags (ajout, suppresion, modification, consultation)
- Bannir des utilisateurs


##Méthodologie
Quelques conseils afin de bien démarrer : 

1. Faire une liste précise des tâches à accomplir (pages et fonctionnalités)
2. Entendez-vous sur la structure des dossiers, nommage des fichiers
3. Faites la structure de la base de données ensemble (grandes lignes au moins)
4. Faites une maquette sur papier ensemble  (grandes lignes au moins) 
5. Créer un dépôt git sur le github.com de l'un d'entre vous
6. Cloner tous ce dépôt en local
7. Distribuez-vous les tâches
8. Go

##Équipes

#####FreTo
- Tony
- Frédéric

#####JuNi
- Julien
- Nicolas

#####AlSe
- Ali
- Sébastien

#####JeAl
- Alexandre
- Jérôme

#####FloJo
- Florian
- Joël

#####DeNaMy
- My-Dao
- Nadia
- Denis

##Idées pour la V2

- Possibilité de ne suivre que certains utilisateurs
- Messages privés entre utilisateurs
- Recherche par mots-clefs
- Possibilité de poster des vidéos Youtube
- Système de "réponses" aux messages
- Back-office : gérer l'ordre des tags

##Nouvelles notions à voir

- Intro à AJAX (jeudi fin de journée)
- Upload de fichier en PHP (vendredi matin)
- Jointures SQL (lundi matin)
