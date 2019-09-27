<?php

namespace WhiteHatApi\Dao;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class Brand
{
    /** @var Connection */
    private $dbCasino;

    /** @var QueryBuilder */
    private $qb;

    public function __construct(Connection $dbCasino)
    {
        $this->dbCasino = $dbCasino;
        $this->qb = $this->dbCasino->createQueryBuilder();
    }

    public function getBrands()
    {
        $this->qb->select('id, affiliate')
            ->from('brand');

        return $this->dbCasino->fetchAll($this->qb->getSQL());
    }
}