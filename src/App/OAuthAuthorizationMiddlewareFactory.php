<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;

class OAuthAuthorizationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : OAuthAuthorizationMiddleware
    {
        return new OAuthAuthorizationMiddleware();
    }
}
