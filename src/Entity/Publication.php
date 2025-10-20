<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use Dbp\Relay\BasePublicationBundle\Rest\PublicationProcessor;
use Dbp\Relay\BasePublicationBundle\Rest\PublicationProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    shortName: 'BasePublicationPublication',
    types: ['https://schema.org/Publication'],
    operations: [
        new Get(
            uriTemplate: '/base/publications/{identifier}',
            openapi: new Operation(
                tags: ['BasePublication'],
            ),
            provider: PublicationProvider::class
        ),
        new GetCollection(
            uriTemplate: '/base/publications',
            openapi: new Operation(
                tags: ['BasePublication'],
            ),
            provider: PublicationProvider::class
        ),
        new Post(
            uriTemplate: '/base/publications',
            openapi: new Operation(
                tags: ['BasePublication'],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/ld+json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'name' => ['type' => 'string'],
                                ],
                                'required' => ['name'],
                            ],
                            'example' => [
                                'name' => 'Example Name',
                            ],
                        ],
                    ])
                )
            ),
            processor: PublicationProcessor::class
        ),
        new Delete(
            uriTemplate: '/base/publications/{identifier}',
            openapi: new Operation(
                tags: ['BasePublication'],
            ),
            provider: PublicationProvider::class,
            processor: PublicationProcessor::class
        ),
    ],
    normalizationContext: ['groups' => ['BasePublicationPublication:output']],
    denormalizationContext: ['groups' => ['BasePublicationPublication:input']]
)]
class Publication
{
    #[ApiProperty(identifier: true)]
    #[Groups(['BasePublicationPublication:output'])]
    private ?string $identifier = null;

    #[ApiProperty(iris: ['https://schema.org/name'])]
    #[Groups(['BasePublicationPublication:output', 'BasePublicationPublication:input'])]
    private ?string $name;

    #[ApiProperty(iris: ['https://schema.org/author'])]
    #[Groups(['BasePublicationPublication:output', 'BasePublicationPublication:input'])]
    private ?string $authors = null;

    #[ApiProperty(iris: ['https://schema.org/identifier'])]
    #[Groups(['BasePublicationPublication:output', 'BasePublicationPublication:input'])]
    private ?string $uuid = null;

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAuthors(): ?string
    {
        return $this->authors;
    }

    public function setAuthors(?string $authors): void
    {
        $this->authors = $authors;
    }

     public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): void
    {
        $this->uuid = $uuid;
    }
}
