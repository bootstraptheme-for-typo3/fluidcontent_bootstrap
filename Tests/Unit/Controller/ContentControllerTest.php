<?php
namespace FluidTYPO3\FluidcontentBootstrap\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Claus Due <claus@namelesscoder.net>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use FluidTYPO3\Flux\Controller\BasicControllerTest;
use FluidTYPO3\Flux\Tests\Unit\Controller\AbstractFluxControllerTestCase;

/**
 * ContentController test case
 *
 * @package FluidTYPO3\FluidcontentBootstrap\Controller
 */
class ContentControllerTest extends AbstractFluxControllerTestCase {

	/**
	 * @var string
	 */
	protected $extensionName = 'FluidTYPO3.FluidcontentBootstrap';

	/**
	 * @test
	 */
	public function accordionActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('alert');
	}

	/**
	 * @test
	 */
	public function alertActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('accordion');
	}

	/**
	 * @test
	 */
	public function buttonGroupActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('buttonGroup');
	}

	/**
	 * @test
	 */
	public function buttonLinkActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('buttonLink');
	}

	/**
	 * @test
	 */
	public function carouselActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('carousel');
	}

	/**
	 * @test
	 */
	public function rowActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('row');
	}

	/**
	 * @test
	 */
	public function jumbotronActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('jumbotron');
	}

	/**
	 * @test
	 */
	public function navigationListActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('navigationList');
	}

	/**
	 * @test
	 */
	public function pageHeaderActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('pageHeader');
	}

	/**
	 * @test
	 */
	public function tabsActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('tabs');
	}

	/**
	 * @test
	 */
	public function thumbnailsActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('thumbnails');
	}

	/**
	 * @test
	 */
	public function wellActionRendersView() {
		$this->assertSimpleActionCallsRenderOnView('well');
	}

}
