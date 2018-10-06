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

final class L10n implements Injectable
{
    use Helper;

    const FILTER_L10N_LIST = 'twigwp.i10n_list';

    /**
     * Kses Functions list
     *
     * @var array The list of kses functions to register in twig
     */
    private $i10n;

    /**
     * Kses constructor
     *
     * @param array $i10n The list of kses functions to register into twig
     */
    public function __construct(array $i10n = [])
    {
        $this->i10n = $i10n;
    }

    /**
     * @inheritdoc
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        $i10n = $this->i10n;

        if (function_exists('apply_filters')) {
            /**
             * Filter i10n List to register
             *
             * @param array             $i10n The current kses list.
             * @param \Twig\Environment $twig The twig environment instance.
             */
            $i10n = apply_filters(self::FILTER_L10N_LIST, $i10n, $twig);
        }

        foreach ($i10n as $key => $k) {
            // Looking for options.
            list($k, $options) = $this->extractConfiguration((array)$k);

            $twig->addFunction(new \Twig\TwigFunction($key, $k, $options));
        }

        return $twig;
    }
}
