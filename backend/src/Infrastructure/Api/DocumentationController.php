<?php


namespace App\Infrastructure\Api;

use OpenApi\Annotations\Info;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Info(title="doskaz api", version="1")
 */
class DocumentationController extends AbstractController
{
    private $srcDir;

    public function __construct(string $srcDir)
    {
        $this->srcDir = $srcDir;
    }

    /**
     * @Route(path="/api/swagger.json", name="api.swagger.json")
     */
    public function swaggerJson()
    {
        $openapi = \OpenApi\scan($this->srcDir);
        return JsonResponse::fromJsonString($openapi->toJson());
    }

    /**
     * @Route(path="/api/docs")
     * @Template(template="api_docs.html.twig")
     * @param Profiler|null $profiler
     */
    public function docs(?Profiler $profiler)
    {
        if ($profiler) {
            $profiler->disable();
        }
    }
}
