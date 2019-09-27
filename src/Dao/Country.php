<?php

namespace WhiteHatApi\Dao;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class Country
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

    public function getCountries()
    {
        $this->qb->select('DISTINCT gcb.country')
            ->from('game_country_block', 'gcb');

            $res = $this->dbCasino->fetchAll($this->qb->getSQL());

            return array_column($res, 'country');
    }
}