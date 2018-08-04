<?php
/**
 * This file is part of the Twig WordPress package.
 *
 * (c) Guido Scialfa <dev@guidoscialfa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TwigWp\Module;

/**
 * Trait ModuleTrait
 */
trait Helper
{
    /**
     * Extract Options
     *
     * Extract the options from a configuration element.
     *
     * @param array $thing The configuration element.
     *
     * @return array The configuration element split in name and options
     */
    private function extractConfiguration(array $thing): array
    {
        return [
            $thing[0],
            $thing[1] ?? [],
        ];
    }
}
