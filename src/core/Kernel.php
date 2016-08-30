<?php
namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Scorsi\QueryBuilder\Connection;
use Scorsi\TemplateEngine\TemplateEngine;

class Kernel implements HttpKernelInterface
{
    protected $matcher;
    protected $resolver;
    protected $dispatcher;
    protected $connection;
    protected $template;

    /**
     * Kernel constructor.
     * @param EventDispatcher $dispatcher
     * @param UrlMatcherInterface $matcher
     * @param ControllerResolverInterface $resolver
     */
    public function __construct(EventDispatcher $dispatcher, UrlMatcherInterface $matcher, ControllerResolverInterface $resolver)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
        $this->dispatcher = $dispatcher;
        $this->connection = new Connection(DB_DRIVER, DB_CONFIG, 'QB'); // Create and configure the QB Facade
        $this->template = new TemplateEngine(TPL_CONFIG, 'TPL'); // Create and configure the TPL Facade
    }

    /**
     * Method to handle request
     * @param Request $request
     * @param int $type
     * @param bool $catch
     * @return Response
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));
            $controller = $this->resolver->getController($request);
            $arguments = $this->resolver->getArguments($request, $controller);
            $response = call_user_func_array($controller, $arguments);
            if (empty($response)) {
                $response = new Response();
            }
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not Found: '.$e, 404);
        } catch (\Exception $e) {
            $response = new Response('An error occurred: '.$e, 500);
        }

        $this->dispatcher->dispatch('response', new ResponseEvent($response, $request));

        return $response;
    }
}