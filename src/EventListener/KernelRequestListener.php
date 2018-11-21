<?php
/**
 * (c) 2018 cepharum GmbH, Berlin, http://cepharum.de
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2018 cepharum GmbH
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE
 * SOFTWARE.
 *
 * @author: cepharum
 */

namespace Cepharum\Contao\CorsBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class KernelRequestListener {
	private $domains;

	public function __construct( $domains ) {
		$this->domains = $domains;
	}

	public function onKernelRequest( GetResponseEvent $event ) {
		$request = $event->getRequest();
		if ( $request->getMethod() === 'OPTIONS' ) {
			if ( array_search( '*', $this->domains ) ) {
				return new Response( 204, '', [
					'Access-Control-Allow-Origin' => '*',
					'Access-Control-Allow-Method' => 'GET',
				] );
			} else {
				$origin = $request->headers->get( 'Origin' );
				if ( $origin ) {
					foreach ( $this->domains as $domain ) {
						if ( $origin === $domain ) {
							return new Response( 204, '', [
								'Access-Control-Allow-Origin' => $origin,
								'Access-Control-Allow-Method' => 'GET',
							] );
						}
					}
				}
			}
		}
	}
}
