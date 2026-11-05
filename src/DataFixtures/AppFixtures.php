<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use App\Entity\Categorie;
use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Catégories 
        $action = new Categorie();   //1.créer l'objet
        $action->setNom('Action');   //2.remplir ses propriétés
        $manager->persist($action);  //3.le préparer 

        $comedie = new Categorie();   //1.créer l'objet
        $comedie->setNom('Comedie');  //2.remplir ses propriétés
        $manager->persist($comedie);  //3.le préparer 

        $drame = new Categorie();      //1.créer l'objet
        $drame->setNom('Drame');       //2.remplir ses propriétés
        $manager->persist($drame);     //3.le préparer 

        // Acteurs
        $acteur1 = new Acteur();
        $acteur1->setNom('Poelvoorde');
        $acteur1->setPrenom('Benoit');
        $acteur1->setDateNaissance(new \DateTime('1966-09-22'));
        $acteur1->setSexe('M');
        $manager->persist($acteur1);

        $acteur2 = new Acteur();
        $acteur2->setNom('Martin');
        $acteur2->setPrenom('Lydia');
        $acteur2->setDateNaissance(new \DateTime('1968-07-07'));
        $acteur2->setSexe('F');
        $manager->persist($acteur2);

        $acteur3 = new Acteur();
        $acteur3->setNom('Sull');
        $acteur3->setPrenom('Bob');
        $acteur3->setDateNaissance(new \DateTime('1970-01-01'));
        $acteur3->setSexe('M');
        $manager->persist($acteur3);

        //Films
        $film1 = new Film();
        $film1->setTitre('C\'est arrivé près de chez vous');
        $film1->setDescription('Un tueur en série suivi par une équipe de tournage.');
        $film1->setCategorie($drame);  //l'objet catégorie, pas le texte 'Drame'
        $film1->addActeur($acteur1);   //l'objet acteur
        $manager->persist($film1);

        $film2 = new Film();
        $film2->setTitre('Lupin');
        $film2->setDescription('Un homme s\'inspirant des méthodes d\'Arsène Lupin');
        $film2->setCategorie($action);
        $film2->addActeur($acteur2);
        $film2->addActeur($acteur3);
        $manager->persist($film2);

        $film3 = new Film();
        $film3->setTitre('Le Dîner de cons');
        $film3->setDescription('un éditeur qui tente de se débarrasser d’un invité de ses fameux « dîners de cons »');
        $film3->setCategorie($comedie);
        $film3->addActeur($acteur3);
        $manager->persist($film3);


        $manager->flush();                //4.tout envoyer en base  
    }
}
