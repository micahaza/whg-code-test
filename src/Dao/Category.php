<?php

namespace WhiteHatApi\Dao;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class Category
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

    public function getCategories()
    {
        $this->qb->select('id, name')
            ->from('category');

        $res = $this->dbCasino->fetchAll($this->qb->getSQL());
        $ret = [];
        foreach($res as $item) {
            $ret[] = [$item['id'], $item['name']];
        }
        return $ret;
    }
}