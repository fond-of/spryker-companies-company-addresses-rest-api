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

    /**
     * @var string
     */
    public const RESPONSE_CODE_COULD_NOT_CREATED = '1003';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_COULD_NOT_CREATED = 'Company business unit address could not be created.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_COULD_NOT_UPDATED = '1004';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_COULD_NOT_UPDATED = 'Company business unit address could not be updated.';
}
