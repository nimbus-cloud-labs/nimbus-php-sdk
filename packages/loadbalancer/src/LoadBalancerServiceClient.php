<?php

declare(strict_types=1);

namespace NimbusSdk\LoadBalancer;

use NimbusSdk\Core\AdditionalSuccessResponseSpec;
use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\OperationHandle;
use NimbusSdk\Core\OperationSpec;
use NimbusSdk\Core\PaginationSpec;
use NimbusSdk\Core\SdkConfig;
use NimbusSdk\Core\SdkHttpMethod;
use NimbusSdk\Core\Paginator;

final class LoadBalancerServiceClient
{
    public function __construct(private NimbusClient $inner)
    {
    }

    public static function fromConfig(SdkConfig $config): LoadBalancerServiceClient
    {
        return new LoadBalancerServiceClient(new NimbusClient($config));
    }

    public function innerClient(): NimbusClient
    {
        return $this->inner;
    }

    /**
     * Liveness probe for the load balancer management API.
     */
    public function getHealth(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::getHealthSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Prometheus metrics endpoint used by operators.
     */
    public function getMetrics(): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::getMetricsSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Returns listener statuses. Requires the lb:read scope and honors Range pagination.
     */
    public function listListeners(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listListenersSpec(), $pathParams, null);
        return $result->body;
    }

    public function paginateListListeners(): Paginator
    {
        $pathParams = [];
        return $this->inner->paginator(self::listListenersSpec(), $pathParams);
    }

    /**
     * Reloads listener definitions. Requires the lb:manage scope.
     */
    public function reloadListeners(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::reloadListenersSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Schedules reconciliation against the control plane. Requires the lb:manage scope.
     */
    public function scheduleSync(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::scheduleSyncSpec(), $pathParams, null);
        return $result->body;
    }

    private static function getHealthSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetHealth',
            SdkHttpMethod::GET,
            '/healthz',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getMetricsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetMetrics',
            SdkHttpMethod::GET,
            '/metrics',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listListenersSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListListeners',
            SdkHttpMethod::GET,
            '/listeners',
            200,
            [
                new AdditionalSuccessResponseSpec(206, true),
            ],
            false,
            new PaginationSpec(
                'Range',
                'Content-Range'
            ),
            false
        );
        return $spec;
    }

    private static function reloadListenersSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ReloadListeners',
            SdkHttpMethod::POST,
            '/listeners/reload',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function scheduleSyncSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ScheduleSync',
            SdkHttpMethod::POST,
            '/listeners/sync',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

}
