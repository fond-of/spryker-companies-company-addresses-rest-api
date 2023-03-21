<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUuidFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilter
     */
    protected $companyUuidFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUuidFilter = new CompanyUuidFilter();
    }

    /**
     * @return void
     */
    public function testFilterFromRestRequest(): void
    {
        $id = 'c1775b88-ea81-4fa2-909d-8855075892b9';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('findParentResourceByType')
            ->with(CompaniesRestApiConfig::RESOURCE_COMPANIES_REST_API)
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($id);

        static::assertEquals(
            $id,
            $this->companyUuidFilter->filterFromRestRequest($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testFilterFromRestRequestWithoutParentResource(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('findParentResourceByType')
            ->with(CompaniesRestApiConfig::RESOURCE_COMPANIES_REST_API)
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->companyUuidFilter->filterFromRestRequest($this->restRequestMock),
        );
    }
}
