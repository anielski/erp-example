<?php
namespace App\Repository;

use App\Entity\Project;
use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TaskRepository
 * @package App\Repository
 * @author Aaam Nielski
 * @copyright Aaam Nielski
 */
class TaskRepository extends EntityRepository
{
    /**
     * Returns all project tasks oder by state OPEN
     * @see State ID=0 is allways is OPEN
     * @param $id
     * @return mixed
     */
    public function findAllForProject( $id )
    {
        return $this->createQueryBuilder('task')
            ->where('task.project = :id')
            ->setParameter('id', $id)
            ->orderBy("task.state", "ASC")//default: order by first state
            ->getQuery()
            ->execute();
    }

    /**
     * Return all tasks for project where percent tasks is 50% and from last month.
     * @return mixed
     */
    public function findAllHalfTasks() {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('App\Entity\Task', 'task');
        $SQL ="
            SELECT task.* FROM task                 
                WHERE task.date >= DATE_SUB(DATE(Now()), INTERVAL 1 MONTH) 
                AND task.project_id = ( 
                    SELECT project.id FROM project 
                        WHERE project.progress > 50 limit 1)";
        return $this->getEntityManager()->createNativeQuery( $SQL, $rsm)->getResult();

    }
}