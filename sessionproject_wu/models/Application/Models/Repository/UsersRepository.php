<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 2018/4/17
 * Time: 13:48
 */
namespace Application\Models\Repository;

use Application\Models\Entity\Users;
use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    protected $users;

    public function findAccount(Users $users)
    {
        return $this->findOneBy(['account' => $users->getAccount()]);
    }
}