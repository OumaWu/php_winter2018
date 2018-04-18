<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;
use Application\Services\CrudUsersService;
use Application\Services\CrudUsersServiceTrait;
use Application\Models\Entity\Users;

class LoginController extends Controller {

    use CrudUsersServiceTrait;

    public static function config(AbstractApp &$app)
    {
        IndexController::config($app);
    }

    public function predispatch()
    {
        $em = $this->serviceManager->getRegisteredService('em1');

        $this->serviceManager->addRegisteredService('CrudUsersService', new CrudUsersService(new Users(), $em));

        $this->setCrudUsers($this->serviceManager->getRegisteredService('CrudUsersService'));
    }

    /* method to display the appropriate web page (xxxAction) */
    public function indexAction()
    {
        //$results = $this->getPassword();

        /*if (is_object($results)) {
            $results = [$this->hydrateArray($results)];
        } else {
            for ($i = 0; $i < count($results); $i++) {
                $results[$i] = $this->hydrateArray($results[$i]);
            }
        }*/

        $this->view['bodyjs'] = 1;

//        $this->view['results'] = $results;

        $this->viewObject->assign('view', $this->view);

        $this->viewObject->display('login_index.tpl');
    }

    public function checkPasswordAction()
    {
        if (isset($_POST) && !empty($_POST['account']) && !empty($_POST['password'])) {

            $account = (string) $_POST['account'];
            $password = (string) $_POST['password'];
            $user = $this->getCrudUsers()->getUser($account);

            if ($user != null) {
                $truePassword = $user->getPassword();
                if (password_verify($password, $truePassword)) {
                    session_start();
                    $_SESSION['account'] = $_POST['account'];
                    $_SESSION['expire'] = time() + 10;
                    echo "<h1>Welcome, Mr.{$_SESSION["account"]}</h1>";
                    return true;
                }
            }
        }
        return false;
    }

    public function checkValidSessionAction() {
        session_start();
        if (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['expire'] >= time()) {
            return true;
        }
        return false;
    }

    /*protected function hydrateArray(Users $object)
    {
        $array['account'] = $object->getAccount();
        $array['password'] = $object->getPassword();

        return $array;
    }*/
}