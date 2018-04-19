<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;

class IndexController extends Controller {
    
    public static function config(AbstractApp &$app)
    {
        $baseConfig = $app->getBaseConfig();
        
        $view = [
            'logo' => $baseConfig['URLBASEADDR'] . 'img/logo.png',
            'favicon' => $baseConfig['URLBASEADDR'] . 'favicon.ico',
            'appname' => $baseConfig['appName'],
            'title' => "Ouma High Tech",
            'author' => 'Jiahong Wu',
            'description' => 'Small CRUD application',
            'css' =>
            [
                $baseConfig['URLBASEADDR'] . 'css/bootstrap.min.css',
                $baseConfig['URLBASEADDR'] . 'css/dashboard.css',
                $baseConfig['URLBASEADDR'] . 'css/bootstrap.custom.css',
                $baseConfig['URLBASEADDR'] . 'css/dashboard.css',
                
            ],
            'js' =>
            [
                $baseConfig['URLBASEADDR'] . 'js/jquery.min.js',
                $baseConfig['URLBASEADDR'] . 'js/bootstrap.min.js',
                
            ],
            'jsscripts' =>
            [
                //"<script>\n\t\tfunction getPage(page) {\n\n\t\t\tvar url = page;\n\n\t\t\tjq( \"#pageBody\" ).load( url );\n\n\t\t}\n\t</script>\n",
        
            ],
            /*
                Navibar's links assignment
            */
            'links' =>
            [
                'Home' => $baseConfig['URLBASEADDR'] . 'index.php',
                'Products' => $baseConfig['URLBASEADDR'] . 'index.php/product/index',
                'Login' => $baseConfig['URLBASEADDR'] . 'index.php/login/index',
//                'Logout' => $baseConfig['URLBASEADDR'] . 'index.php/login/logout',
            ],
            /*'navMenu' =>
            [
                'Home' => $baseConfig['URLBASEADDR'] . 'index.php',
                
            ],*/
        ];
        session_start();

        if (isset($_SESSION['login'])) {
            $view['links']['Logout'] = $baseConfig['URLBASEADDR'] . 'index.php/login/logout';
        }

        if (isset($_SESSION['expire']) && $_SESSION['expire'] < time()) {
            unset($view['links']['Logout']);
        }
        else {
            $_SESSION["expire"] = time() + 30;
        }

        $app->appendBaseConfig('view', $view);
    }

    /* method to display the appropriate web page (xxxAction) */
    public function indexAction()
    {
        $this->view['bodyjs'] = 1;

        $this->viewObject->assign('view', $this->view);

        $this->viewObject->display('index_index.tpl');
    }
}