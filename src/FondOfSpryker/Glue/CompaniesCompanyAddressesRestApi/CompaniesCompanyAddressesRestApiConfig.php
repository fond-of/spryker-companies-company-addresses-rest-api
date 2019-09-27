<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompaniesCompanyAddressesRestApiConfig extends AbstractBundleConfig
{
    public const ACTION_COMPANIES_COMPANY_ADDRESSES_POST = 'post';
    public const ACTION_COMPANIES_COMPANY_ADDRESSES_PATCH = 'patch';

    public const RESOURCE_COMPANIES_COMPANY_ADDRESSES = 'companies-company-addresses';
    public const CONTROLLER_COMPANIES_COMPANY_ADDRESSES = 'companies-company-addresses-resource';

    public const RESPONSE_CODE_FAILED_CREATING_BUSINESS_UNIT_ADDRESS = '1000';
    public const RESPONSE_CODE_BUSINESS_UNIT_UUID_MISSING = '1100';
    public const RESPONSE_CODE_BUSINESS_UNIT_ADDRESS_NOT_FOUND = '1200';
    public const RESPONSE_CODE_FAILED_UPDATE_BUSINESS_UNIT_ADDRESS = '1300';
    public const RESPONSE_MESSAGE_FAILED_CREATING_BUSINESS_UNIT_ADDRESS = 'Business Unit Address can not be created';
    public const RESPONSE_MESSAGE_BUSINESS_UNIT_UUID_MISSING = 'Uuid value is missing.';
    public const RESPONSE_MESSAGE_FAILED_UPDATING_BUSINESS_UNIT_ADDRESS = 'Business Unit Address could not be updated.';
    public const RESPONSE_MESSAGE_BUSINESS_UNIT_ADDRESS_NOT_FOUND = 'Business Unit Address could not be found.';

}
