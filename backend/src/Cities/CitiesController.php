<?php


namespace App\Cities;

use OpenApi\Annotations\Get;
use OpenApi\Annotations\Items;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/cities")
 */
class CitiesController
{
    /**
     * @Route(methods={"GET"})
     * @Get(
     *     path="/api/cities",
     *     summary="Список городов",
     *     tags={"Города"},
     *     responses={
     *         @Response(
     *             response="200",
     *             description="",
     *             @JsonContent(type="array", @Items(ref="#/components/schemas/City"))
     *         )
     *     }
     * )
     */
    public function index()
    {
        return Cities::list();
    }
}
