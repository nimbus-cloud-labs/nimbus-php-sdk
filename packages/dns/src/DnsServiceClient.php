<?php

declare(strict_types=1);

namespace NimbusSdk\Dns;

use NimbusSdk\Core\AdditionalSuccessResponseSpec;
use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\OperationHandle;
use NimbusSdk\Core\OperationSpec;
use NimbusSdk\Core\PaginationSpec;
use NimbusSdk\Core\SdkConfig;
use NimbusSdk\Core\SdkHttpMethod;
use NimbusSdk\Core\InvalidPathError;
use NimbusSdk\Core\Paginator;

final class DnsServiceClient
{
    public function __construct(private NimbusClient $inner)
    {
    }

    public static function fromConfig(SdkConfig $config): DnsServiceClient
    {
        return new DnsServiceClient(new NimbusClient($config));
    }

    public function innerClient(): NimbusClient
    {
        return $this->inner;
    }

    public function createRecord(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('zone_id', $params)) {
            throw new InvalidPathError('zone_id');
        }
        $pathParams['zone_id'] = (string) $params['zone_id'];
        $result = $this->inner->invoke(self::createRecordSpec(), $pathParams, $body);
        return $result->body;
    }

    public function createZone(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createZoneSpec(), $pathParams, $body);
        return $result->body;
    }

    public function deleteRecord(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('record_id', $params)) {
            throw new InvalidPathError('record_id');
        }
        $pathParams['record_id'] = (string) $params['record_id'];
        $result = $this->inner->invoke(self::deleteRecordSpec(), $pathParams, $body);
        return $result->body;
    }

    public function deleteZone(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('zone_id', $params)) {
            throw new InvalidPathError('zone_id');
        }
        $pathParams['zone_id'] = (string) $params['zone_id'];
        $result = $this->inner->invoke(self::deleteZoneSpec(), $pathParams, $body);
        return $result->body;
    }

    public function getHealth(): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::getHealthSpec(), $pathParams, null);
        return $result->body;
    }

    public function getMetrics(): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::getMetricsSpec(), $pathParams, null);
        return $result->body;
    }

    public function listRecords(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listRecordsSpec(), $pathParams, null);
        return $result->body;
    }

    public function paginateListRecords(): Paginator
    {
        $pathParams = [];
        return $this->inner->paginator(self::listRecordsSpec(), $pathParams);
    }

    public function listZoneRecords(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('zone_id', $params)) {
            throw new InvalidPathError('zone_id');
        }
        $pathParams['zone_id'] = (string) $params['zone_id'];
        $result = $this->inner->invoke(self::listZoneRecordsSpec(), $pathParams, null);
        return $result->body;
    }

    public function paginateListZoneRecords(array $params): Paginator
    {
        $pathParams = [];
        if (!array_key_exists('zone_id', $params)) {
            throw new InvalidPathError('zone_id');
        }
        $pathParams['zone_id'] = (string) $params['zone_id'];
        return $this->inner->paginator(self::listZoneRecordsSpec(), $pathParams);
    }

    public function listZones(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listZonesSpec(), $pathParams, null);
        return $result->body;
    }

    public function paginateListZones(): Paginator
    {
        $pathParams = [];
        return $this->inner->paginator(self::listZonesSpec(), $pathParams);
    }

    public function reloadRuntime(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::reloadRuntimeSpec(), $pathParams, null);
        return $result->body;
    }

    public function reloadZone(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('zone_id', $params)) {
            throw new InvalidPathError('zone_id');
        }
        $pathParams['zone_id'] = (string) $params['zone_id'];
        $result = $this->inner->invoke(self::reloadZoneSpec(), $pathParams, null);
        return $result->body;
    }

    public function scheduleRuntimeSync(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::scheduleRuntimeSyncSpec(), $pathParams, null);
        return $result->body;
    }

    public function scheduleZoneSync(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('zone_id', $params)) {
            throw new InvalidPathError('zone_id');
        }
        $pathParams['zone_id'] = (string) $params['zone_id'];
        $result = $this->inner->invoke(self::scheduleZoneSyncSpec(), $pathParams, null);
        return $result->body;
    }

    public function updateRecord(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('record_id', $params)) {
            throw new InvalidPathError('record_id');
        }
        $pathParams['record_id'] = (string) $params['record_id'];
        $result = $this->inner->invoke(self::updateRecordSpec(), $pathParams, $body);
        return $result->body;
    }

    public function updateZone(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('zone_id', $params)) {
            throw new InvalidPathError('zone_id');
        }
        $pathParams['zone_id'] = (string) $params['zone_id'];
        $result = $this->inner->invoke(self::updateZoneSpec(), $pathParams, $body);
        return $result->body;
    }

    private static function createRecordSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateRecord',
            SdkHttpMethod::POST,
            '/zones/{zone_id}/records',
            201,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createZoneSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateZone',
            SdkHttpMethod::POST,
            '/zones',
            201,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteRecordSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteRecord',
            SdkHttpMethod::DELETE,
            '/records/{record_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteZoneSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteZone',
            SdkHttpMethod::DELETE,
            '/zones/{zone_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
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
            '/health',
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

    private static function listRecordsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListRecords',
            SdkHttpMethod::GET,
            '/records',
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

    private static function listZoneRecordsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListZoneRecords',
            SdkHttpMethod::GET,
            '/zones/{zone_id}/records',
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

    private static function listZonesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListZones',
            SdkHttpMethod::GET,
            '/zones',
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

    private static function reloadRuntimeSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ReloadRuntime',
            SdkHttpMethod::POST,
            '/runtime/reload',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function reloadZoneSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ReloadZone',
            SdkHttpMethod::POST,
            '/zones/{zone_id}/reload',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function scheduleRuntimeSyncSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ScheduleRuntimeSync',
            SdkHttpMethod::POST,
            '/runtime/sync',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function scheduleZoneSyncSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ScheduleZoneSync',
            SdkHttpMethod::POST,
            '/zones/{zone_id}/sync',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateRecordSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateRecord',
            SdkHttpMethod::PUT,
            '/records/{record_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateZoneSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateZone',
            SdkHttpMethod::PUT,
            '/zones/{zone_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

}
