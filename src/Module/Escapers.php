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
 * Class Escapers
 */
class Escapers implements Injectable
{
    use Helper;

    const FILTER_ESCAPERS_LIST = 'twigwp.escapers_list';

    /**
     * WordPress Escapers
     *
     * @var array The escapers functions list to add to twig
     */
    private $escapers;

    /**
     * Escapers constructor
     *
     * @param array $escapers The escapers functions list to add to twig.
     */
    public function __construct(array $escapers = [])
    {
        $this->escapers = $escapers;
    }

    /**
     * @inheritdoc
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        $escapers = $this->escapers;

        if (function_exists('apply_filters')) {
            /**
             * Filter Escapers List to register
             *
             * @param array $escapers The current escapers list.
             * @param \Twig\Environment $twig The twig environment instance.
             */
            $escapers = apply_filters(self::FILTER_ESCAPERS_LIST, $escapers, $twig);
        }

        foreach ($escapers as $key => $escaper) {
            // Looking for options.
            list($escaper, $options) = $this->extractConfiguration((array)$escaper);

            $twig->addFilter(new \Twig\TwigFilter($key, $escaper, $options));
            $twig->addFunction(new \Twig\TwigFunction($key, $escaper, $options));
        }

        return $twig;
    }
}
