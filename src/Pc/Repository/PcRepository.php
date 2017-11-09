<?php

namespace App\Pc\Repository;

use App\Pc\Entity\Pc;
use Doctrine\DBAL\Connection;

/**
 * Pc repository.
 */
class PcRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of Pc.
    *
    * @param int $limit
    *   The number of Pc to return.
    * @param int $offset
    *   The number of Pc to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of Pc, keyed by Pc id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('p.*')
           ->from('Pc', 'p');

       $statement = $queryBuilder->execute();
       $PcData = $statement->fetchAll();
       foreach ($PcData as $computerData) {
           $PcEntityList[$computerData['id']] = new Pc($computerData['id'], $computerData['marque']);
       }

       return $PcEntityList;
   }

   /**
    * Returns an Pc object.
    *
    * @param $id
    *   The id of the Pc to return.
    *
    * @return array A collection of Pc, keyed by Pc id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('p.*')
           ->from('Pc', 'p')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $PcData = $statement->fetchAll();

       return new Pc($PcData[0]['id'], $PcData[0]['marque']);
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('pc')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('pc')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['marque']) {
            $queryBuilder
              ->set('marque', ':marque')
              ->setParameter(':marque', $parameters['marque']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('Pc')
          ->values(
              array(
                'marque' => ':marque',
              )
          )
          ->setParameter(':marque', $parameters['marque']);
        $statement = $queryBuilder->execute();
    }
}
