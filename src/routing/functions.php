<?php
namespace Src\Routing;

use Symfony\Component\Yaml\Yaml;

if (!function_exists('Src\Routing\simpleDispatcher')) {

    /**
     * @param RouteCollector $r
     * @param string $routesFile
     * @return RouteCollector $r
     */
    function getRouteCollector(RouteCollector $r, $routesFile)
    {
        $routesParam = Yaml::parse(file_get_contents($routesFile));
        foreach ($routesParam as $routeParam) {
            $controller = array(
                0 => 'App\\Controllers\\' . $routeParam['controller']['class'],
                1 => $routeParam['controller']['method']
            );
            foreach ($routeParam['middlewares'] as $key => $value) {
                $routeParam['middlewares'][$key] = 'App\\Middlewares\\' . $value;
            }
            $r->addRoute($routeParam['method'], DEFAULT_URI . $routeParam['path'], $controller, $routeParam['middlewares']);
        }
        return $r;
    }

    /**
     * @param array $options
     *
     * @return Dispatcher
     */
    function simpleDispatcher(array $options = [])
    {
        $options += [
            'routeParser' => '\\Src\\Routing\\RouteParser\\Std',
            'dataGenerator' => '\\Src\\Routing\\DataGenerator\\GroupCountBased',
            'dispatcher' => '\\Src\\Routing\\Dispatcher\\GroupCountBased',
            'routeCollector' => '\\Src\\Routing\\RouteCollector',
        ];

        if (!isset($options['routesFile']) || !file_exists($options['routesFile'])) {
            throw new \LogicException('Must specify a existing "routesFile" option');
        }

        /** @var RouteCollector $routeCollector */
        $routeCollector = new $options['routeCollector'](
            new $options['routeParser'], new $options['dataGenerator']
        );
        getRouteCollector($routeCollector, $options['routesFile']);

        return new $options['dispatcher']($routeCollector->getData());
    }

    /**
     * @param array $options
     *
     * @return Dispatcher
     */
    function cachedDispatcher(array $options = [])
    {
        $options += [
            'routeParser' => '\\Src\\Routing\\RouteParser\\Std',
            'dataGenerator' => '\\Src\\Routing\\DataGenerator\\GroupCountBased',
            'dispatcher' => '\\Src\\Routing\\Dispatcher\\GroupCountBased',
            'routeCollector' => '\\Src\\Routing\\RouteCollector',
            'cacheDisabled' => false,
        ];

        if (!isset($options['cacheFile'])) {
            throw new \LogicException('Must specify "cacheFile" option');
        }

        if (!isset($options['routesFile']) || !file_exists($options['routesFile'])) {
            throw new \LogicException('Must specify a existing "routesFile" option');
        }

        if (!$options['cacheDisabled'] && file_exists($options['cacheFile'])
            && (filemtime($options['cacheFile']) > filemtime($options['routesFile']))
        ) {
            $dispatchData = require $options['cacheFile'];
            if (!is_array($dispatchData)) {
                throw new \RuntimeException('Invalid cache file "' . $options['cacheFile'] . '"');
            }
            return new $options['dispatcher']($dispatchData);
        }

        $routeCollector = new $options['routeCollector'](
            new $options['routeParser'], new $options['dataGenerator']
        );
        getRouteCollector($routeCollector, $options['routesFile']);

        /** @var RouteCollector $routeCollector */
        $dispatchData = $routeCollector->getData();
        file_put_contents(
            $options['cacheFile'],
            '<?php return ' . var_export($dispatchData, true) . ';'
        );

        return new $options['dispatcher']($dispatchData);
    }
}
