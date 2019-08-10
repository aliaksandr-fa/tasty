<?php

namespace Tasty\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * Class SerializerListener
 * @package Tasty\EventListener
 * @author Faley Aliaksandr
 */
class SerializerListener
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * SerializerListener constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param ViewEvent $event
     */
    public function onKernelView(ViewEvent $event)
    {
        $format = $event->getRequest()->attributes->get('_format');

        // serialize content depending on _format parameter from request
        $serializedContent = $this->serializer->serialize($event->getControllerResult(), $format);
        $serializedContentType = (new MimeTypes())->getMimeTypes($format)[0] ?? 'text/html';

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent($serializedContent);
        $response->headers->add([
            'Content-Type' => $serializedContentType
        ]);

        $event->setResponse($response);
    }
}