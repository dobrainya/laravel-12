<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;
use Psr\SimpleCache\InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HttpCacheMiddleware
{
    public function __construct(private readonly Repository $repository)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     * @throws InvalidArgumentException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cacheKey = $request->getRequestUri();

        if ($request->getMethod() === Request::METHOD_GET && $this->repository->has($cacheKey)) {
            return new JsonResponse(data: $this->repository->get($cacheKey), json: true);
        }

        $response = $next($request);

        if ($response->isCacheable() && ($ttl = (int) $response->getTtl()) > 0 ) {
            $this->repository->put($cacheKey, $response->getContent(), $ttl);
        }

        return $response;
    }
}
