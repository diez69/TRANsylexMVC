<?php

namespace App\Association\Repository;

use App\Association\Entity\Association;
use App\Users\Repository\UserRepository;
use App\Pc\Repository\PcRepository;
use Doctrine\DBAL\Connection;

/**
 * Pc repository.
 */
class AssociationRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;
    protected $userRepository;
    protected $pcRepository;

    public function __construct(Connection $db, UserRepository $userRepository, pcRepository $pcRepository)
    {
        $this->db = $db;
        $this->userRepository = $userRepository;
        $this->pcRepository = $pcRepository;
    }

   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('a.*')
           ->from('Association', 'a');

       $statement = $queryBuilder->execute();
       $AssociationData = $statement->fetchAll();
       $AssociationEntityList = array();
       foreach ($AssociationData as $associationData) {
           $AssociationEntityList[$associationData['id']] = 
           new Association($associationData['id'], 
            $this->userRepository->getById($associationData['idUser']), 
            $this->pcRepository->getById($associationData['idPc'])
          );
       }

       return $AssociationEntityList;
   }
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       
       $queryBuilder
       ->select('a.*')
       ->from('Association', 'a')
       ->join('a', 'pc', 'p', 'a.idPc=p.id')
       ->join('a', 'users', 'u', 'a.idUser = u.id')
       ->where('a.id = :id')
       ->setParameter(':id', $id);

       $statement = $queryBuilder->execute();
       $AssociationData = $statement->fetchAll();
       $AssociationEntityList = array();
       foreach ($AssociationData as $associationData) {
        $AssociationEntityList[$associationData['id']] = 
        new Association($associationData['id'], 
          $this->userRepository->getById($associationData['idUser']), 
          $this->pcRepository->getById($associationData['idPc'])
        );
       }

       return $AssociationEntityList;
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('association')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('Association')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['idUser']) {
            $queryBuilder
              ->set('idUser', ':idUser')
              ->setParameter(':idUser', $parameters['idUser']);
        }

        if ($parameters['idPc']) {
            $queryBuilder
              ->set('idPc', ':idPc')
              ->setParameter(':idPc', $parameters['idPc']);
        }
        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('Association')
          ->values(
              array(
                'idUser'=>':idUser',
                'idPc'=>':idPc'
              )
          )
          ->setParameter(':idUser', $parameters['idUser'])
          ->setParameter(':idPc', $parameters['idPc']);
        $statement = $queryBuilder->execute();
    }
}

