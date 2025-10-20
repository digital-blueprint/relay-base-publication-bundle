<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Service;

use Dbp\Relay\BasePublicationBundle\API\PublicationProviderInterface;
use Dbp\Relay\BasePublicationBundle\Entity\Publication;

class PublicationService
{
    private PublicationProviderInterface $provider;

    public function __construct(PublicationProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getPublication(string $id, array $filters = [], array $options = []): ?Publication
    {
        return $this->provider->getPublicationById($id, $options);
    }

    public function setConfig(array $config): void
    {
        // no-op for dummy setup
    }

    /**
     * @return Publication[]
     */
    public function getPublications(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        return $this->provider->getPublications($currentPageNumber, $maxNumItemsPerPage, $options);
    }
}