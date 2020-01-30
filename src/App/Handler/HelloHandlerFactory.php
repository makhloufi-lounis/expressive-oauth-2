<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HelloHandlerFactory
{
    public function __invoke(ContainerInterface $container) : HelloHandler
    {
        return new HelloHandler($container->get(TemplateRendererInterface::class));
    }
}
