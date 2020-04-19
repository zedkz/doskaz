<?php


namespace App\Infrastructure\Api;


use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckCsrfTokenListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if (in_array($request->getPathInfo(), ['/api/token/oauth'])) {
            return;
        }

        if (in_array($request->getMethod(), ['GET', 'HEAD', 'OPTIONS'])) {
            return;
        }

        if ($request->headers->has('Authorization')) {
            return;
        }

        if ($request->cookies->has('XSRF-TOKEN')
            && $request->headers->contains('X-XSRF-TOKEN', $request->cookies->get('XSRF-TOKEN'))) {
            return;
        }

        throw new AccessDeniedHttpException('Access denied');
    }
}