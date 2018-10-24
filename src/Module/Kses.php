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
final class Kses implements Injectable
{
    use Helper;

    const FILTER_KSES_LIST = 'twigwp.kses_list';

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

        /**
         * Filter Kses List to register
         *
         * @since 1.0.0
         *
         * @param array $kses The current kses list.
         * @param \Twig\Environment $twig The twig environment instance.
         */
        $kses = apply_filters(self::FILTER_KSES_LIST, $kses, $twig);

        foreach ($kses as $key => $function) {
            // Looking for options.
            list($function, $options) = $this->extractConfiguration((array)$function);

            $twig->addFunction(new \Twig\TwigFunction($key, $function, $options));
        }

        return $twig;
    }
}
