<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Service;

use Dbp\Relay\BasePublicationBundle\API\PublicationProviderInterface;
use Dbp\Relay\BasePublicationBundle\Entity\Publication;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Symfony\Component\HttpFoundation\Response;

class DummyPublicationProvider implements PublicationProviderInterface
{
    public function getPublicationById(string $identifier, array $options = []): Publication
    {
        if ($identifier === '404') {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'publication not found');
        }

        $publication = new Publication();
        $publication->setIdentifier($identifier);
        $publication->setName('Dummy Publication '.$identifier);

        return $publication;
    }

    public function getPublications(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array
    {
        return [
            $this->getPublicationById('1'),
            $this->getPublicationById('2'),
            $this->getPublicationById('3'),
        ];
    }
}
