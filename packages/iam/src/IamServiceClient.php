<?php

declare(strict_types=1);

namespace NimbusSdk\Iam;

use NimbusSdk\Core\AdditionalSuccessResponseSpec;
use NimbusSdk\Core\NimbusClient;
use NimbusSdk\Core\OperationHandle;
use NimbusSdk\Core\OperationSpec;
use NimbusSdk\Core\PaginationSpec;
use NimbusSdk\Core\SdkConfig;
use NimbusSdk\Core\SdkHttpMethod;
use NimbusSdk\Core\InvalidPathError;

final class IamServiceClient
{
    public function __construct(private NimbusClient $inner)
    {
    }

    public static function fromConfig(SdkConfig $config): IamServiceClient
    {
        return new IamServiceClient(new NimbusClient($config));
    }

    public function innerClient(): NimbusClient
    {
        return $this->inner;
    }

    /**
     * Adds a role binding to a group.
     */
    public function addGroupRole(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        $result = $this->inner->invoke(self::addGroupRoleSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Adds a user to a group.
     */
    public function addUserToGroup(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        $result = $this->inner->invoke(self::addUserToGroupSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Assumes a role and returns temporary session credentials.
     */
    public function assumeRole(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::assumeRoleSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Attaches a managed policy to a principal.
     */
    public function attachManagedPolicy(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('type', $params)) {
            throw new InvalidPathError('type');
        }
        $pathParams['type'] = (string) $params['type'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::attachManagedPolicySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Attaches a policy to a principal.
     */
    public function attachPolicyToPrincipal(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('type', $params)) {
            throw new InvalidPathError('type');
        }
        $pathParams['type'] = (string) $params['type'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::attachPolicyToPrincipalSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a new OIDC provider.
     */
    public function createOidcProvider(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createOidcProviderSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a new policy within the caller's tenant.
     */
    public function createPolicy(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createPolicySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a new IAM principal.
     */
    public function createPrincipal(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createPrincipalSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a new role.
     */
    public function createRole(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createRoleSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a new service account.
     */
    public function createServiceAccount(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::createServiceAccountSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a new key for a service account.
     */
    public function createServiceAccountKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        $result = $this->inner->invoke(self::createServiceAccountKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a signing key for a tenant.
     */
    public function createSigningKey(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        $result = $this->inner->invoke(self::createSigningKeySpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Creates a group for a tenant.
     */
    public function createTenantGroup(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        $result = $this->inner->invoke(self::createTenantGroupSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a user within a tenant.
     */
    public function createTenantUser(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        $result = $this->inner->invoke(self::createTenantUserSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Creates a new key for a user.
     */
    public function createUserKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::createUserKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Deletes a group.
     */
    public function deleteGroup(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        $result = $this->inner->invoke(self::deleteGroupSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Deletes an OIDC provider.
     */
    public function deleteOidcProvider(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('provider_id', $params)) {
            throw new InvalidPathError('provider_id');
        }
        $pathParams['provider_id'] = (string) $params['provider_id'];
        $result = $this->inner->invoke(self::deleteOidcProviderSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Deletes a policy permanently.
     */
    public function deletePolicy(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::deletePolicySpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Deletes a role.
     */
    public function deleteRole(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('role_id', $params)) {
            throw new InvalidPathError('role_id');
        }
        $pathParams['role_id'] = (string) $params['role_id'];
        $result = $this->inner->invoke(self::deleteRoleSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Deletes a service account.
     */
    public function deleteServiceAccount(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        $result = $this->inner->invoke(self::deleteServiceAccountSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Deletes a service account key.
     */
    public function deleteServiceAccountKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        if (!array_key_exists('key_id', $params)) {
            throw new InvalidPathError('key_id');
        }
        $pathParams['key_id'] = (string) $params['key_id'];
        $result = $this->inner->invoke(self::deleteServiceAccountKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Deletes a user.
     */
    public function deleteUser(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::deleteUserSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Deletes a user key.
     */
    public function deleteUserKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        if (!array_key_exists('key_id', $params)) {
            throw new InvalidPathError('key_id');
        }
        $pathParams['key_id'] = (string) $params['key_id'];
        $result = $this->inner->invoke(self::deleteUserKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Detaches a managed policy from a principal.
     */
    public function detachManagedPolicy(array $params): mixed
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('type', $params)) {
            throw new InvalidPathError('type');
        }
        $pathParams['type'] = (string) $params['type'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        if (!array_key_exists('policy_id', $params)) {
            throw new InvalidPathError('policy_id');
        }
        $pathParams['policy_id'] = (string) $params['policy_id'];
        $result = $this->inner->invoke(self::detachManagedPolicySpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Detaches a policy from a principal.
     */
    public function detachPolicyFromPrincipal(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('type', $params)) {
            throw new InvalidPathError('type');
        }
        $pathParams['type'] = (string) $params['type'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        if (!array_key_exists('policy_id', $params)) {
            throw new InvalidPathError('policy_id');
        }
        $pathParams['policy_id'] = (string) $params['policy_id'];
        $result = $this->inner->invoke(self::detachPolicyFromPrincipalSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Disables a service account key.
     */
    public function disableServiceAccountKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        if (!array_key_exists('key_id', $params)) {
            throw new InvalidPathError('key_id');
        }
        $pathParams['key_id'] = (string) $params['key_id'];
        $result = $this->inner->invoke(self::disableServiceAccountKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Disables a user login.
     */
    public function disableUser(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::disableUserSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Disables a user key.
     */
    public function disableUserKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        if (!array_key_exists('key_id', $params)) {
            throw new InvalidPathError('key_id');
        }
        $pathParams['key_id'] = (string) $params['key_id'];
        $result = $this->inner->invoke(self::disableUserKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Issues a signed token for the requested principal.
     */
    public function emitToken(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::emitTokenSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Enables a service account key.
     */
    public function enableServiceAccountKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        if (!array_key_exists('key_id', $params)) {
            throw new InvalidPathError('key_id');
        }
        $pathParams['key_id'] = (string) $params['key_id'];
        $result = $this->inner->invoke(self::enableServiceAccountKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Enables a user login.
     */
    public function enableUser(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::enableUserSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Enables a user key.
     */
    public function enableUserKey(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        if (!array_key_exists('key_id', $params)) {
            throw new InvalidPathError('key_id');
        }
        $pathParams['key_id'] = (string) $params['key_id'];
        $result = $this->inner->invoke(self::enableUserKeySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Exports audit events for the current tenant.
     */
    public function exportAuditEvents(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::exportAuditEventsSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Loads a single audit event by identifier.
     */
    public function getAuditEvent(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('event_id', $params)) {
            throw new InvalidPathError('event_id');
        }
        $pathParams['event_id'] = (string) $params['event_id'];
        $result = $this->inner->invoke(self::getAuditEventSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Loads a group by identifier.
     */
    public function getGroup(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        $result = $this->inner->invoke(self::getGroupSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Loads a single managed policy by identifier.
     */
    public function getManagedPolicy(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('policy_id', $params)) {
            throw new InvalidPathError('policy_id');
        }
        $pathParams['policy_id'] = (string) $params['policy_id'];
        $result = $this->inner->invoke(self::getManagedPolicySpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Loads an OIDC provider by identifier.
     */
    public function getOidcProvider(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('provider_id', $params)) {
            throw new InvalidPathError('provider_id');
        }
        $pathParams['provider_id'] = (string) $params['provider_id'];
        $result = $this->inner->invoke(self::getOidcProviderSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Loads a single policy by identifier.
     */
    public function getPolicy(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::getPolicySpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Retrieves a principal by tenant, type, and identifier.
     */
    public function getPrincipal(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('type', $params)) {
            throw new InvalidPathError('type');
        }
        $pathParams['type'] = (string) $params['type'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::getPrincipalSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Loads a role by identifier.
     */
    public function getRole(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('role_id', $params)) {
            throw new InvalidPathError('role_id');
        }
        $pathParams['role_id'] = (string) $params['role_id'];
        $result = $this->inner->invoke(self::getRoleSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Loads a service account by identifier.
     */
    public function getServiceAccount(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        $result = $this->inner->invoke(self::getServiceAccountSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Loads a tenant by identifier.
     */
    public function getTenant(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant_id', $params)) {
            throw new InvalidPathError('tenant_id');
        }
        $pathParams['tenant_id'] = (string) $params['tenant_id'];
        $result = $this->inner->invoke(self::getTenantSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Loads a user by identifier.
     */
    public function getUser(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::getUserSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Invites a new user to the account.
     */
    public function inviteUser(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::inviteUserSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists audit events for the current tenant.
     */
    public function listAuditEvents(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listAuditEventsSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists group members.
     */
    public function listGroupMembers(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        $result = $this->inner->invoke(self::listGroupMembersSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists role bindings for a group.
     */
    public function listGroupRoles(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        $result = $this->inner->invoke(self::listGroupRolesSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists groups for the current account.
     */
    public function listGroups(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listGroupsSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists available managed policies.
     */
    public function listManagedPolicies(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listManagedPoliciesSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists OIDC providers for the account.
     */
    public function listOidcProviders(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listOidcProvidersSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists policies for the resolved tenant.
     */
    public function listPolicies(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listPoliciesSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists versions for the specified policy.
     */
    public function listPolicyVersions(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('policy_id', $params)) {
            throw new InvalidPathError('policy_id');
        }
        $pathParams['policy_id'] = (string) $params['policy_id'];
        $result = $this->inner->invoke(self::listPolicyVersionsSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists managed policies attached to a principal.
     */
    public function listPrincipalManagedPolicies(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('type', $params)) {
            throw new InvalidPathError('type');
        }
        $pathParams['type'] = (string) $params['type'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::listPrincipalManagedPoliciesSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists roles for the account.
     */
    public function listRoles(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listRolesSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists keys for a service account.
     */
    public function listServiceAccountKeys(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        $result = $this->inner->invoke(self::listServiceAccountKeysSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists service accounts for the current account.
     */
    public function listServiceAccounts(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listServiceAccountsSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists console sessions for the account.
     */
    public function listSessions(array $body): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listSessionsSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists tenants for the account.
     */
    public function listTenants(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listTenantsSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists keys for a user.
     */
    public function listUserKeys(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::listUserKeysSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Lists sessions for a user.
     */
    public function listUserSessions(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::listUserSessionsSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Lists users for the account.
     */
    public function listUsers(): array
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::listUsersSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Accepts an audit event payload for storage.
     */
    public function publishAuditEvent(array $body): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::publishAuditEventSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Removes a member from a group.
     */
    public function removeGroupMember(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::removeGroupMemberSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Removes a role binding from a group.
     */
    public function removeGroupRole(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        if (!array_key_exists('role_id', $params)) {
            throw new InvalidPathError('role_id');
        }
        $pathParams['role_id'] = (string) $params['role_id'];
        $result = $this->inner->invoke(self::removeGroupRoleSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Revokes sessions matching the supplied filters.
     */
    public function revokeAllSessions(array $body): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::revokeAllSessionsSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Revokes a service account token.
     */
    public function revokeServiceAccountToken(array $params, array $body): mixed
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        $result = $this->inner->invoke(self::revokeServiceAccountTokenSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Revokes specific sessions.
     */
    public function revokeSessions(array $body): mixed
    {
        $pathParams = [];
        $result = $this->inner->invoke(self::revokeSessionsSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Revokes a user session.
     */
    public function revokeUserSession(array $params): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        if (!array_key_exists('session_id', $params)) {
            throw new InvalidPathError('session_id');
        }
        $pathParams['session_id'] = (string) $params['session_id'];
        $result = $this->inner->invoke(self::revokeUserSessionSpec(), $pathParams, null);
        return $result->body;
    }

    /**
     * Sets MFA requirement for a user.
     */
    public function setUserMfaRequirement(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::setUserMfaRequirementSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Suspends a tenant.
     */
    public function suspendTenant(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant_id', $params)) {
            throw new InvalidPathError('tenant_id');
        }
        $pathParams['tenant_id'] = (string) $params['tenant_id'];
        $result = $this->inner->invoke(self::suspendTenantSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Updates a group.
     */
    public function updateGroup(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('group_id', $params)) {
            throw new InvalidPathError('group_id');
        }
        $pathParams['group_id'] = (string) $params['group_id'];
        $result = $this->inner->invoke(self::updateGroupSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Updates an OIDC provider.
     */
    public function updateOidcProvider(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('provider_id', $params)) {
            throw new InvalidPathError('provider_id');
        }
        $pathParams['provider_id'] = (string) $params['provider_id'];
        $result = $this->inner->invoke(self::updateOidcProviderSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Updates the attributes and statements attached to a policy.
     */
    public function updatePolicy(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant', $params)) {
            throw new InvalidPathError('tenant');
        }
        $pathParams['tenant'] = (string) $params['tenant'];
        if (!array_key_exists('id', $params)) {
            throw new InvalidPathError('id');
        }
        $pathParams['id'] = (string) $params['id'];
        $result = $this->inner->invoke(self::updatePolicySpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Updates a role.
     */
    public function updateRole(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('role_id', $params)) {
            throw new InvalidPathError('role_id');
        }
        $pathParams['role_id'] = (string) $params['role_id'];
        $result = $this->inner->invoke(self::updateRoleSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Updates a service account.
     */
    public function updateServiceAccount(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('service_account_id', $params)) {
            throw new InvalidPathError('service_account_id');
        }
        $pathParams['service_account_id'] = (string) $params['service_account_id'];
        $result = $this->inner->invoke(self::updateServiceAccountSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Updates a tenant.
     */
    public function updateTenant(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('tenant_id', $params)) {
            throw new InvalidPathError('tenant_id');
        }
        $pathParams['tenant_id'] = (string) $params['tenant_id'];
        $result = $this->inner->invoke(self::updateTenantSpec(), $pathParams, $body);
        return $result->body;
    }

    /**
     * Updates a user.
     */
    public function updateUser(array $params, array $body): array
    {
        $pathParams = [];
        if (!array_key_exists('user_id', $params)) {
            throw new InvalidPathError('user_id');
        }
        $pathParams['user_id'] = (string) $params['user_id'];
        $result = $this->inner->invoke(self::updateUserSpec(), $pathParams, $body);
        return $result->body;
    }

    private static function addGroupRoleSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'AddGroupRole',
            SdkHttpMethod::POST,
            '/iam/groups/{group_id}/roles',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function addUserToGroupSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'AddUserToGroup',
            SdkHttpMethod::POST,
            '/iam/tenants/{tenant}/groups/{group_id}/users',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function assumeRoleSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'AssumeRole',
            SdkHttpMethod::POST,
            '/iam/assume-role',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function attachManagedPolicySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'AttachManagedPolicy',
            SdkHttpMethod::POST,
            '/iam/tenants/{tenant}/principals/{type}/{id}/managed-policies',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function attachPolicyToPrincipalSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'AttachPolicyToPrincipal',
            SdkHttpMethod::POST,
            '/iam/tenants/{tenant}/principals/{type}/{id}/policies',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function createOidcProviderSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateOidcProvider',
            SdkHttpMethod::POST,
            '/iam/oidc/providers',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createPolicySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreatePolicy',
            SdkHttpMethod::POST,
            '/iam/policies',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function createPrincipalSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreatePrincipal',
            SdkHttpMethod::POST,
            '/iam/principals',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function createRoleSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateRole',
            SdkHttpMethod::POST,
            '/iam/roles',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createServiceAccountSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateServiceAccount',
            SdkHttpMethod::POST,
            '/iam/service-accounts',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createServiceAccountKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateServiceAccountKey',
            SdkHttpMethod::POST,
            '/iam/service-accounts/{service_account_id}/keys',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function createSigningKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateSigningKey',
            SdkHttpMethod::POST,
            '/iam/tenants/{tenant}/signing-keys',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function createTenantGroupSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateTenantGroup',
            SdkHttpMethod::POST,
            '/iam/tenants/{tenant}/groups',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function createTenantUserSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateTenantUser',
            SdkHttpMethod::POST,
            '/iam/tenants/{tenant}/users',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function createUserKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'CreateUserKey',
            SdkHttpMethod::POST,
            '/iam/users/{user_id}/keys',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteGroupSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteGroup',
            SdkHttpMethod::DELETE,
            '/iam/groups/{group_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteOidcProviderSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteOidcProvider',
            SdkHttpMethod::DELETE,
            '/iam/oidc/providers/{provider_id}',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deletePolicySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeletePolicy',
            SdkHttpMethod::DELETE,
            '/iam/policies/{tenant}/{id}',
            204,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function deleteRoleSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteRole',
            SdkHttpMethod::DELETE,
            '/iam/roles/{role_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteServiceAccountSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteServiceAccount',
            SdkHttpMethod::DELETE,
            '/iam/service-accounts/{service_account_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteServiceAccountKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteServiceAccountKey',
            SdkHttpMethod::DELETE,
            '/iam/service-accounts/{service_account_id}/keys/{key_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteUserSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteUser',
            SdkHttpMethod::DELETE,
            '/iam/users/{user_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function deleteUserKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DeleteUserKey',
            SdkHttpMethod::DELETE,
            '/iam/users/{user_id}/keys/{key_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function detachManagedPolicySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DetachManagedPolicy',
            SdkHttpMethod::DELETE,
            '/iam/tenants/{tenant}/principals/{type}/{id}/managed-policies/{policy_id}',
            204,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function detachPolicyFromPrincipalSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DetachPolicyFromPrincipal',
            SdkHttpMethod::DELETE,
            '/iam/tenants/{tenant}/principals/{type}/{id}/policies/{policy_id}',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function disableServiceAccountKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DisableServiceAccountKey',
            SdkHttpMethod::POST,
            '/iam/service-accounts/{service_account_id}/keys/{key_id}/disable',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function disableUserSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DisableUser',
            SdkHttpMethod::POST,
            '/iam/users/{user_id}/disable',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function disableUserKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'DisableUserKey',
            SdkHttpMethod::POST,
            '/iam/users/{user_id}/keys/{key_id}/disable',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function emitTokenSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'EmitToken',
            SdkHttpMethod::POST,
            '/iam/token',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function enableServiceAccountKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'EnableServiceAccountKey',
            SdkHttpMethod::POST,
            '/iam/service-accounts/{service_account_id}/keys/{key_id}/enable',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function enableUserSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'EnableUser',
            SdkHttpMethod::POST,
            '/iam/users/{user_id}/enable',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function enableUserKeySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'EnableUserKey',
            SdkHttpMethod::POST,
            '/iam/users/{user_id}/keys/{key_id}/enable',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function exportAuditEventsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ExportAuditEvents',
            SdkHttpMethod::GET,
            '/iam/audit/exports',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getAuditEventSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetAuditEvent',
            SdkHttpMethod::GET,
            '/iam/audit/events/{event_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getGroupSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetGroup',
            SdkHttpMethod::GET,
            '/iam/groups/{group_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getManagedPolicySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetManagedPolicy',
            SdkHttpMethod::GET,
            '/iam/managed-policies/{policy_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getOidcProviderSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetOidcProvider',
            SdkHttpMethod::GET,
            '/iam/oidc/providers/{provider_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getPolicySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetPolicy',
            SdkHttpMethod::GET,
            '/iam/policies/{tenant}/{id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getPrincipalSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetPrincipal',
            SdkHttpMethod::GET,
            '/iam/principals/{tenant}/{type}/{id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getRoleSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetRole',
            SdkHttpMethod::GET,
            '/iam/roles/{role_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getServiceAccountSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetServiceAccount',
            SdkHttpMethod::GET,
            '/iam/service-accounts/{service_account_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getTenantSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetTenant',
            SdkHttpMethod::GET,
            '/iam/tenants/{tenant_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function getUserSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'GetUser',
            SdkHttpMethod::GET,
            '/iam/users/{user_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function inviteUserSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'InviteUser',
            SdkHttpMethod::POST,
            '/iam/users/invite',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listAuditEventsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListAuditEvents',
            SdkHttpMethod::GET,
            '/iam/audit/events',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listGroupMembersSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListGroupMembers',
            SdkHttpMethod::GET,
            '/iam/groups/{group_id}/members',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listGroupRolesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListGroupRoles',
            SdkHttpMethod::GET,
            '/iam/groups/{group_id}/roles',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listGroupsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListGroups',
            SdkHttpMethod::GET,
            '/iam/groups',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listManagedPoliciesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListManagedPolicies',
            SdkHttpMethod::GET,
            '/iam/managed-policies',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listOidcProvidersSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListOidcProviders',
            SdkHttpMethod::GET,
            '/iam/oidc/providers',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listPoliciesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListPolicies',
            SdkHttpMethod::GET,
            '/iam/policies',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listPolicyVersionsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListPolicyVersions',
            SdkHttpMethod::GET,
            '/iam/policies/{tenant}/{policy_id}/versions',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listPrincipalManagedPoliciesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListPrincipalManagedPolicies',
            SdkHttpMethod::GET,
            '/iam/tenants/{tenant}/principals/{type}/{id}/managed-policies',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listRolesSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListRoles',
            SdkHttpMethod::GET,
            '/iam/roles',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listServiceAccountKeysSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListServiceAccountKeys',
            SdkHttpMethod::GET,
            '/iam/service-accounts/{service_account_id}/keys',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listServiceAccountsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListServiceAccounts',
            SdkHttpMethod::GET,
            '/iam/service-accounts',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listSessionsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListSessions',
            SdkHttpMethod::GET,
            '/iam/sessions',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listTenantsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListTenants',
            SdkHttpMethod::GET,
            '/iam/tenants',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listUserKeysSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListUserKeys',
            SdkHttpMethod::GET,
            '/iam/users/{user_id}/keys',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listUserSessionsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListUserSessions',
            SdkHttpMethod::GET,
            '/iam/users/{user_id}/sessions',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function listUsersSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'ListUsers',
            SdkHttpMethod::GET,
            '/iam/users',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function publishAuditEventSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'PublishAuditEvent',
            SdkHttpMethod::POST,
            '/iam/audit/events',
            202,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function removeGroupMemberSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RemoveGroupMember',
            SdkHttpMethod::DELETE,
            '/iam/groups/{group_id}/members/{user_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function removeGroupRoleSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RemoveGroupRole',
            SdkHttpMethod::DELETE,
            '/iam/groups/{group_id}/roles/{role_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function revokeAllSessionsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RevokeAllSessions',
            SdkHttpMethod::POST,
            '/iam/sessions/revoke-all',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function revokeServiceAccountTokenSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RevokeServiceAccountToken',
            SdkHttpMethod::POST,
            '/iam/service-accounts/{service_account_id}/tokens/revoke',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function revokeSessionsSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RevokeSessions',
            SdkHttpMethod::POST,
            '/iam/sessions/revoke',
            204,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function revokeUserSessionSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'RevokeUserSession',
            SdkHttpMethod::DELETE,
            '/iam/users/{user_id}/sessions/{session_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function setUserMfaRequirementSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'SetUserMfaRequirement',
            SdkHttpMethod::PUT,
            '/iam/tenants/{tenant}/users/{user_id}/mfa',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function suspendTenantSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'SuspendTenant',
            SdkHttpMethod::POST,
            '/iam/tenants/{tenant_id}/suspend',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateGroupSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateGroup',
            SdkHttpMethod::PATCH,
            '/iam/groups/{group_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateOidcProviderSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateOidcProvider',
            SdkHttpMethod::PATCH,
            '/iam/oidc/providers/{provider_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updatePolicySpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdatePolicy',
            SdkHttpMethod::PUT,
            '/iam/policies/{tenant}/{id}',
            200,
            [],
            true,
            null,
            false
        );
        return $spec;
    }

    private static function updateRoleSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateRole',
            SdkHttpMethod::PATCH,
            '/iam/roles/{role_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateServiceAccountSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateServiceAccount',
            SdkHttpMethod::PATCH,
            '/iam/service-accounts/{service_account_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateTenantSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateTenant',
            SdkHttpMethod::PATCH,
            '/iam/tenants/{tenant_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

    private static function updateUserSpec(): OperationSpec
    {
        static $spec = null;
        if ($spec instanceof OperationSpec) {
            return $spec;
        }
        $spec = new OperationSpec(
            'UpdateUser',
            SdkHttpMethod::PATCH,
            '/iam/users/{user_id}',
            200,
            [],
            false,
            null,
            false
        );
        return $spec;
    }

}
