<?php

declare(strict_types=1);

namespace app\test;

use App\ArrayRandomizer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrayRandomizerTest
 *
 * Unit tests for ArrayRandomizer class
 */
class ArrayRandomizerTest extends TestCase
{
    private ArrayRandomizer $randomizer;

    /**
     * Set up test environment
     */
    protected function setUp(): void
    {
        $this->randomizer = new ArrayRandomizer();
    }

    /**
     * Test getting random elements with valid input
     */
    public function testGetRandomElementsWithValidInput(): void
    {
        $source = ['a', 'b', 'c', 'd', 'e'];
        $count = 2;

        $result = $this->randomizer->getRandomElements($source, $count);

        $this->assertCount($count, $result);
        foreach ($result as $element) {
            $this->assertContains($element, $source);
        }
    }

    /**
     * Test getting random elements with count = 1
     */
    public function testGetRandomElementsWithSingleElement(): void
    {
        $source = ['a', 'b', 'c'];
        $result = $this->randomizer->getRandomElements($source, 1);

        $this->assertCount(1, $result);
        $this->assertContains($result[0], $source);
    }

    /**
     * Test getting random elements with count = 0
     */
    public function testGetRandomElementsWithCountZero(): void
    {
        $source = ['a', 'b', 'c'];
        $result = $this->randomizer->getRandomElements($source, 0);

        $this->assertEmpty($result);
    }

    /**
     * Test getting random elements from empty array
     */
    public function testGetRandomElementsWithEmptyArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $source = [];
        $result = $this->randomizer->getRandomElements($source, 1);
    }

    /**
     * Test getting all elements when count equals array size
     */
    public function testGetRandomElementsWithAllElements(): void
    {
        $source = ['a', 'b', 'c'];
        $result = $this->randomizer->getRandomElements($source, 3);

        $this->assertCount(3, $result);
        sort($result);
        $this->assertEquals(['a', 'b', 'c'], $result);
    }

    /**
     * Test exception when count is negative
     */
    public function testGetRandomElementsThrowsOnNegativeCount(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $source = ['a', 'b', 'c'];
        $this->randomizer->getRandomElements($source, -1);
    }

    /**
     * Test exception when count exceeds array size
     */
    public function testGetRandomElementsThrowsOnTooLargeCount(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Count (5) cannot exceed array size (3)');

        $source = ['a', 'b', 'c'];
        $this->randomizer->getRandomElements($source, 5);
    }

    /**
     * Test getting random elements with keys preserved
     */
    public function testGetRandomElementsWithKeys(): void
    {
        $source = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4];
        $count = 2;

        $result = $this->randomizer->getRandomElementsWithKeys($source, $count);

        $this->assertCount($count, $result);

        // Check that keys are preserved from original array
        foreach ($result as $key => $value) {
            $this->assertArrayHasKey($key, $source);
            $this->assertEquals($source[$key], $value);
        }
    }

    /**
     * Test getting random elements with keys when count = 0
     */
    public function testGetRandomElementsWithKeysCountZero(): void
    {
        $source = ['one' => 1, 'two' => 2, 'three' => 3];
        $result = $this->randomizer->getRandomElementsWithKeys($source, 0);

        $this->assertEmpty($result);
    }

    /**
     * Test exception for keys method when count exceeds array size
     */
    public function testGetRandomElementsWithKeysThrowsOnTooLargeCount(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $source = ['one' => 1, 'two' => 2];
        $this->randomizer->getRandomElementsWithKeys($source, 3);
    }

    /**
     * Test with associative array
     */
    public function testGetRandomElementsWithAssociativeArray(): void
    {
        $source = [
            'name' => 'John',
            'age' => 30,
            'city' => 'New York',
            'country' => 'USA'
        ];
        $count = 2;

        $result = $this->randomizer->getRandomElements($source, $count);

        $this->assertCount($count, $result);
        foreach ($result as $value) {
            $this->assertContains($value, $source);
        }
    }

    /**
     * Test with numeric values
     */
    public function testGetRandomElementsWithNumericValues(): void
    {
        $source = [10, 20, 30, 40, 50];
        $count = 3;

        $result = $this->randomizer->getRandomElements($source, $count);

        $this->assertCount($count, $result);
        foreach ($result as $value) {
            $this->assertIsInt($value);
            $this->assertContains($value, $source);
        }
    }

    /**
     * Test that multiple calls return different results (probabilistic)
     */
    public function testGetRandomElementsReturnsDifferentResults(): void
    {
        $source = range(1, 100);
        $count = 10;

        $results = [];
        for ($i = 0; $i < 10; $i++) {
            $results[] = $this->randomizer->getRandomElements($source, $count);
        }

        // Check that at least one result is different (very high probability)
        $uniqueResults = array_unique(array_map('serialize', $results));
        $this->assertGreaterThan(1, count($uniqueResults), 'Should get different random results');
    }
}