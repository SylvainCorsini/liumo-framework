<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/08/2016
 * Time: 21:01
 */

namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Pixie\Connection;
use Core\Rain\Rain;

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
        $this->connection = new Connection(DB_DRIVER, DB_CONFIG, 'QB'); // Create the QB Facade
        $this->template = new Rain('TPL'); // Create the TPL Facade
        \TPL::objectConfigure(array(
            'tpl_dir'   =>  '../App/View',
            'cache_dir' =>  '../Cache',
            'tpl_ext' => 'rain.php',
            'php_enabled' => true
        )); // Configure the TPL Facade
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
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $e) {
            $response = new Response('An error occurred: '.$e, 500);
        }

        $this->dispatcher->dispatch('response', new ResponseEvent($response, $request));

        return $response;
    }
}