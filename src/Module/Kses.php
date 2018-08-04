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
 * Class Kses
 */
class Kses implements Injectable
{
    use Helper;

    /**
     * Kses Functions list
     *
     * @var array The list of kses functions to register in twig
     */
    private $kses;

    /**
     * Kses constructor
     *
     * @param array $kses The list of kses functions to register into twig
     */
    public function __construct(array $kses = [])
    {
        $this->kses = $kses;
    }

    /**
     * @inheritdoc
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        $kses = $this->kses;

        if (function_exists('apply_filters')) {
            /**
             * Filter Kses List to register
             *
             * @since 1.0.0
             *
             * @param array             $kses The current kses list.
             * @param \Twig\Environment $twig The twig environment instance.
             */
            $kses = apply_filters('twigwp.kses_list', $kses, $twig);
        }

        foreach ($kses as $key => $k) {
            // Looking for options.
            list($k, $options) = $this->extractConfiguration((array)$k);

            $twig->addFunction(new \Twig\TwigFunction($key, $k, $options));
        }

        return $twig;
    }
}
