<?php

declare(strict_types=1);

namespace App\Handler;

use App\Form\LoginForm;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Form\FormElementManager;
class LoginPageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : LoginPageHandler
    {
        return new LoginPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(FormElementManager::class)
                ->get(LoginForm::class)
        );
    }
}
