<?php

declare(strict_types=1);

namespace App\Handler;

use App\Form\LoginForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Authentication\UserInterface;
use Zend\Expressive\Session\SessionMiddleware;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\RedirectResponse;

class LoginPageHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var LoginForm
     */
    private $loginForm;

    public function __construct(
        TemplateRendererInterface $renderer,
        LoginForm $loginForm
    ) {

        $this->renderer = $renderer;
        $this->loginForm = $loginForm;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if ($session->has(UserInterface::class)) {
            return new RedirectResponse('/');
        }

        $error = 'Login Failure, please try again';
        if ($request->getMethod() === 'POST') {
            $this->loginForm->setData($request->getParsedBody());
            if ($this->loginForm->isValid()) {
                /*$response = $handler->handle($request);
                if ($response->getStatusCode() !== 302) {
                    return new RedirectResponse('/');
                }*/
                return new RedirectResponse('/');

                //$error = 'Login Failure, please try again';
            }
        }
        // handle authentication here Next
        return new HtmlResponse($this->renderer->render(
            'app::login-page',
            [
                'form'  => $this->loginForm,
                'error' => $error,
            ] // parameters to pass to template
        ));
    }
}
