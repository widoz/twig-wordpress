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

class TemplateFunctions implements Injectable
{
    use Helper;

    const FILTER_FUNCTIONS_LIST = 'twigwp.template_functions_list';

    /**
     * Kses Functions list
     *
     * @var array The list of kses functions to register in twig
     */
    private $functions;

    /**
     * Kses constructor
     *
     * @param array $functions The list of kses functions to register into twig
     */
    public function __construct(array $functions = [])
    {
        $this->functions = $functions;
    }

    /**
     * @inheritdoc
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        $functions = $this->functions;

        if (function_exists('apply_filters')) {
            /**
             * Filter Kses List to register
             *
             * @since 1.0.0
             *
             * @param array $functions The current kses list.
             * @param \Twig\Environment $twig The twig environment instance.
             */
            $functions = apply_filters(self::FILTER_FUNCTIONS_LIST, $functions, $twig);
        }

        foreach ($functions as $key => $k) {
            // Looking for options.
            list($k, $options) = $this->extractConfiguration((array)$k);

            $twig->addFunction(new \Twig\TwigFunction($key, $k, $options));
        }

        return $twig;
    }
}
