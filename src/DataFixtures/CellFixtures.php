<?php

namespace App\DataFixtures;

use App\Entity\Cell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CellFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $arrowMap = [
            '*' => 'asterisk',
            'u' => 'arrow-up',
            'ur' => 'arrow-up-right',
            'r' => 'arrow-right',
            'dr' => 'arrow-down-right',
            'd' => 'arrow-down',
            'dl' => 'arrow-down-left',
            'l' => 'arrow-left',
            'ul' => 'arrow-up-left',
        ];

        $lineAsterisk = rand(0, 9);
        $colAsterisk = rand(0, 9);

        for($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) { 
                $cell = new Cell();

                $cell->setLine($i)
                    ->setCol($j)
                    ->setIsHidden(true)
                    ->setValue('patch-question')
                ;

                $value = '';

                if($i == $lineAsterisk && $j == $colAsterisk) $value = '*';

                if($i < $lineAsterisk) $value = 'd';
                if($i > $lineAsterisk) $value = 'u';
                if($j < $colAsterisk) $value .= 'r';
                if($j > $colAsterisk) $value .= 'l';


                $cell->setValue($arrowMap[$value]);

                $manager->persist($cell);
            }
        }

        $manager->flush();
    }
}
