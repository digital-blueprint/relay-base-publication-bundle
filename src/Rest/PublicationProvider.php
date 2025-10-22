<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Rest;

use Dbp\Relay\BasePublicationBundle\Entity\Publication;
use Dbp\Relay\BasePublicationBundle\Service\PublicationService;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Dbp\Relay\BasePublicationBundle\Authorization\AuthorizationService;

/**
 * @extends AbstractDataProvider<Publication>
 */
class PublicationProvider extends AbstractDataProvider
{
    private PublicationService $publicationService;
    private AuthorizationService $authorizationService;

    public function __construct(PublicationService $publicationService, AuthorizationService $authorizationService)
    {
        parent::__construct();
        $this->publicationService = $publicationService;
        $this->authorizationService = $authorizationService;
    }

    protected function getItemById(string $id, array $filters = [], array $options = []): ?Publication
    {
        return $this->publicationService->getPublication($id, $filters, $options);
    }

    /**
     * @return Publication[]
     */
    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        return $this->publicationService->getPublications($currentPageNumber, $maxNumItemsPerPage, $filters, $options);
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        //return true;
        return $this->authorizationService->isUser();
    }
}