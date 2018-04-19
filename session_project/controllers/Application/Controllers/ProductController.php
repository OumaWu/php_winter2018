<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;
use Application\Services\CrudProductsService;
use Application\Services\CrudProductsServiceTrait;
use Application\Models\Entity\Products;

define('FILE_UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] . "/php_winter2018/session_project/public/files/");

class ProductController extends Controller {

    use CrudProductsServiceTrait;

    public static function config(AbstractApp &$app)
    {
        IndexController::config($app);
    }

    public function predispatch()
    {
        $em = $this->serviceManager->getRegisteredService('em1');

        $this->serviceManager->addRegisteredService('CrudProductService', new CrudProductsService(new Products(), $em));

        $this->setCrudProducts($this->serviceManager->getRegisteredService('CrudProductService'));
    }

    public function indexAction()
    {
        session_start();
        $results = $this->readProducts();

        if (is_object($results)) {
            $results = [$this->hydrateArray($results)];
        } else {
            for ($i = 0; $i < count($results); $i++) {
                $results[$i] = $this->hydrateArray($results[$i]);
            }
        }

        $this->view['bodyjs'] = 1;

        $this->view['results'] = $results;

        $this->viewObject->assign('view', $this->view);

        $this->viewObject->display('product_index.tpl');
    }

    protected function readProducts()
    {
        if (!empty($_GET)) {

            $id = (int) $_GET['id'];

            return $this->getCrudProducts()->read($id);

        } else {

            return $this->getCrudProducts()->read();

        }
    }

    protected function hydrateArray(Products $object)
    {
        $array['id'] = $object->getId();
        $array['name'] = $object->getName();
        $array['price'] = $object->getPrice();
        $array['description'] = $object->getDescription();
        $array['image'] = $object->getImage();

        return $array;
    }

    public function addAction()
    {
        session_start();
        $this->view['bodyjs'] = 1;

        if (!isset($_SESSION['login']) || empty($_SESSION['login']) || $_SESSION['expire'] < time()) {
            $login = new LoginController($this->app);
            $login->indexAction();
        } else {

            $_SESSION["expire"] = time() + 30;

            if (!empty($_POST)) {
                // Would have to sanitize and filter the $_POST array.
                $productArray['name'] = (string) $_POST['name'];
                $productArray['price'] = (string) $_POST['price'];
                $productArray['description'] = (string) $_POST['description'];
                $productArray['image'] = (string) $_FILES['image']['name'];
                $filePath = FILE_UPLOAD_PATH . $productArray['image'];

                if(!file_exists($filePath)) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $filePath);
                }

                if ($this->crudProducts->create($productArray)) {
                    $this->view['saved'] = 1;
                }
                else {
                    $this->view['error'] = 1;
                }
            }

            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('product_add_form.tpl');
        }
    }

    public function editAction()
    {
        session_start();
        $this->view['bodyjs'] = 1;

        if (!isset($_SESSION['login']) || empty($_SESSION['login']) || $_SESSION['expire'] < time()) {
            $login = new LoginController($this->app);
            $login->indexAction();
        } else {

            $_SESSION["expire"] = time() + 30;

            if (!empty($_POST)) {
                // Would have to sanitize and filter the $_POST array.
                $productArray['id'] = (string) $_POST['id'];
                $productArray['name'] = (string) $_POST['name'];
                $productArray['price'] = (string) $_POST['price'];
                $productArray['description'] = (string) $_POST['description'];

                if (!empty($_FILES['image']['name'])) {
                    $productArray['image'] = (string) $_FILES['image']['name'];
                    $originalImage = FILE_UPLOAD_PATH . (string) $_POST['imageoriginal'];
                } else {
                    $productArray['image'] = (string) $_POST['imageoriginal'];
                }
                $filePath = FILE_UPLOAD_PATH . $productArray['image'];

                if(file_exists($originalImage)) {
                    unlink($originalImage);
                }

                if(file_exists($filePath)) {
                    unlink($filePath);
                }

                if(move_uploaded_file($_FILES["image"]["tmp_name"], $filePath)) {
                    if ($this->crudProducts->update($productArray)) {
                        $this->view['saved'] = 1;
                    }
                    else {
                        $this->view['error'] = 1;
                    }
                }
                else {
                    $this->view['error'] = 1;
                }

            } else {
                $results = $this->readProducts();

                if (is_object($results)) {
                    $results = [$this->hydrateArray($results)];
                } else {
                    for ($i = 0; $i < count($results); $i++) {
                        $results[$i] = $this->hydrateArray($results[$i]);
                    }
                }

                $this->view['results'] = $results;
            }

            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('product_edit_form.tpl');
        }
    }

    public function deleteAction()
    {
        session_start();
        if (!isset($_SESSION['login']) || empty($_SESSION['login']) || $_SESSION['expire'] < time()) {
            $login = new LoginController($this->app);
            $login->indexAction();
        } else {

            $_SESSION["expire"] = time() + 30;

            if (!empty($_GET)) {
                // Would have to sanitize and filter the $_GET array.
                $id = (int) $_GET['id'];
                $image = (string) $_GET['image'];
                $imagePath = FILE_UPLOAD_PATH . $image;

                if(file_exists($imagePath)) {
                    unlink($imagePath);
                }

                if ($this->crudProducts->delete($id)) {
                    $this->view['saved'] = 1;
                } else {
                    $this->view['error'] = 1;
                }
            }

            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('product_delete.tpl');
        }
    }
}