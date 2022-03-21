<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompaniesCompanyAddressesRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const ACTION_COMPANIES_COMPANY_ADDRESSES_POST = 'post';

    /**
     * @var string
     */
    public const ACTION_COMPANIES_COMPANY_ADDRESSES_PATCH = 'patch';

    /**
     * @var string
     */
    public const ACTION_COMPANIES_COMPANY_ADDRESSES_DELETE = 'delete';

    /**
     * @var string
     */
    public const RESOURCE_COMPANIES_COMPANY_ADDRESSES = 'companies-company-addresses';

    /**
     * @var string
     */
    public const CONTROLLER_COMPANIES_COMPANY_ADDRESSES = 'companies-company-addresses-resource';

    /**
     * @var string
     */
    public const RESPONSE_CODE_FAILED_CREATING_BUSINESS_UNIT_ADDRESS = '1000';

    /**
     * @var string
     */
    public const RESPONSE_CODE_BUSINESS_UNIT_UUID_MISSING = '1100';

    /**
     * @var string
     */
    public const RESPONSE_CODE_BUSINESS_UNIT_ADDRESS_NOT_FOUND = '1200';

    /**
     * @var string
     */
    public const RESPONSE_CODE_FAILED_UPDATE_BUSINESS_UNIT_ADDRESS = '1300';

    /**
     * @var string
     */
    public const RESPONSE_CODE_BUSINESS_UNIT_ADDRESS_FOR_COMPANY_NOT_FOUND = '1400';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_FAILED_CREATING_BUSINESS_UNIT_ADDRESS = 'Business Unit Address can not be created';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_BUSINESS_UNIT_UUID_MISSING = 'Uuid value is missing.';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_FAILED_UPDATING_BUSINESS_UNIT_ADDRESS = 'Business Unit Address could not be updated.';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_BUSINESS_UNIT_ADDRESS_NOT_FOUND = 'Business Unit Address could not be found.';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_BUSINESS_UNIT_ADDRESS_FOR_COMPANY_NOT_FOUND = 'Business Unit Address for the Company not found';

    /**
     * @var string
     */
    public const RESPONSE_CODE_USER_IS_NOT_SPECIFIED = '1001';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_SPECIFIED = 'Authorization header is required';

    /**
     * @var string
     */
    public const RESPONSE_CODE_COULD_NOT_DELETED = '1002';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_COULD_NOT_DELETED = 'Company business unit address could not be deleted.';
}
