<?php

declare(strict_types=1);

namespace NimbusSdk\Core;

final class Paginator implements \IteratorAggregate
{
    /** @param array<string, string> $pathParams */
    public function __construct(
        private NimbusClient $client,
        private OperationSpec $spec,
        private array $pathParams
    ) {
    }

    public function getIterator(): \Traversable
    {
        $cursor = null;
        while (true) {
            $result = $this->client->invoke($this->spec, $this->pathParams, null, $cursor);
            yield $result->body;
            if ($result->nextCursor === null) {
                break;
            }
            $cursor = $result->nextCursor;
        }
    }
}
