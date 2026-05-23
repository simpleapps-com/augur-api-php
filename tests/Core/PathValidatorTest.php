<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\Core\Exceptions\InvalidArgumentException;
use AugurApi\Core\PathValidator;
use PHPUnit\Framework\TestCase;

final class PathValidatorTest extends TestCase
{
    // ----- isNumericPlaceholder: numeric suffixes -----

    public function testIsNumericPlaceholderRecognisesIdSuffix(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('invMastUid'));
        $this->assertTrue(PathValidator::isNumericPlaceholder('customerId'));
        $this->assertTrue(PathValidator::isNumericPlaceholder('orderId'));
    }

    public function testIsNumericPlaceholderRecognisesUidSuffix(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('invMastUid'));
        $this->assertTrue(PathValidator::isNumericPlaceholder('stateUid'));
    }

    public function testIsNumericPlaceholderRecognisesNoSuffix(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('orderNo'));
    }

    public function testIsNumericPlaceholderRecognisesNumSuffix(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('itemNum'));
    }

    public function testIsNumericPlaceholderRecognisesNumberSuffix(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('phoneNumber'));
    }

    public function testIsNumericPlaceholderRecognisesExactId(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('id'));
    }

    public function testIsNumericPlaceholderRecognisesExactLineNumber(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('lineNumber'));
    }

    public function testIsNumericPlaceholderCaseInsensitive(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('CustomerID'));
        $this->assertTrue(PathValidator::isNumericPlaceholder('INVMASTUID'));
    }

    public function testIsNumericPlaceholderHandlesKebabAndSnakeCase(): void
    {
        $this->assertTrue(PathValidator::isNumericPlaceholder('inv-mast-uid'));
        $this->assertTrue(PathValidator::isNumericPlaceholder('inv_mast_uid'));
    }

    // ----- isNumericPlaceholder: string placeholders -----

    public function testIsNumericPlaceholderReturnsFalseForStringNames(): void
    {
        $this->assertFalse(PathValidator::isNumericPlaceholder('bin'));
        $this->assertFalse(PathValidator::isNumericPlaceholder('username'));
        $this->assertFalse(PathValidator::isNumericPlaceholder('slug'));
        $this->assertFalse(PathValidator::isNumericPlaceholder('locationName'));
    }

    // ----- isNumericPlaceholder: STRING_OVERRIDES -----

    public function testIsNumericPlaceholderRespectsSiteIdOverride(): void
    {
        $this->assertFalse(PathValidator::isNumericPlaceholder('siteId'));
    }

    public function testIsNumericPlaceholderRespectsPoNoOverride(): void
    {
        $this->assertFalse(PathValidator::isNumericPlaceholder('poNo'));
    }

    public function testIsNumericPlaceholderRespectsImportUidOverride(): void
    {
        $this->assertFalse(PathValidator::isNumericPlaceholder('importUid'));
    }

    public function testIsNumericPlaceholderRespectsScheduledImportMasterUidOverride(): void
    {
        $this->assertFalse(PathValidator::isNumericPlaceholder('scheduledImportMasterUid'));
    }

    // ----- validate: numeric placeholders accept integers -----

    public function testValidateAcceptsPositiveInteger(): void
    {
        $this->expectNotToPerformAssertions();
        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', '42');
    }

    public function testValidateAcceptsNegativeInteger(): void
    {
        $this->expectNotToPerformAssertions();
        PathValidator::validate('/test/{id}', 'id', '-1');
    }

    public function testValidateAcceptsZero(): void
    {
        $this->expectNotToPerformAssertions();
        PathValidator::validate('/test/{id}', 'id', '0');
    }

    // ----- validate: numeric placeholders reject toxic primitives -----

    public function testValidateRejectsNaN(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid path parameter 'invMastUid'");

        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', 'NaN');
    }

    public function testValidateRejectsNullString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('expected an integer');

        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', 'null');
    }

    public function testValidateRejectsUndefinedString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('expected an integer');

        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', 'undefined');
    }

    public function testValidateRejectsEmptyStringForNumeric(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('expected an integer');

        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', '');
    }

    public function testValidateRejectsDecimalForNumeric(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('expected an integer');

        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', '1.5');
    }

    public function testValidateRejectsInfinityForNumeric(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('expected an integer');

        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', 'Infinity');
    }

    public function testValidateRejectsAlphabeticForNumeric(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('expected an integer');

        PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', 'abc');
    }

    // ----- validate: string placeholders -----

    public function testValidateAcceptsArbitraryStringForStringPlaceholder(): void
    {
        $this->expectNotToPerformAssertions();
        PathValidator::validate('/test/{bin}', 'bin', 'A1B2');
    }

    public function testValidateAcceptsToxicLookingStringForStringPlaceholder(): void
    {
        // "NaN" is a valid string for a string-typed placeholder
        $this->expectNotToPerformAssertions();
        PathValidator::validate('/test/{username}', 'username', 'NaN');
    }

    public function testValidateAcceptsNumericStringForSiteId(): void
    {
        // siteId is in STRING_OVERRIDES, so it's a string placeholder
        $this->expectNotToPerformAssertions();
        PathValidator::validate('/site/{siteId}', 'siteId', '123');
    }

    public function testValidateRejectsEmptyStringForStringPlaceholder(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid path parameter 'bin'");
        $this->expectExceptionMessage('expected a non-empty string');

        PathValidator::validate('/test/{bin}', 'bin', '');
    }

    // ----- error message format -----

    public function testNumericErrorMessageContainsPathTemplate(): void
    {
        try {
            PathValidator::validate('/inv-mast/{invMastUid}/doc', 'invMastUid', 'NaN');
            $this->fail('Expected InvalidArgumentException');
        } catch (InvalidArgumentException $e) {
            $this->assertStringContainsString('/inv-mast/{invMastUid}/doc', $e->getMessage());
        }
    }

    public function testNumericErrorMessageContainsValue(): void
    {
        try {
            PathValidator::validate('/inv-mast/{invMastUid}', 'invMastUid', 'NaN');
            $this->fail('Expected InvalidArgumentException');
        } catch (InvalidArgumentException $e) {
            $this->assertStringContainsString('"NaN"', $e->getMessage());
        }
    }

    public function testStringErrorMessageContainsValue(): void
    {
        try {
            PathValidator::validate('/test/{bin}', 'bin', '');
            $this->fail('Expected InvalidArgumentException');
        } catch (InvalidArgumentException $e) {
            $this->assertStringContainsString('""', $e->getMessage());
        }
    }

    public function testValidationExceptionHasStatusCode400(): void
    {
        try {
            PathValidator::validate('/test/{id}', 'id', 'NaN');
            $this->fail('Expected InvalidArgumentException');
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(400, $e->getCode());
        }
    }

    public function testPathValidatorIsFinal(): void
    {
        $reflection = new \ReflectionClass(PathValidator::class);

        $this->assertTrue($reflection->isFinal());
    }
}
