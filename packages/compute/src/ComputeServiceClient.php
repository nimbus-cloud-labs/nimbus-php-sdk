<?php

declare(strict_types=1);

namespace NimbusSdk\Compute;

use NimbusSdk\Core\AdditionalSuccessResponseSpec;
use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\OperationHandle;
use NimbusSdk\Core\OperationSpec;
use NimbusSdk\Core\PaginationSpec;
use NimbusSdk\Core\SdkConfig;
use NimbusSdk\Core\SdkHttpMethod;
use NimbusSdk\Core\InvalidPathError;
use NimbusSdk\Core\Paginator;

final class ComputeServiceClient
{
    public function __construct(private NimbusClient $inner)
    {
    }

    public static function fromConfig(SdkConfig $config): ComputeServiceClient
    {
        return new ComputeServiceClient(new NimbusClient($config));
    }

    public function innerClient(): NimbusClient
    {
        return $this->inner;
    }

    public function attachInterface(array $params, array $body): OperationHandle
    {
        $pathParams = [];
        if (!array_key_exists('switch', $params)) {
            throw new InvalidPathError('switch');
        }
        $pathParams['switch'] = (string) $params['switch'];
        $result = $this->inner->invoke(self::attachInterfaceSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function attachInterfaceAndWait(array $params, array $body): OperationHandle
    {
        $handle = $this->attachInterface($params, $body);
        return $this->inner->waiter()->wait($handle);
    }

    public function bootstrapAgentCredentials(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        $result = $this->inner->invoke(self::bootstrapAgentCredentialsSpec(), $pathParams, $body);
        return $result->body;
    }

    public function claimAgentJob(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        $result = $this->inner->invoke(self::claimAgentJobSpec(), $pathParams, null);
        return $result->body;
    }

    public function completeAgentJob(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        if (!array_key_exists('job_id', $params)) {
            throw new InvalidPathError('job_id');
        }
        $pathParams['job_id'] = (string) $params['job_id'];
        $result = $this->inner->invoke(self::completeAgentJobSpec(), $pathParams, null);
        return $result->body;
    }

    public function createNetwork(array $body): OperationHandle
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createNetworkSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function createNetworkAndWait(array $body): OperationHandle
    {
        $handle = $this->createNetwork($body);
        return $this->inner->waiter()->wait($handle);
    }

    public function createNic(array $body): OperationHandle
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createNicSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function createNicAndWait(array $body): OperationHandle
    {
        $handle = $this->createNic($body);
        return $this->inner->waiter()->wait($handle);
    }

    public function createSwitch(array $body): OperationHandle
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createSwitchSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function createSwitchAndWait(array $body): OperationHandle
    {
        $handle = $this->createSwitch($body);
        return $this->inner->waiter()->wait($handle);
    }

    public function createVm(array $body): OperationHandle
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createVmSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function createVmAndWait(array $body): OperationHandle
    {
        $handle = $this->createVm($body);
        return $this->inner->waiter()->wait($handle);
    }

    public function deleteVm(array $params): OperationHandle
    {
        $pathParams = [];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::deleteVmSpec(), $pathParams, null);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function deleteVmAndWait(array $params): OperationHandle
    {
        $handle = $this->deleteVm($params);
        return $this->inner->waiter()->wait($handle);
    }

    public function detachInterface(array $params, array $body): OperationHandle
    {
        $pathParams = [];
        if (!array_key_exists('switch', $params)) {
            throw new InvalidPathError('switch');
        }
        $pathParams['switch'] = (string) $params['switch'];
        $result = $this->inner->invoke(self::detachInterfaceSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function detachInterfaceAndWait(array $params, array $body): OperationHandle
    {
        $handle = $this->detachInterface($params, $body);
        return $this->inner->waiter()->wait($handle);
    }

    public function failAgentJob(array $params, array $body): mixed
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        if (!array_key_exists('job_id', $params)) {
            throw new InvalidPathError('job_id');
        }
        $pathParams['job_id'] = (string) $params['job_id'];
        $result = $this->inner->invoke(self::failAgentJobSpec(), $pathParams, $body);
        return $result->body;
    }

    public function getAgentMetadata(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        if (!array_key_exists('path', $params)) {
            throw new InvalidPathError('path');
        }
        $pathParams['path'] = (string) $params['path'];
        $result = $this->inner->invoke(self::getAgentMetadataSpec(), $pathParams, null);
        return $result->body;
    }

    public function getMetrics(): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::getMetricsSpec(), $pathParams, null);
        return $result->body;
    }

    public function heartbeat(array $body): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::heartbeatSpec(), $pathParams, $body);
        return $result->body;
    }

    public function listIdempotencyRecords(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listIdempotencyRecordsSpec(), $pathParams, null);
        return $result->body;
    }

    public function listNetworks(): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listNetworksSpec(), $pathParams, null);
        return $result->body;
    }

    public function paginateListNetworks(): Paginator
    {
        $pathParams = [];
        return $this->inner->paginator(self::listNetworksSpec(), $pathParams);
    }

    public function listNics(): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listNicsSpec(), $pathParams, null);
        return $result->body;
    }

    public function paginateListNics(): Paginator
    {
        $pathParams = [];
        return $this->inner->paginator(self::listNicsSpec(), $pathParams);
    }

    public function lookupPxeBoot(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::lookupPxeBootSpec(), $pathParams, $body);
        return $result->body;
    }

    public function migrateVm(array $params, array $body): OperationHandle
    {
        $pathParams = [];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::migrateVmSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function migrateVmAndWait(array $params, array $body): OperationHandle
    {
        $handle = $this->migrateVm($params, $body);
        return $this->inner->waiter()->wait($handle);
    }

    public function reportAgentStatus(array $params, array $body): mixed
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        $result = $this->inner->invoke(self::reportAgentStatusSpec(), $pathParams, $body);
        return $result->body;
    }

    public function rotateAgentCredentials(array $params, array $body): mixed
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        $result = $this->inner->invoke(self::rotateAgentCredentialsSpec(), $pathParams, $body);
        return $result->body;
    }

    public function shutdownHost(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('host_id', $params)) {
            throw new InvalidPathError('host_id');
        }
        $pathParams['host_id'] = (string) $params['host_id'];
        $result = $this->inner->invoke(self::shutdownHostSpec(), $pathParams, null);
        return $result->body;
    }

    public function startVm(array $params): OperationHandle
    {
        $pathParams = [];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::startVmSpec(), $pathParams, null);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function startVmAndWait(array $params): OperationHandle
    {
        $handle = $this->startVm($params);
        return $this->inner->waiter()->wait($handle);
    }

    public function stopVm(array $params): OperationHandle
    {
        $pathParams = [];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::stopVmSpec(), $pathParams, null);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function stopVmAndWait(array $params): OperationHandle
    {
        $handle = $this->stopVm($params);
        return $this->inner->waiter()->wait($handle);
    }

    public function updateNetwork(array $params, array $body): OperationHandle
    {
        $pathParams = [];
        if (!array_key_exists('network_id', $params)) {
            throw new InvalidPathError('network_id');
        }
        $pathParams['network_id'] = (string) $params['network_id'];
        $result = $this->inner->invoke(self::updateNetworkSpec(), $pathParams, $body);
        return OperationHandle::fromArray((array) $result->body);
    }

    public function updateNetworkAndWait(array $params, array $body): OperationHandle
    {
        $handle = $this->updateNetwork($params, $body);
        return $this->inner->waiter()->wait($handle);
    }

    public function upsertBootRegistryEntry(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('mac', $params)) {
            throw new InvalidPathError('mac');
        }
        $pathParams['mac'] = (string) $params['mac'];
        $result = $this->inner->invoke(self::upsertBootRegistryEntrySpec(), $pathParams, $body);
        return $result->body;
    }

    private static function attachInterfaceSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'AttachInterface',
            SdkHttpMethod::POST,
            '/switches/{switch}/attach',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function bootstrapAgentCredentialsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'BootstrapAgentCredentials',
            SdkHttpMethod::POST,
            '/agents/{host_id}/credentials/bootstrap',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function claimAgentJobSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ClaimAgentJob',
            SdkHttpMethod::POST,
            '/agents/{host_id}/jobs/next',
            200,
            [
                new AdditionalSuccessResponseSpec(204, false),
            ],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function completeAgentJobSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CompleteAgentJob',
            SdkHttpMethod::POST,
            '/agents/{host_id}/jobs/{job_id}/complete',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function createNetworkSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateNetwork',
            SdkHttpMethod::POST,
            '/networks',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function createNicSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateNic',
            SdkHttpMethod::POST,
            '/nics',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function createSwitchSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateSwitch',
            SdkHttpMethod::POST,
            '/switches',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function createVmSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateVm',
            SdkHttpMethod::POST,
            '/vms',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function deleteVmSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteVm',
            SdkHttpMethod::DELETE,
            '/vms/{id}',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function detachInterfaceSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DetachInterface',
            SdkHttpMethod::POST,
            '/switches/{switch}/detach',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function failAgentJobSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'FailAgentJob',
            SdkHttpMethod::POST,
            '/agents/{host_id}/jobs/{job_id}/fail',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function getAgentMetadataSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetAgentMetadata',
            SdkHttpMethod::GET,
            '/agents/{host_id}/metadata/{*path}',
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

    private static function heartbeatSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'Heartbeat',
            SdkHttpMethod::POST,
            '/heartbeat',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listIdempotencyRecordsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListIdempotencyRecords',
            SdkHttpMethod::GET,
            '/internal/idempotency',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listNetworksSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListNetworks',
            SdkHttpMethod::GET,
            '/networks',
            200,
            [
                new AdditionalSuccessResponseSpec(206, false),
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

    private static function listNicsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListNics',
            SdkHttpMethod::GET,
            '/nics',
            200,
            [
                new AdditionalSuccessResponseSpec(206, false),
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

    private static function lookupPxeBootSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'LookupPxeBoot',
            SdkHttpMethod::POST,
            '/internal/boot/pxe/lookup',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function migrateVmSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'MigrateVm',
            SdkHttpMethod::POST,
            '/vms/{id}/migrate',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function reportAgentStatusSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ReportAgentStatus',
            SdkHttpMethod::POST,
            '/agents/{host_id}/status',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function rotateAgentCredentialsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RotateAgentCredentials',
            SdkHttpMethod::PUT,
            '/agents/{host_id}/credentials',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function shutdownHostSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ShutdownHost',
            SdkHttpMethod::POST,
            '/hosts/{host_id}/shutdown',
            202,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function startVmSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'StartVm',
            SdkHttpMethod::POST,
            '/vms/{id}/start',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function stopVmSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'StopVm',
            SdkHttpMethod::POST,
            '/vms/{id}/stop',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function updateNetworkSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateNetwork',
            SdkHttpMethod::PUT,
            '/networks/{network_id}',
            202,
            [],
            true,
            null,
            true
        );
        return $spec;
    }

    private static function upsertBootRegistryEntrySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpsertBootRegistryEntry',
            SdkHttpMethod::PUT,
            '/internal/boot/registry/{mac}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

}
