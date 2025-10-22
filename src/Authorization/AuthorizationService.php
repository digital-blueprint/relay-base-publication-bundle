<?php


declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Authorization;

use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;
use Dbp\Relay\CoreBundle\Authorization\AuthorizationException;
use Dbp\Relay\BasePublicationBundle\DependencyInjection\Configuration;

class AuthorizationService extends AbstractAuthorizationService
{
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
            //$this->isGrantedRole(Configuration::ROLE_ADMIN);
        } catch (AuthorizationException $authorizationException) {
            throw new \RuntimeException($authorizationException->getMessage());
        }
    }
}

/*
<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Authorization;

use Dbp\Relay\CoreBundle\Authorization\AbstractAuthorizationService;
use Dbp\Relay\CoreBundle\Authorization\AuthorizationException;
use Dbp\Relay\BasePublicationBundle\DependencyInjection\Configuration;
use Symfony\Component\Security\Core\Security;

class AuthorizationService extends AbstractAuthorizationService
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


public function isUser(): bool
{
    // Temporary debugging
    $user = $this->security->getUser();
    if ($user) {
        error_log("=== Authorization Debug ===");
        error_log("User class: " . get_class($user));
        error_log("User identifier: " . $user->getUserIdentifier());

        // Check available methods
        $methods = get_class_methods($user);
        error_log("Available methods: " . implode(', ', $methods));

        // Try to get attributes/claims
        if (method_exists($user, 'getAttributes')) {
            $attrs = $user->getAttributes();
            error_log("Attributes: " . json_encode($attrs));
        }
        if (method_exists($user, 'getClaims')) {
            $claims = $user->getClaims();
            error_log("Claims: " . json_encode($claims));
        }
        if (method_exists($user, 'getRoles')) {
            $roles = $user->getRoles();
            error_log("Roles: " . json_encode($roles));
        }
    }

    $result = $this->isGrantedRole(Configuration::ROLE_USER);
    error_log("ROLE_USER granted: " . ($result ? 'YES' : 'NO'));
    error_log("=== End Debug ===");

    return $result;
}


public function isAdmin(): bool
{
    return $this->isGrantedRole(Configuration::ROLE_ADMIN);
}

public function validateConfiguration()
{
    try {
        $this->isGrantedRole(Configuration::ROLE_USER);
        $this->isGrantedRole(Configuration::ROLE_ADMIN);
    } catch (AuthorizationException $authorizationException) {
        throw new \RuntimeException($authorizationException->getMessage());
    }
}
}


 */