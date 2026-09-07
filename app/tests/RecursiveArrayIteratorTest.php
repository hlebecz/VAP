<?php

declare(strict_types=1);

namespace app\test;

use App\RecursiveArrayIterator;
use PHPUnit\Framework\TestCase;

/**
 * Class RecursiveArrayIteratorTest
 *
 * Unit tests for RecursiveArrayIterator class
 */
class RecursiveArrayIteratorTest extends TestCase
{
    private RecursiveArrayIterator $iterator;

    /**
     * Set up test environment
     */
    protected function setUp(): void
    {
        $this->iterator = new RecursiveArrayIterator();
    }

    /**
     * Test flatten with simple nested array
     */
    public function testFlattenWithNestedArray(): void
    {
        $nestedArray = [
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => 3,
            ],
        ];

        $result = $this->iterator->flatten($nestedArray);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

        // Check structure of each item
        foreach ($result as $item) {
            $this->assertArrayHasKey('key', $item);
            $this->assertArrayHasKey('value', $item);
            $this->assertArrayHasKey('depth', $item);
            $this->assertArrayHasKey('path', $item);
            $this->assertArrayHasKey('has_children', $item);
        }
    }

    /**
     * Test flatten with empty array
     */
    public function testFlattenWithEmptyArray(): void
    {
        $result = $this->iterator->flatten([]);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    /**
     * Test flatten with deeply nested array
     */
    public function testFlattenWithDeepNesting(): void
    {
        $nestedArray = [
            'level1' => [
                'level2' => [
                    'level3' => [
                        'level4' => 'value',
                    ],
                ],
            ],
        ];

        $result = $this->iterator->flatten($nestedArray);

        $maxDepth = 0;
        foreach ($result as $item) {
            $maxDepth = max($maxDepth, $item['depth']);
        }

        $this->assertEquals(3, $maxDepth, 'Should have 4 levels of nesting');
    }

    /**
     * Test flatten path building
     */
    public function testFlattenPathBuilding(): void
    {
        $nestedArray = [
            'root' => [
                'child' => 'value',
            ],
        ];

        $result = $this->iterator->flatten($nestedArray);

        // Find child element
        $childFound = false;
        foreach ($result as $item) {
            if ($item['key'] === 'child') {
                $childFound = true;
                $this->assertEquals('root > child', $item['path']);
                $this->assertEquals(1, $item['depth']);
            }
        }

        $this->assertTrue($childFound, 'Child element should be found');
    }

    /**
     * Test has_children flag
     */
    public function testFlattenHasChildrenFlag(): void
    {
        $nestedArray = [
            'parent' => [
                'child' => 'value',
            ],
            'leaf' => 'simple value',
        ];

        $result = $this->iterator->flatten($nestedArray);

        foreach ($result as $item) {
            if ($item['key'] === 'parent') {
                $this->assertTrue($item['has_children']);
            }
            if ($item['key'] === 'leaf') {
                $this->assertFalse($item['has_children']);
            }
        }
    }

    /**
     * Test toHtmlTree with simple array
     */
    public function testToHtmlTreeWithSimpleArray(): void
    {
        $array = ['a' => 1, 'b' => 2];

        $html = $this->iterator->toHtmlTree($array);

        $this->assertIsString($html);
        $this->assertStringContainsString('<ul class="tree">', $html);
        $this->assertStringContainsString('<li>', $html);
        $this->assertStringContainsString('a', $html);
        $this->assertStringContainsString('b', $html);
    }

    /**
     * Test toHtmlTree with nested array
     */
    public function testToHtmlTreeWithNestedArray(): void
    {
        $array = [
            'parent' => [
                'child' => 'value',
            ],
        ];

        $html = $this->iterator->toHtmlTree($array);

        $this->assertStringContainsString('tree-toggle', $html, 'Should have toggle for nested elements');
        $this->assertStringContainsString('parent', $html);
        $this->assertStringContainsString('child', $html);
        $this->assertStringContainsString('value', $html);
    }

    /**
     * Test toHtmlTree with empty array
     */
    public function testToHtmlTreeWithEmptyArray(): void
    {
        $html = $this->iterator->toHtmlTree([]);

        $this->assertIsString($html);
        $this->assertStringContainsString('<ul class="tree">', $html);
        $this->assertStringContainsString('</ul>', $html);
    }

    /**
     * Test toHtmlTree escapes special characters
     */
    public function testToHtmlTreeEscapesHtml(): void
    {
        $array = ['key' => '<script>alert("XSS")</script>'];

        $html = $this->iterator->toHtmlTree($array);

        $this->assertStringNotContainsString('<script>', $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
    }

    /**
     * Test with mixed value types
     */
    public function testFlattenWithMixedTypes(): void
    {
        $nestedArray = [
            'string' => 'text',
            'integer' => 42,
            'float' => 3.14,
            'boolean' => true,
            'null' => null,
            'array' => [1, 2, 3],
        ];

        $result = $this->iterator->flatten($nestedArray);

        $this->assertIsArray($result);

        // All keys should be present
        $keys = array_column($result, 'key');
        $this->assertContains('string', $keys);
        $this->assertContains('integer', $keys);
        $this->assertContains('float', $keys);
        $this->assertContains('boolean', $keys);
        $this->assertContains('null', $keys);
        $this->assertContains('array', $keys);
    }
}
