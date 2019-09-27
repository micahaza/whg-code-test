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

        $res = $this->dbCasino->fetchAll($this->qb->getSQL());
        $ret = [];
        foreach($res as $item) {
            $ret[] = [$item['id'], $item['affiliate']];
        }
        return $ret;
    }
}