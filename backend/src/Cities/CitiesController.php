<?php


namespace App\Cities;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Items;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Response;
use Symfony\Component\HttpFoundation\Request;
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
     * @param CityFinder $cityFinder
     * @return City[]
     */
    public function index(CityFinder $cityFinder)
    {
        return $cityFinder->findAll();
    }

    /**
     * @Route(path="/detect", methods={"GET"})
     * @param Request $request
     * @param CityFinder $cityFinder
     * @return City
     * @throws InvalidDatabaseException
     * @Get(
     *     path="/api/cities/detect",
     *     summary="Определение города",
     *     tags={"Города"},
     *     responses={
     *         @Response(
     *             response="200",
     *             description="",
     *             @JsonContent(ref="#/components/schemas/City")
     *         )
     *     }
     * )
     */
    public function detect(Request $request, CityFinder $cityFinder)
    {
        $dbPath = '/geoip_data/GeoLite2-City.mmdb';
        if (file_exists($dbPath)) {
            $reader = new Reader($dbPath, ['ru']);
            try {
                $record = $reader->city($request->getClientIp());
                return $cityFinder->findByCoordinates($record->location->latitude, $record->location->longitude) ?? $cityFinder->first();
            } catch (AddressNotFoundException | InvalidDatabaseException $exception) {
            }
        }
        return $cityFinder->first();
    }
}
