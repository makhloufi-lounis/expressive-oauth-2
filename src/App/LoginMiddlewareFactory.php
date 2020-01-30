<?php

declare(strict_types=1);

namespace App;

use App\Form\LoginForm;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\FormElementManager;

class LoginMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : LoginMiddleware
    {
        return new LoginMiddleware(
            $container->get(TemplateRendererInterface::class),
            $container->get(FormElementManager::class)
                ->get(LoginForm::class)
        );
    }
}
