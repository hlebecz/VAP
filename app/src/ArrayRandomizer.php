<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

/**
 * Class ArrayRandomizer
 *
 * Provides functionality to get random elements from arrays
 */
class ArrayRandomizer
{
    /**
     * Returns an array of N random elements from the source array
     *
     * @param array $sourceArray The source array to pick elements from
     * @param int $count Number of random elements to return
     * @return array Array containing N random elements
     * @throws InvalidArgumentException When count is negative or exceeds array size
     */

    public function getRandomElements(array $sourceArray, int $count): array
    {
        $keys = $this->getRandomKeys($sourceArray, $count);
        $result = [];
        foreach ($keys as $key) {
            $result[] = $sourceArray[$key];
        }

        return $result;
    }

    /**
     * Returns random elements preserving original keys
     *
     * @param array $sourceArray The source array
     * @param int $count Number of elements
     * @return array Array with original keys preserved
     * @throws InvalidArgumentException When count is invalid
     */
    public function getRandomElementsWithKeys(array $sourceArray, int $count): array
    {
        $keys = $this->getRandomKeys($sourceArray, $count);

        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $sourceArray[$key];
        }

        return $result;
    }

    /**
     * Returns random keys of original array
     *
     * @param array $sourceArray The source array
     * @param int $count Number of elements
     * @return array Array of random keys
     * @throws InvalidArgumentException When count is invalid
     */
    private function getRandomKeys (array $sourceArray, int $count): array {
        if ($count < 0) {
            throw new InvalidArgumentException('Count cannot be negative');
        }

        if ($count > count($sourceArray)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Count (%d) cannot exceed array size (%d)',
                    $count,
                    count($sourceArray)
                )
            );
        }

        if ($count === 0 || empty($sourceArray)) {
            return [];
        }

        $keys = array_rand($sourceArray, $count);

        if (!is_array($keys)) {
            $keys = [$keys];
        }
        return $keys;
    }
}