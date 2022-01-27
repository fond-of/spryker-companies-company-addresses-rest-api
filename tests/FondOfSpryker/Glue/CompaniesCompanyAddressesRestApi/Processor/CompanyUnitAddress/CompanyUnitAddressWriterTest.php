<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use FondOfSpryker\Client\Country\CountryClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidatorInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface;
use Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressWriterTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress\CompanyUnitAddressWriter
     */
    protected $companyUnitAddressWriter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface
     */
    protected $companyUnitAddressClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface
     */
    protected $companyBusinessUnitClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Country\CountryClientInterface
     */
    protected $countryClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface
     */
    protected $companiesCompanyAddressesRestApiClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface
     */
    protected $companyUnitAddressResourceMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiErrorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer
     */
    protected $restCompanyUnitAddressAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyResponseTransfer
     */
    protected $companyResponseTransferMock;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CountryTransfer
     */
    protected $countryTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var int
     */
    protected $idCountry;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyUser\CompanyUserClientInterface
     */
    protected $companyUserClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidatorInterfaceMock;

    /**
     * @var int
     */
    protected $idCompany;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected $restUserTransferMock;

    /**
     * @var string
     */
    protected $naturalIdentifier;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\CompanyUserTransfer[]
     */
    protected $companyUserTransferMocks;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressClientInterfaceMock = $this->getMockBuilder(CompanyUnitAddressClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitClientInterfaceMock = $this->getMockBuilder(CompanyBusinessUnitClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyClientInterfaceMock = $this->getMockBuilder(CompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryClientInterfaceMock = $this->getMockBuilder(CountryClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiClientInterfaceMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResourceMapperInterfaceMock = $this->getMockBuilder(CompanyUnitAddressResourceMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorInterfaceMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUnitAddressAttributesTransferMock = $this->getMockBuilder(RestCompanyUnitAddressAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 'e3d274b4-8ee1-11ea-bc55-0242ac130003';

        $this->country = 'country';

        $this->companyResponseTransferMock = $this->getMockBuilder(CompanyResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMock = $this->getMockBuilder(CountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCountry = 2;

        $this->companyUserClientInterfaceMock = $this->getMockBuilder(CompanyUserClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiValidatorInterfaceMock = $this->getMockBuilder(RestApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompany = 3;

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->naturalIdentifier = 'natural-identifier';

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMocks = new ArrayObject([
            $this->companyUserTransferMock,
        ]);

        $this->companyUnitAddressWriter = new CompanyUnitAddressWriter(
            $this->restResourceBuilderInterfaceMock,
            $this->companyUnitAddressClientInterfaceMock,
            $this->companyBusinessUnitClientInterfaceMock,
            $this->companyClientInterfaceMock,
            $this->companyUserClientInterfaceMock,
            $this->countryClientInterfaceMock,
            $this->companiesCompanyAddressesRestApiClientInterfaceMock,
            $this->companyUnitAddressResourceMapperInterfaceMock,
            $this->restApiErrorInterfaceMock,
            $this->restApiValidatorInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddress(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->willReturn($this->companyResponseTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->country);

        $this->countryClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCountryByIso2Code')
            ->willReturn($this->countryTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($this->id);

        $this->countryTransferMock->expects($this->atLeastOnce())
            ->method('getIdCountry')
            ->willReturn($this->id);

        $this->companiesCompanyAddressesRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findDefaultCompanyBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($this->id);

        $this->companyUnitAddressClientInterfaceMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddress')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUnitAddressWriter->createCompanyUnitAddress(
                $this->restRequestInterfaceMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressIsNotSuccessful(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->willReturn($this->companyResponseTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->country);

        $this->countryClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCountryByIso2Code')
            ->willReturn($this->countryTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($this->id);

        $this->countryTransferMock->expects($this->atLeastOnce())
            ->method('getIdCountry')
            ->willReturn($this->id);

        $this->companiesCompanyAddressesRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findDefaultCompanyBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($this->id);

        $this->companyUnitAddressClientInterfaceMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddress')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('processCompanyUnitAddressErrorOnCreate')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUnitAddressWriter->createCompanyUnitAddress(
                $this->restRequestInterfaceMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddress(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyUnitAddressClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyBusinessUnitAddressByUuid')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('modifiedToArray')
            ->willReturn([]);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->country);

        $this->countryClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCountryByIso2Code')
            ->willReturn($this->countryTransferMock);

        $this->countryTransferMock->expects($this->atLeastOnce())
            ->method('getIdCountry')
            ->willReturn($this->idCountry);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($this->id);

        $this->companiesCompanyAddressesRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findDefaultCompanyBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($this->id);

        $this->companyUnitAddressClientInterfaceMock->expects($this->atLeastOnce())
            ->method('updateCompanyUnitAddress')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUnitAddressWriter->updateCompanyUnitAddress(
                $this->restRequestInterfaceMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddressResourceIdNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addCompanyUnitAddressUuidMissingError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUnitAddressWriter->updateCompanyUnitAddress(
                $this->restRequestInterfaceMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddressCompanyUnitAddressTransferNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyUnitAddressClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyBusinessUnitAddressByUuid')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn(null);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addCompanyUnitAddressNotFoundError')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUnitAddressWriter->updateCompanyUnitAddress(
                $this->restRequestInterfaceMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddressCompanyUnitAddressResponseIsNotSuccessful(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyUnitAddressClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyBusinessUnitAddressByUuid')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('modifiedToArray')
            ->willReturn([]);

        $this->restCompanyUnitAddressAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->country);

        $this->countryClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCountryByIso2Code')
            ->willReturn($this->countryTransferMock);

        $this->countryTransferMock->expects($this->atLeastOnce())
            ->method('getIdCountry')
            ->willReturn($this->idCountry);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn(null);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($this->id);

        $this->companiesCompanyAddressesRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findDefaultCompanyBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($this->id);

        $this->companyUnitAddressClientInterfaceMock->expects($this->atLeastOnce())
            ->method('updateCompanyUnitAddress')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('processCompanyUnitAddressErrorOnUpdate')
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUnitAddressWriter->updateCompanyUnitAddress(
                $this->restRequestInterfaceMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            )
        );
    }
}
