<?php


namespace App\Tasks\Administration;

use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @param Flusher $flusher
     * @param AdministrationTaskRepository $administrationTaskRepository
     */
    public function create(AdministrationTaskData $data, Flusher $flusher, AdministrationTaskRepository $administrationTaskRepository)
    {
        $task = new AdministrationTask($data->name, $data->pointsReward, $data->cityId, $data->categoryId, $data->subCategoryId, $data->area);
        $administrationTaskRepository->add($task);
        $flusher->flush();
        return [
            'id' => $task->id()
        ];
    }

    /**
     * @Route(path="/{id}", methods={"GET"})
     * @param string $id
     * @param Connection $connection
     * @return mixed
     */
    public function retrieve(string $id, Connection $connection)
    {
        $data = $connection->createQueryBuilder()
            ->addSelect('id')
            ->addSelect('name')
            ->addSelect('points')
            ->addSelect('city_id')
            ->addSelect('category_id')
            ->addSelect('sub_category_id')
            ->addSelect('ST_ASGEOJSON(ST_FlipCoordinates(area))::JSON->\'coordinates\'->0 AS area')
            ->from('administration_tasks')
            ->andWhere('id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        if (!$data) {
            throw new NotFoundHttpException("Not Found");
        }

        $taskData = new AdministrationTaskData();
        $taskData->id = $connection->convertToPHPValue($data['id'], 'uuid');
        $taskData->name = $data['name'];
        $taskData->pointsReward = $data['points'];
        $taskData->cityId = $data['city_id'];
        $taskData->categoryId = $data['category_id'];
        $taskData->subCategoryId = $data['sub_category_id'];
        $taskData->area = $connection->convertToPHPValue($data['area'], 'json');
        return $taskData;
    }

    /**
     * @Route(path="/{id}", methods={"PUT"})
     * @param AdministrationTask $administrationTask
     * @param AdministrationTaskData $data
     * @param Flusher $flusher
     */
    public function update(AdministrationTask $administrationTask, AdministrationTaskData $data, Flusher $flusher)
    {
        $administrationTask->update($data->name, $data->pointsReward, $data->cityId, $data->categoryId, $data->subCategoryId, $data->area);
        $flusher->flush();
    }
}