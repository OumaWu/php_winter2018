<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 2018/4/17
 * Time: 13:42
 */
namespace Application\Models\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity("Application\Models\Entity\Users")
 * @ORM\Entity(repositoryClass="Application\Models\Repository\UsersRepository")
 * @ORM\Table("Users")
 */
class Users {
    /**
     * @ORM\account
     * @ORM\Column(type="string", length=30)
     */
    protected $account;

    /**
     * @ORM\Column(type="string", length=255, name="password")
     */
    protected $password;

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = (string) $account;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = (string) $password;
    }
}
