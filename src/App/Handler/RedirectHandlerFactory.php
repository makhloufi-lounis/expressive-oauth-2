<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class RedirectHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RedirectHandler
    {
        return new RedirectHandler($container->get(TemplateRendererInterface::class));
    }
}
