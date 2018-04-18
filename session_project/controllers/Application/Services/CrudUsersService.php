<?php

namespace Application\Services;

use Application\Models\Entity\Users;
use Application\Models\Traits\DoctrineTrait;
use Application\Models\Repository\UsersRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class CrudUsersService
{
    use DoctrineTrait;

    protected $users;

    protected $usersRepository;

    public function __construct(Users $users, EntityManager $em)
    {
        $this->users = $users;

        $this->em = $em;

        $this->usersRepository = new UsersRepository(
            $this->em,
            new ClassMetaData('Application\Models\Entity\Users'));
    }

    public function getUser(string $account = null)
    {
        try {
            if (isset($account)) {
                $result = $this->getEm()->findAccount(users::class, $account);
            } else {
                $result = null;
            }

        } catch (\Exception $e) {
            return false;
        }

        return $result;
    }
}