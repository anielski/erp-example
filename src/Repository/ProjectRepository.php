<?php
namespace App\Repository;

use App\Entity\Priority;
use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ProjectRepository
 * @package App\Repository
 * @author Aaam Nielski
 * @copyright Aaam Nielski
 */
class ProjectRepository extends EntityRepository
{
    /**
     * Return all projekcts
     * @return mixed
     */
    public function findAll()
    {
        return $this->createQueryBuilder('project')
            ->leftJoin('project.customer', 'customer')
            ->getQuery()
            ->execute();
    }

    /**
     * Return all projects with high priority tasks and sort by name project field ASC
     * @return mixed
     */
    public function findAllHighTasks() {
        return $this->createQueryBuilder('project')
            ->leftJoin('project.customer', 'customer')
            ->join('project.tasks', 'task')
            ->where( 'task.priority = :idPr')->setParameter('idPr', Priority::STATE_HIGH)
            ->orderBy("project.name", "ASC")
            ->getQuery()
            ->execute();
    }
}