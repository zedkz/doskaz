<?php


namespace App\Tasks\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/admin/administrationTasks")
 * @IsGranted("ROLE_ADMIN")
 */
class AdministrationTaskController extends AbstractController
{
    /**
     * @Route(path="", methods={"POST"})
     * @param AdministrationTaskData $data
     */
    public function create(AdministrationTaskData $data)
    {

    }

    /**
     * @Route(path="", methods={"PUT"})
     * @param AdministrationTaskData $data
     */
    public function update(AdministrationTaskData $data) {

    }
}