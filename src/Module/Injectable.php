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
 * Interface Module
 */
interface Injectable
{
    /**
     * Inject Module into Twig
     *
     * @param \Twig\Environment $twig The Twig instance.
     *
     * @return \Twig\Environment The instance of twig environment class
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment;
}
