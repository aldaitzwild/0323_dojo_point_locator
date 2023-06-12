<?php

namespace App\DataFixtures;

use App\Entity\Cell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CellFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) { 
                $cell = new Cell();

                $cell->setLine($i)
                    ->setCol($j)
                    ->setIsHidden(true)
                    ->setValue('patch-question')
                ;

                $manager->persist($cell);
            }
        }

        $manager->flush();
    }
}
