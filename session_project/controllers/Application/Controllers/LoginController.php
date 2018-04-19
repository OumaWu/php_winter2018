<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;
use Application\Services\CrudUsersService;
use Application\Services\CrudUsersServiceTrait;
use Application\Models\Entity\Users;
use PDO;

class LoginController extends Controller {

    public static function config(AbstractApp &$app)
    {
        IndexController::config($app);
    }

    public function predispatch()
    {
        //$em = $this->serviceManager->getRegisteredService('em1');

//        $this->serviceManager->addRegisteredService('CrudUsersService', new CrudUsersService(new Users(), $em));
//
//        $this->setCrudUsers($this->serviceManager->getRegisteredService('CrudUsersService'));
    }

    /* method to display the appropriate web page (xxxAction) */
    public function indexAction()
    {
        session_start();
        /* verify login and password */
        $this->view['session']['error'] = false;
        if (isset($_POST)) {
            if (!empty($_POST['account']) && !empty($_POST['password'])) {
                $account = trim((string) $_POST['account']);
                $password = (string) $_POST['password'];
                $result = $this->getUser($account);
                $user = $result->fetch(PDO::FETCH_OBJ);

                if($user != null) {
                    if (password_verify($password, $user->password)) {
                        $_SESSION["login"] = $account;
                        $_SESSION["expire"] = time() + 20;
                        $this->view['session']['logout'] = false;
                    }
                } else {
                    $this->view['session']['error'] = true;
                }
            }
        }
        $this->view['bodyjs'] = 1;

        $this->viewObject->assign('view', $this->view);

        $this->viewObject->display('login_index.tpl');
    }

    public function logoutAction() {
        session_start();
        session_unset();
        session_destroy();

        $this->view['session']['logout'] = true;

        $this->view['bodyjs'] = 1;

        $index = new IndexController($this->app);
        $index->indexAction();
    }

//    public function checkValidSession() {
//        session_start();
//        if (isset($_SESSION['account']) && !empty($_SESSION['account']) && $_SESSION['expire'] >= time()) {
//            return true;
//        }
//        return false;
//    }

    private function getUser(string $account = null) {
        if ($account != null)
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=lightmvctestdb", "lightmvcuser", "testpass");
                $sql = "SELECT * FROM `users` WHERE `account` LIKE '" . $account . "' ORDER BY `account` ASC";
                $result = $pdo->prepare($sql);
                $result->execute();
                return $result;
            } catch (PDOException $e) {
                echo "ERROR !!";
                echo "<pre>";
                print_r($e);
                echo "</pre>";
            }
        return null;
    }
}