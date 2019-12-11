<?php
namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Priority;
use App\Entity\Project;
use App\Entity\State;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use joshtronic\LoremIpsum;
use \Datetime;

/**
 * @author Aaam Nielski
 * @copyright Aaam Nielski
 * Class ProjectFixture
 * @package App\DataFixtures
 */
class ProjectFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $aPriority = $manager->getRepository(Priority::class)->findAll();
        $aState = $manager->getRepository(State::class)->findAll();

        $lipsum = new LoremIpsum();
        for($i=0;$i<20;$i++) {
            $Customer = new Customer();
            $Customer->setName( $lipsum->words(1) );
            $Customer->setSurname( $lipsum->words(1) );
            $manager->persist($Customer);
            for($j=0;$j<20;$j++) {
                $Project = new Project();
                $Project->setName($lipsum->words(5));
                $Project->setCustomer($Customer);
                $manager->persist($Project);

                $User = new User();
                $User->setLogin($lipsum->words(1));
                $User->setCustomer($Customer);
                $User->setDescription($lipsum->words(50));
                $manager->persist($User);

                $closed = 0;
                for($j=0;$j<20;$j++) {
                    $Task = new Task();
                    $Task->setName( $lipsum->words(1) );
                    $Task->setDescription( $lipsum->words(50) );
                    $Task->setDate( DateTime::createFromFormat('Y-n-j', "2019-" . rand(1,12) . "-" . rand(1,28)));
                    $Task->setState( $aState[rand(0,1)] );
                    $Task->setPriority( $aPriority[rand(0,1)] );
                    $Task->setProject($Project);
                    $Task->setUser($User);
                    $manager->persist($Task);
                    $Task->getState()->getId()!=State::STATE_CLOSED?:$closed++;
                }
                $Project->setProgress($closed/20 * 100);
                $manager->persist($Project);
            }
        }
        $manager->flush();
    }
}
