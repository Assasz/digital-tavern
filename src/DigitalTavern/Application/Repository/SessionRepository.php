<?php

namespace DigitalTavern\Application\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class SessionRepository
 *
 * Repository of session entity
 *
 * @package DigitalTavern\Application\Repository
 */
class SessionRepository extends EntityRepository
{
    /**
     * Finds public sessions
     *
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function findPublic(int $offset, int $limit)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.players', 'p')
            ->where('s.password is null')
            ->groupBy('s.id')
            ->having('s.playersLimit > count(p.id) or s.playersLimit is null')
            ->orderBy('s.createDate', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds public sessions by query
     *
     * @param string $query
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function findPublicByQuery(string $query, int $offset, int $limit)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.players', 'p')
            ->where('s.password is null')
            ->andWhere('s.name like :queryName or s.token like :queryToken')
            ->setParameters([
                'queryName' => '%'.$query.'%',
                'queryToken' => $query.'%'
            ])
            ->groupBy('s.id')
            ->having('s.playersLimit > count(p.id) or s.playersLimit is null')
            ->orderBy('s.createDate', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds private sessions
     *
     * @param string $query
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function findPrivate(string $query, int $offset, int $limit)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.players', 'p')
            ->where('s.password is not null and s.token like :queryToken')
            ->setParameter('queryToken', $query.'%')
            ->groupBy('s.id')
            ->having('s.playersLimit > count(p.id) or s.playersLimit is null')
            ->orderBy('s.createDate', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}