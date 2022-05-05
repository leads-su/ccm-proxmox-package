<?php

namespace ConsulConfigManager\Proxmox\Helpers;

use Illuminate\Support\Arr;

/**
 * Class TokenBuilderHelper
 * @package ConsulConfigManager\Proxmox\Helpers
 */
class TokenBuilderHelper
{
    /**
     * Build access token string
     * @return string
     */
    public static function build(): string
    {
        return sprintf(
            '%s@%s!%s=%s',
            TokenBuilderHelper::retrieveUsername(),
            TokenBuilderHelper::retrieveAuthorizationMethod(),
            TokenBuilderHelper::retrieveTokenName(),
            TokenBuilderHelper::retrieveTokenValue(),
        );
    }

    /**
     * Retrieve username
     * @return string
     */
    private static function retrieveUsername(): string
    {
        return TokenBuilderHelper::retrieveConfigurationValue('username');
    }

    /**
     * Retrieve user authorization method
     * @return string
     */
    private static function retrieveAuthorizationMethod(): string
    {
        return TokenBuilderHelper::retrieveConfigurationValue('authorization_method');
    }

    /**
     * Retrieve access token name
     * @return string
     */
    private static function retrieveTokenName(): string
    {
        return TokenBuilderHelper::retrieveConfigurationValue('token_name');
    }

    /**
     * Retrieve access token value
     * @return string
     */
    private static function retrieveTokenValue(): string
    {
        return TokenBuilderHelper::retrieveConfigurationValue('token_value');
    }

    /**
     * Retrieve value from configuration
     * @param string $key
     * @param string $default
     * @return string
     */
    private static function retrieveConfigurationValue(string $key, string $default = ''): string
    {
        return Arr::get(
            config('domain.proxmox.access_token.configuration', []),
            $key,
            $default,
        );
    }
}
