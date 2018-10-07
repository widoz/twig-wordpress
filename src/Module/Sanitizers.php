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
 * Class Sanitizers
 */
class Sanitizers implements Injectable
{
    use Helper;

    const FILTER_SANITIZERS_LIST = 'twigwp.sanitizers_list';

    /**
     * @var array
     */
    private $sanitizers;

    /**
     * Sanitizers constructor.
     * @param array $sanitizers
     */
    public function __construct(array $sanitizers = [])
    {
        $this->sanitizers = $sanitizers;
    }

    /**
     * @inheritdoc
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        $sanitizers = $this->sanitizers;

        if (function_exists('apply_filters')) {
            /**
             * Filter Escapers List to register
             *
             * @param array $sanitizers The current sanitizers list.
             * @param \Twig\Environment $twig The twig environment instance.
             */
            $sanitizers = apply_filters(self::FILTER_SANITIZERS_LIST, $sanitizers, $twig);
        }

        foreach ($sanitizers as $key => $sanitizer) {
            // Looking for options.
            list($sanitizer, $options) = $this->extractConfiguration((array)$sanitizer);

            $twig->addFunction(new \Twig\TwigFunction($key, $sanitizer, $options));
        }

        return $twig;
    }
}
