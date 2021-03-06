<?php

/**
 * This file is part of the Superdesk Web Publisher Templates System
 *
 * Copyright 2015 Sourcefabric z.u. and contributors.
 *
 * For the full copyright and license information, please see the
 * AUTHORS and LICENSE files distributed with this source code.
 *
 * @copyright 2015 Sourcefabric z.ú.
 * @license http://www.superdesk.org/license
 */

namespace spec\SWP\TemplatesSystem\Gimme\Loader;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SWP\TemplatesSystem\Gimme\Loader\ArticleLoader;
use SWP\TemplatesSystem\Gimme\Meta\Meta;

class ChainLoaderSpec extends ObjectBehavior
{
    /**
     * @param  \SWP\TemplatesSystem\Gimme\Loader\ArticleLoader $articleLoader
     * @param  \SWP\TemplatesSystem\Gimme\Meta\Meta            $meta
     */
    function let($articleLoader, $meta)
    {
        $articleLoader->isSupported(Argument::exact('article'))->willReturn(true);
        $articleLoader->isSupported(Argument::exact('article2'))->willReturn(false);
        $articleLoader->load(Argument::exact('article'), Argument::type('array'), \SWP\TemplatesSystem\Gimme\Loader\LoaderInterface::SINGLE)->willReturn($meta);

    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SWP\TemplatesSystem\Gimme\Loader\ChainLoader');
    }

    function it_should_add_new_loader($articleLoader)
    {
        $this->addLoader($articleLoader);
    }

    function it_should_load_meta($articleLoader, $meta)
    {
        $this->addLoader($articleLoader);
        $this->load('article', array())->shouldReturn($meta);
    }

    function it_should_check_if_type_is_supported($articleLoader)
    {
        $this->addLoader($articleLoader);
        $this->isSupported('article')->shouldReturn(true);
        $this->isSupported('article2')->shouldReturn(false);
    }
}
