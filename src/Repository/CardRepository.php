<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\CardFilter;
use SortDirection;

/**
 * @extends ServiceEntityRepository<Card>
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }

    public function findByFilters(?CardFilter $filters = null): array
    {
        $qb = $this->createQueryBuilder('c');

        if (!empty($filters)){
            if (!empty($filters->name)) {
                $qb->andWhere('c.name LIKE :name')
                    ->setParameter('name', '%' . $filters->name . '%');
            }

            if (!empty($filters->type)) {
                $qb->andWhere('c.type = :type')
                    ->setParameter('type', $filters->type);
            }
        }

        $qb->orderBy('c.id','ASC');

        return $qb->getQuery()->getResult();
    }

    public function findDistinctTypes(): array{
        return $this->createQueryBuilder('c')
            ->select('DISTINCT c.type')
            ->orderBy('c.type', 'ASC')
            ->getQuery()
            ->getSingleColumnResult();
    }

    // public function findByType(string $type): array
    // {
    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.type = :type')
    //         ->setParameter('type', $type)
    //         ->getQuery()
    //         ->getResult();
    // }
    //Existe déjà avec Doctrine : findBy(['type'=>...])

    public function findByItemTypeId(int $itemTypeId): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.item_type_id = :itemTypeId')
            ->setParameter('itemTypeId', $itemTypeId)
            ->getQuery()
            ->getResult();
    }

}
