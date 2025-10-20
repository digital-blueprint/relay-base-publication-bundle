<?php


declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\API;

use Dbp\Relay\BasePublicationBundle\Entity\Publication;
use Dbp\Relay\CoreBundle\Exception\ApiError;

interface PublicationProviderInterface
{
    /**
     * Retrieve a single publication by its identifier.
     *
     * @param string $identifier
     * @param array $options Available options:
     *                        * Locale::LANGUAGE_OPTION (language in ISO 639-1 format)
     *                        * LocalData::INCLUDE_PARAMETER_NAME
     *
     * @return Publication
     *
     * @throws ApiError
     */
    public function getPublicationById(string $identifier, array $options = []): Publication;

    /**
     * Retrieve a paginated list of publications.
     *
     * @param int $currentPageNumber
     * @param int $maxNumItemsPerPage
     * @param array $options Available options:
     *                       * Locale::LANGUAGE_OPTION (language in ISO 639-1 format)
     *                       * Publication::SEARCH_PARAMETER_NAME (partial, case-insensitive text search on 'title')
     *                       * LocalData::INCLUDE_PARAMETER_NAME
     *
     * @return Publication[]
     *
     * @throws ApiError
     */
    public function getPublications(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array;
}
