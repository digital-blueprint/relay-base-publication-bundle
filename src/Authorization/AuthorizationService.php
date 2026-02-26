<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Authorization;

use Dbp\Relay\BasePublicationBundle\DependencyInjection\Configuration;
use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;
use Dbp\Relay\CoreBundle\Authorization\AuthorizationException;

class AuthorizationService extends AbstractAuthorizationService
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns if the user can use the API at all.
     */
    public function isUser(): bool
    {
        return $this->isGrantedRole(Configuration::ROLE_USER);
    }

    public function validateConfiguration()
    {
        try {
            $this->isGrantedRole(Configuration::ROLE_USER);
            // $this->isGrantedRole(Configuration::ROLE_ADMIN);
        } catch (AuthorizationException $authorizationException) {
            throw new \RuntimeException($authorizationException->getMessage());
        }
    }
}
