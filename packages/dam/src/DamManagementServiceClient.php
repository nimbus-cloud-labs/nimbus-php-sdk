<?php

declare(strict_types=1);

namespace NimbusSdk\DamManagement;

use NimbusSdk\Core\AdditionalSuccessResponseSpec;
use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\OperationHandle;
use NimbusSdk\Core\OperationSpec;
use NimbusSdk\Core\PaginationSpec;
use NimbusSdk\Core\SdkConfig;
use NimbusSdk\Core\SdkHttpMethod;
use NimbusSdk\Core\InvalidPathError;

final class DamManagementServiceClient
{
    public function __construct(private NimbusClient $inner)
    {
    }

    public static function fromConfig(SdkConfig $config): DamManagementServiceClient
    {
        return new DamManagementServiceClient(new NimbusClient($config));
    }

    public function innerClient(): NimbusClient
    {
        return $this->inner;
    }

    public function archiveAsset(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::archiveAssetSpec(), $pathParams, $body);
        return $result->body;
    }

    public function beginAssetIngestion(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::beginAssetIngestionSpec(), $pathParams, $body);
        return $result->body;
    }

    public function completeAssetIngestion(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::completeAssetIngestionSpec(), $pathParams, $body);
        return $result->body;
    }

    public function createAssetDownload(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::createAssetDownloadSpec(), $pathParams, null);
        return $result->body;
    }

    public function createAssetPrefix(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createAssetPrefixSpec(), $pathParams, $body);
        return $result->body;
    }

    public function createAssetRenditionDownload(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        if (!array_key_exists('rendition_id', $params)) {
            throw new InvalidPathError('rendition_id');
        }
        $pathParams['rendition_id'] = (string) $params['rendition_id'];
        $result = $this->inner->invoke(self::createAssetRenditionDownloadSpec(), $pathParams, null);
        return $result->body;
    }

    public function createCollection(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createCollectionSpec(), $pathParams, $body);
        return $result->body;
    }

    public function createPipeline(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createPipelineSpec(), $pathParams, $body);
        return $result->body;
    }

    public function createSmartAlbum(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createSmartAlbumSpec(), $pathParams, $body);
        return $result->body;
    }

    public function deleteAsset(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::deleteAssetSpec(), $pathParams, null);
        return $result->body;
    }

    public function deleteAssetPrefix(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('prefix_id', $params)) {
            throw new InvalidPathError('prefix_id');
        }
        $pathParams['prefix_id'] = (string) $params['prefix_id'];
        $result = $this->inner->invoke(self::deleteAssetPrefixSpec(), $pathParams, null);
        return $result->body;
    }

    public function deleteCollection(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('collection_id', $params)) {
            throw new InvalidPathError('collection_id');
        }
        $pathParams['collection_id'] = (string) $params['collection_id'];
        $result = $this->inner->invoke(self::deleteCollectionSpec(), $pathParams, null);
        return $result->body;
    }

    public function deletePipeline(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('pipeline_id', $params)) {
            throw new InvalidPathError('pipeline_id');
        }
        $pathParams['pipeline_id'] = (string) $params['pipeline_id'];
        $result = $this->inner->invoke(self::deletePipelineSpec(), $pathParams, null);
        return $result->body;
    }

    public function deleteSmartAlbum(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('album_id', $params)) {
            throw new InvalidPathError('album_id');
        }
        $pathParams['album_id'] = (string) $params['album_id'];
        $result = $this->inner->invoke(self::deleteSmartAlbumSpec(), $pathParams, null);
        return $result->body;
    }

    public function getAsset(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::getAssetSpec(), $pathParams, null);
        return $result->body;
    }

    public function getAssetRendition(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        if (!array_key_exists('rendition_id', $params)) {
            throw new InvalidPathError('rendition_id');
        }
        $pathParams['rendition_id'] = (string) $params['rendition_id'];
        $result = $this->inner->invoke(self::getAssetRenditionSpec(), $pathParams, null);
        return $result->body;
    }

    public function getAssetVersionMetadata(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        if (!array_key_exists('version_id', $params)) {
            throw new InvalidPathError('version_id');
        }
        $pathParams['version_id'] = (string) $params['version_id'];
        $result = $this->inner->invoke(self::getAssetVersionMetadataSpec(), $pathParams, null);
        return $result->body;
    }

    public function getOperation(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('operation_id', $params)) {
            throw new InvalidPathError('operation_id');
        }
        $pathParams['operation_id'] = (string) $params['operation_id'];
        $result = $this->inner->invoke(self::getOperationSpec(), $pathParams, null);
        return $result->body;
    }

    public function listAssetPrefixes(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listAssetPrefixesSpec(), $pathParams, null);
        return $result->body;
    }

    public function listAssetRenditions(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::listAssetRenditionsSpec(), $pathParams, null);
        return $result->body;
    }

    public function listCollectionMemberships(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('collection_id', $params)) {
            throw new InvalidPathError('collection_id');
        }
        $pathParams['collection_id'] = (string) $params['collection_id'];
        $result = $this->inner->invoke(self::listCollectionMembershipsSpec(), $pathParams, null);
        return $result->body;
    }

    public function listCollections(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listCollectionsSpec(), $pathParams, null);
        return $result->body;
    }

    public function listPipelines(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listPipelinesSpec(), $pathParams, null);
        return $result->body;
    }

    public function listSmartAlbums(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listSmartAlbumsSpec(), $pathParams, null);
        return $result->body;
    }

    public function operationCallback(array $params, array $body): mixed
    {
        $pathParams = [];
        if (!array_key_exists('token', $params)) {
            throw new InvalidPathError('token');
        }
        $pathParams['token'] = (string) $params['token'];
        $result = $this->inner->invoke(self::operationCallbackSpec(), $pathParams, $body);
        return $result->body;
    }

    public function publishAsset(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::publishAssetSpec(), $pathParams, $body);
        return $result->body;
    }

    public function putCollectionMemberships(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('collection_id', $params)) {
            throw new InvalidPathError('collection_id');
        }
        $pathParams['collection_id'] = (string) $params['collection_id'];
        $result = $this->inner->invoke(self::putCollectionMembershipsSpec(), $pathParams, $body);
        return $result->body;
    }

    public function recordIndexSnapshot(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::recordIndexSnapshotSpec(), $pathParams, $body);
        return $result->body;
    }

    public function removeCollectionMembership(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('collection_id', $params)) {
            throw new InvalidPathError('collection_id');
        }
        $pathParams['collection_id'] = (string) $params['collection_id'];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::removeCollectionMembershipSpec(), $pathParams, null);
        return $result->body;
    }

    public function restoreAsset(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::restoreAssetSpec(), $pathParams, $body);
        return $result->body;
    }

    public function retryOperation(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('operation_id', $params)) {
            throw new InvalidPathError('operation_id');
        }
        $pathParams['operation_id'] = (string) $params['operation_id'];
        $result = $this->inner->invoke(self::retryOperationSpec(), $pathParams, null);
        return $result->body;
    }

    public function searchAssets(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::searchAssetsSpec(), $pathParams, $body);
        return $result->body;
    }

    public function searchAssetsWithBody(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::searchAssetsWithBodySpec(), $pathParams, $body);
        return $result->body;
    }

    public function updateAssetCustomMetadata(array $params, array $body): mixed
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        $result = $this->inner->invoke(self::updateAssetCustomMetadataSpec(), $pathParams, $body);
        return $result->body;
    }

    public function updateAssetVersionCustomMetadata(array $params, array $body): mixed
    {
        $pathParams = [];
        if (!array_key_exists('asset_id', $params)) {
            throw new InvalidPathError('asset_id');
        }
        $pathParams['asset_id'] = (string) $params['asset_id'];
        if (!array_key_exists('version_id', $params)) {
            throw new InvalidPathError('version_id');
        }
        $pathParams['version_id'] = (string) $params['version_id'];
        $result = $this->inner->invoke(self::updateAssetVersionCustomMetadataSpec(), $pathParams, $body);
        return $result->body;
    }

    public function updateCollection(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('collection_id', $params)) {
            throw new InvalidPathError('collection_id');
        }
        $pathParams['collection_id'] = (string) $params['collection_id'];
        $result = $this->inner->invoke(self::updateCollectionSpec(), $pathParams, $body);
        return $result->body;
    }

    public function updatePipeline(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('pipeline_id', $params)) {
            throw new InvalidPathError('pipeline_id');
        }
        $pathParams['pipeline_id'] = (string) $params['pipeline_id'];
        $result = $this->inner->invoke(self::updatePipelineSpec(), $pathParams, $body);
        return $result->body;
    }

    public function updateSmartAlbum(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('album_id', $params)) {
            throw new InvalidPathError('album_id');
        }
        $pathParams['album_id'] = (string) $params['album_id'];
        $result = $this->inner->invoke(self::updateSmartAlbumSpec(), $pathParams, $body);
        return $result->body;
    }

    private static function archiveAssetSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ArchiveAsset',
            SdkHttpMethod::POST,
            '/assets/{asset_id}/archive',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function beginAssetIngestionSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'BeginAssetIngestion',
            SdkHttpMethod::POST,
            '/assets/ingest',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function completeAssetIngestionSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CompleteAssetIngestion',
            SdkHttpMethod::POST,
            '/assets/ingest/complete',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createAssetDownloadSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateAssetDownload',
            SdkHttpMethod::POST,
            '/assets/{asset_id}/download',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createAssetPrefixSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateAssetPrefix',
            SdkHttpMethod::POST,
            '/assets/prefixes',
            201,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createAssetRenditionDownloadSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateAssetRenditionDownload',
            SdkHttpMethod::POST,
            '/assets/{asset_id}/renditions/{rendition_id}/download',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createCollectionSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateCollection',
            SdkHttpMethod::POST,
            '/collections',
            201,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createPipelineSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreatePipeline',
            SdkHttpMethod::POST,
            '/pipelines',
            201,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createSmartAlbumSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateSmartAlbum',
            SdkHttpMethod::POST,
            '/albums',
            201,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteAssetSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteAsset',
            SdkHttpMethod::DELETE,
            '/assets/{asset_id}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteAssetPrefixSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteAssetPrefix',
            SdkHttpMethod::DELETE,
            '/assets/prefixes/{prefix_id}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteCollectionSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteCollection',
            SdkHttpMethod::DELETE,
            '/collections/{collection_id}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deletePipelineSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeletePipeline',
            SdkHttpMethod::DELETE,
            '/pipelines/{pipeline_id}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteSmartAlbumSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteSmartAlbum',
            SdkHttpMethod::DELETE,
            '/albums/{album_id}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getAssetSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetAsset',
            SdkHttpMethod::GET,
            '/assets/{asset_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getAssetRenditionSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetAssetRendition',
            SdkHttpMethod::GET,
            '/assets/{asset_id}/renditions/{rendition_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getAssetVersionMetadataSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetAssetVersionMetadata',
            SdkHttpMethod::GET,
            '/assets/{asset_id}/versions/{version_id}/metadata',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getOperationSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetOperation',
            SdkHttpMethod::GET,
            '/operations/{operation_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listAssetPrefixesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListAssetPrefixes',
            SdkHttpMethod::GET,
            '/assets/prefixes',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listAssetRenditionsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListAssetRenditions',
            SdkHttpMethod::GET,
            '/assets/{asset_id}/renditions',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listCollectionMembershipsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListCollectionMemberships',
            SdkHttpMethod::GET,
            '/collections/{collection_id}/memberships',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listCollectionsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListCollections',
            SdkHttpMethod::GET,
            '/collections',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listPipelinesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListPipelines',
            SdkHttpMethod::GET,
            '/pipelines',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listSmartAlbumsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListSmartAlbums',
            SdkHttpMethod::GET,
            '/albums',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function operationCallbackSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'OperationCallback',
            SdkHttpMethod::POST,
            '/operations/callbacks/{token}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function publishAssetSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'PublishAsset',
            SdkHttpMethod::POST,
            '/assets/{asset_id}/publish',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function putCollectionMembershipsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'PutCollectionMemberships',
            SdkHttpMethod::POST,
            '/collections/{collection_id}/memberships',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function recordIndexSnapshotSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RecordIndexSnapshot',
            SdkHttpMethod::POST,
            '/index/snapshots',
            201,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function removeCollectionMembershipSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RemoveCollectionMembership',
            SdkHttpMethod::DELETE,
            '/collections/{collection_id}/memberships/{asset_id}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function restoreAssetSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RestoreAsset',
            SdkHttpMethod::POST,
            '/assets/{asset_id}/restore',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function retryOperationSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RetryOperation',
            SdkHttpMethod::POST,
            '/operations/{operation_id}/retry',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function searchAssetsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'SearchAssets',
            SdkHttpMethod::GET,
            '/assets/search',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function searchAssetsWithBodySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'SearchAssetsWithBody',
            SdkHttpMethod::POST,
            '/assets/search',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateAssetCustomMetadataSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateAssetCustomMetadata',
            SdkHttpMethod::POST,
            '/assets/{asset_id}/metadata/custom',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateAssetVersionCustomMetadataSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateAssetVersionCustomMetadata',
            SdkHttpMethod::POST,
            '/assets/{asset_id}/versions/{version_id}/metadata/custom',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateCollectionSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateCollection',
            SdkHttpMethod::POST,
            '/collections/{collection_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updatePipelineSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdatePipeline',
            SdkHttpMethod::POST,
            '/pipelines/{pipeline_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateSmartAlbumSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateSmartAlbum',
            SdkHttpMethod::POST,
            '/albums/{album_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

}
