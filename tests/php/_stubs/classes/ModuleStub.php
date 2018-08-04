<?php
declare(strict_types=1);

namespace TwigWp\Tests\Stubs\Classes;

use TwigWp\Module\Injectable;

/**
 * Class ModuleStub
 *
 * @since
 * @package TwigWp\Tests\php\_stubs
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
class ModuleStub implements Injectable
{
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        return $twig;
    }
}
