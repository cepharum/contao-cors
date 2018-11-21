<?php

/*

MIT License

Copyright (c) 2018 cepharum GmbH, Berlin

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

 */

namespace Cepharum\Contao\CorsBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Implements integration of plugin with Contao's plugin manager used in its
 * managed edition.
 *
 * Primarily this integration requires instructions used by plugin manager on
 * when to load this plugin in context of all other available plugins.
 *
 * @package Cepharum\Contao\CorsBundle\ContaoManager
 */
class Plugin implements BundlePluginInterface {
	public function getBundles( ParserInterface $parser ) {
		return [
			BundleConfig::create( \Cepharum\Contao\CorsBundle\CorsBundle::class )
				->setLoadAfter( [
					ContaoCoreBundle::class
				] )
		];
	}
}
