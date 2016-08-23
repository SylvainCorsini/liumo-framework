<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/08/2016
 * Time: 21:41
 */

namespace Core\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Core\Event\ResponseEvent;

class ContentLengthListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }

    public static function getSubscribedEvents()
    {
        return array('response' => array('onResponse', -255));
    }
}