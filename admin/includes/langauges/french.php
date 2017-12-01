<?php

if( function_exists('lang') == FALSE ) {
function lang($phrase){
    static $lang = array(
            // navbar
          'HOME'           =>   'Elgadah',
          'CATEGORIES'     =>   'Catégories',
          'ITEMS'          =>   'Items',
          'MEMBERS'        =>   'Members',
          'COMMENTS'       =>   'Commentaires',
          'LANGUAGE'       =>   'language',


          // dashboard
          'DASHBOARD'                         =>   'Tableau de bord',
          'TOTAL MEMBERS'                     =>   'Membres total',
          'PENDING MEMBERS'                   =>   'Membres en attente',
          'TOTAL ITEMS'                       =>   'Total items',
          'TOTAL COMMENTS'                    =>   'Commentaires total',
          'LASTEST 5 REGISTERED USERS'        =>   'Derniers 5 utilisateurs enregistrés',
          'LASTEST 5 ITEMS'                   =>   'Derniers 5 éléments',
          'LASTEST 5 COMMENTS'                =>   'Derniers 5 commentaires',
          'THERES NO ITEM TO SHOW'            =>   'Il n\'y a aucun élément à afficher',

          // categories
          'MANGE CATEGORIES'           =>   'Mange Catégories',
          'ORDERING:'                  =>   'Ordering:',
          'ASC'                        =>   'Asc',
          'DESC'                       =>   'Desc',
          'VIEW'                       =>   'Vue',
          'FULL'                       =>   'Complet',
          'CLASSIC'                    =>   'Classique',
          'NEW CATEGORY'               =>   'Nouvelle catégorie',
          'THERES NO ITEM TO SHOW'     =>   'Il n\'y a aucun élément à afficher',
          'NEW ITEM'                   =>   'Nouvelle catégorie',
          'NAME'                       =>   'Name',
          'DESCRIPTION'                =>   'Description',
          'ORDERING'                   =>   'Ordering',
          'PARENT'                     =>   'Parent?',
          'NONE'                       =>   'None',
          'VISIBILITY'                 =>   'ViSibilité',
          'YES'                        =>   'Oui',
          'NO'                         =>   'Non',
          'COMMENTING'                 =>   'Commentaire',
          'YES'                        =>   'Oui',
          'NO'                         =>   'Non',
          'ALLOW ADS'                  =>   'Autoriser les annonces',
          'YES'                        =>   'Oui',
          'NO'                         =>   'Non',
          'ADD CATEGORY'               =>   'Ajouter catégorie',
          'UPDATED CATEGORY'           =>   'Mise à jour de la catégorie',
          'EDIT CATEGORY'              =>   'Modifier la catégorie',// COPY FROM HERE
          'SAVE'                       =>   'Enregistrer',
          'DELETED CATEGORY'           =>   'DSupprimer la catégorie',

          // members
          'MANGE MEMBERS'           =>   'Mange Members',
          'ID'                      =>   '#Id',
          'AVATAR'                  =>   'Avatar',
          'USERNAME'                =>   'Nom d\'utilisateur',
          'EMAIL'                   =>   'Email',
          'FULL NAME'               =>   'Nom complet',
          'REGISTERED'              =>   'Date enregistrée',
          'CONTROL'                 =>   'Contrôle',
          'NEW MEMBERS'             =>   'Nouveau Membre',
          'ADD NEW MEMBER'          =>   'Ajouter un nouveau membre',
          'USERNAME'                =>   'Nom d\'utilisateur',
          'PASSWORD'                =>   'Mot de passe',
          'EMAIL'                   =>   'Email',
          'NAME'                    =>   'Nom complet',
          'USER AVATAR'             =>   'Avatar de l\'utilisateur',
          'INSERT MEMBERS'          =>   'Insérer membre',
          'EDIT MEMBERS'            =>   'Editer membre', // COPY FROM HERE
          'SAVE'                    =>   'Enregistrer',
          'UPDATED'                 =>   'Update Member',
          'DELETED'                 =>   'Supprimer membre',
          'ACTIVATED'               =>   'Activer le membre',

    );
    return $lang[$phrase];
}
}

 ?>
