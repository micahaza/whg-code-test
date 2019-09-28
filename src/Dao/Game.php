<?php

namespace WhiteHatApi\Dao;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class Game
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

    public function getGames($brand = null, $country = null, $category = null)
    {

        $this->qb->select('g.id, g.name, g.launchcode, g.rtp')
            ->from('game', 'g')
            ->where('g.active = 1');

        /*
        $this->qb->select('g.id, g.name, g.launchcode, g.rtp')
            ->leftJoin('g', 'game_country_block', 'gcb', 'g.launchcode = gcb.launchcode')
            ->leftJoin('g', 'game_brand_block', 'gbb', 'g.launchcode = gbb.launchcode')
            ->from('game', 'g')
            ->where('gcb.country IS NULL')
            ->andWhere('gbb.blocked_date IS NULL')
            ->andWhere('g.active = 1');

            if(!empty($brand)) {
                $this->qb->innerJoin('g', 'brand_games', 'bg', 'g.launchcode = bg.launchcode')
                    ->where()
            }
        */
            return $this->dbCasino->fetchAll($this->qb->getSQL(), $this->qb->getParameters());
    }
}