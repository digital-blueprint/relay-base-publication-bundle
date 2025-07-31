<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Rest;

use Dbp\Relay\BasePublicationBundle\Entity\Publication;
use Dbp\Relay\BasePublicationBundle\Service\PublicationService;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProcessor;

class PublicationProcessor extends AbstractDataProcessor
{
    private PublicationService $publicationService;

    public function __construct(PublicationService $publicationService)
    {
        parent::__construct();
        $this->publicationService = $publicationService;
    }

    protected function addItem(mixed $data, array $filters): Publication
    {
        assert($data instanceof Publication);

        $data->setIdentifier('42');

        return $this->publicationService->addPublication($data);
    }

    protected function removeItem($identifier, $data, array $filters): void
    {
        assert($data instanceof Publication);

        $this->publicationService->removePublication($data);
    }
}
