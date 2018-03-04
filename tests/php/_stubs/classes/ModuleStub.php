<?php
declare(strict_types=1);

namespace Unprefix\Twig\Tests\Stubs\Classes;

use Unprefix\Twig\Module\Injectable;

/**
 * Class ModuleStub
 *
 * @since
 * @package Unprefix\Twig\Tests\php\_stubs
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
class ModuleStub implements Injectable
{
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        return $twig;
    }
}
