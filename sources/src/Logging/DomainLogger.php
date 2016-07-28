<?php

namespace HsBremen\WebApi\Logging;

use HsBremen\WebApi\Assetpool\AssetpoolEvent;
use HsBremen\WebApi\Entity\Asset;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class DomainLogger
 *
 * @package HsBremen\WebApi\Logging
 */
class DomainLogger implements EventSubscriberInterface
{
    /** @var  LoggerInterface */
    private $logger;

    /**
     * DomainLogger constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
          AssetpoolEvent::GET_DETAILS => ['logGetDetails', -10],
        ];
    }

    /**
     * Simple helper to debug to the console
     *
     * @param  object, array, string $data
     * @return string
     */
    function debug_to_console( $data ) {

        if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

        echo $output;
    }

    /**
     * @param \HsBremen\WebApi\Assetpool\AssetpoolEvent $event
     */
    public function logGetDetails(AssetpoolEvent $event)
    {
        $asset   = $event->getAsset();
        $message = sprintf('Asset with id %d requested.', $asset->getAssetid());

        $dir = "/var/www/sources/assetpool";
        $a = scandir($dir);
        $b = scandir($dir . '/' . $a[1]);

        $this->logger->info($message);
    }
}
