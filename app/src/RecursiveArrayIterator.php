<?php

declare(strict_types=1);

namespace App;

use RecursiveArrayIterator as BaseRecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * Class RecursiveArrayIterator
 *
 * Provides recursive iteration over nested arrays
 */
class RecursiveArrayIterator
{
    /**
     * Get flattened array with depth information
     *
     * @param array $array The nested array to iterate
     * @return array Array of elements with their paths and depths
     */
    public function flatten(array $array): array
    {
        $result = [];
        $iterator = new RecursiveIteratorIterator(
            new BaseRecursiveArrayIterator($array),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $key => $value) {
            $depth = $iterator->getDepth();
            $path = $this->getPath($iterator);

            $result[] = [
                'key' => $key,
                'value' => $value,
                'depth' => $depth,
                'path' => $path,
                'has_children' => $iterator->callHasChildren(),
            ];
        }

        return $result;
    }

    /**
     * Build path string for current iterator position
     *
     * @param RecursiveIteratorIterator $iterator The iterator
     * @return string Path string like "root > child > leaf"
     */
    private function getPath(RecursiveIteratorIterator $iterator): string
    {
        $path = [];
        for ($i = 0; $i <= $iterator->getDepth(); $i++) {
            $path[] = $iterator->getSubIterator($i)->key();
        }

        return implode(' > ', $path);
    }

    /**
     * Convert nested array to HTML tree structure
     *
     * @param array $array The nested array
     * @return string HTML string with nested <ul> elements
     */
    public function toHtmlTree(array $array): string
    {
        $html = '<ul class="tree">';

        foreach ($array as $key => $value) {
            $html .= '<li>';

            if (is_array($value)) {
                $html .= '<span class="tree-toggle">▼</span>';
                $html .= '<span class="tree-key">' . htmlspecialchars((string)$key, ENT_QUOTES, 'UTF-8') . '</span>';
                $html .= $this->toHtmlTree($value);
            } else {
                $html .= '<span class="tree-leaf">•</span>';
                $html .= '<span class="tree-key">' . htmlspecialchars((string)$key, ENT_QUOTES, 'UTF-8') . '</span>';
                $html .= ': <span class="tree-value">' . htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8') . '</span>';
            }

            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}