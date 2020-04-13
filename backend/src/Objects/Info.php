<?php


namespace App\Objects;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Info extends AbstractController
{
    /**
     * @Route(path="/api/info")
     */
    public function info() {
        phpinfo();
    }
}