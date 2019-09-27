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

    public function getGames($brand, $country, $category)
    {
        $this->qb->select('g.name, g.launchcode, g.rtp')
            ->from('game', 'g')
            ->where('g.active = 1');

            if(!empty($brand)) {
                // $this->qb->innerJoin('g', 'brand_games', 'bg', 'g.launchcode = bg.launchcode');
                // $this->qb->select('bg.hot, bg.new');
            }
            return $this->dbCasino->fetchAll($this->qb->getSQL(), $this->qb->getParameters());
    }

    // public function getForKorpuszKod($korpuszKod, $terminal = null)
    // {
    //     $this->qb->select('a.*')
    //         ->from('alkatreszek', 'a')
    //         ->where('korpuszkod = :korpuszKod')
    //         ->setParameter('korpuszKod', $korpuszKod);

    //     if (!empty($terminal)) {
    //         $this->qb->innerJoin('a', 'gyartasi_folyamat_alkatresz_status', 'gyfas', 'a.barcode = gyfas.barcode');
    //         $this->qb->innerJoin('gyfas', 'gyartasi_folyamat_lepesek', 'gyfl', 'gyfas.lepes_id = gyfl.id');
    //         $this->qb->andWhere('gyfl.terminal = :terminal');
    //         $this->qb->setParameter('terminal', $terminal);
    //     }

    //     return $this->dbWood->fetchAll($this->qb->getSQL(), $this->qb->getParameters());
    // }
}