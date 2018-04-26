<?php

namespace DigitalTavern\Application\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 *
 * Repository of user entity
 *
 * @package DigitalTavern\Application\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * Finds available users
     *
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function findAvailable(int $offset, int $limit)
    {
        return $this->createQueryBuilder('u')
            ->where('u.currentSession is null and u.lastActivityDate > :expire')
            ->setParameter('expire', new \DateTime('now - 5 minutes'))
            ->orderBy('u.lastActivityDate', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds users by query (IGN)
     *
     * @param string $ign
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function findByQuery(string $ign, int $offset, int $limit)
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.profile', 'p')
            ->where('u.currentSession is null and u.lastActivityDate > :expire and p.ign like :ign')
            ->setParameters([
                'expire' => new \DateTime('now - 5 minutes'),
                'ign' => '%'.$ign.'%'
            ])
            ->orderBy('u.lastActivityDate', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}