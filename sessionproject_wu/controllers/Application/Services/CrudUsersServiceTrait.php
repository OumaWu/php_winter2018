<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 2018/4/17
 * Time: 13:53
 */

namespace Application\Services;

trait CrudUsersServiceTrait
{
    protected $crudUsers;

    /**
     * @return mixed
     */
    public function getCrudUsers()
    {
        return $this->crudUsers;
    }

    /**
     * @param mixed $crudUsers
     */
    public function setCrudUsers($crudUsers)
    {
        $this->crudUsers = $crudUsers;
    }
}