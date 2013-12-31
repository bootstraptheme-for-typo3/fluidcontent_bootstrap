<?php
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

/**
 * Updater Script for fluidcontent_bootstrap
 *
 * @author Claus Due <claus@namelesscoder.net>
 * @author Fabien Udriot <fabien.udriot@ecodev.ch>
 * @package FluidcontentBootstrap
 */
class ext_update {
	public function access() {
		return TRUE;
	}

	public function main() {
		$output[] = $this->updateNewIdentity();
		$output[] = $this->updateTwitterBootstrapVersion3NewPath();
		$output[] = $this->updateTwitterBootstrapVersion3ClassNames();

		return sprintf('<ul><li>%s</li></ul>', implode('</li><li>', $output));
	}

	/**
	 * Update new identity.
	 *
	 * @return string
	 */
	public function updateNewIdentity() {

		$condition = "CType='fed_fce' AND tx_fed_fcefile LIKE 'fluidcontent_twitterbootstrap:%'";
		$rows = $this->getDatabaseConnection()->exec_SELECTgetRows('uid,tx_fed_fcefile', 'tt_content', $condition);
		foreach ($rows as $row) {
			$newIdentity = str_replace('fluidcontent_twitterbootstrap', 'fluidcontent_bootstrap', $row['tx_fed_fcefile']);
			$values = array(
				'tx_fed_fcefile' => $newIdentity
			);
			$this->getDatabaseConnection()->exec_UPDATEquery('tt_content', 'uid=' . intval($row['uid']), $values);
		}

		$result = '<strong>Update new identity "fluidcontent_bootstrap"</strong><br/>';
		$result .= count($rows) . ' row(s) have been updated';
		return $result;
	}

	/**
	 * Update new identity.
	 *
	 * @return string
	 */
	public function updateTwitterBootstrapVersion3NewPath() {

		$condition = "CType='fluidcontent_content' AND tx_fed_fcefile = 'fluidcontent_bootstrap:FluidRow.html' OR tx_fed_fcefile = 'fluidcontent_bootstrap:HeroUnit.html'";
		$rows = $this->getDatabaseConnection()->exec_SELECTgetRows('uid,tx_fed_fcefile', 'tt_content', $condition);
		foreach ($rows as $row) {
			$newPath = str_replace('fluidcontent_bootstrap:FluidRow.html', 'fluidcontent_bootstrap:Row.html', $row['tx_fed_fcefile']);
			$newPath = str_replace('fluidcontent_bootstrap:HeroUnit.html', 'fluidcontent_bootstrap:Jumbotron.html', $newPath);
			$values = array(
				'tx_fed_fcefile' => $newPath
			);
			$this->getDatabaseConnection()->exec_UPDATEquery('tt_content', 'uid=' . intval($row['uid']), $values);
		}

		$result = '<strong>Updating Twitter Bootstrap 3.x new path</strong><br/>';
		$result .= count($rows) . ' row(s) have been updated';
		return $result;
	}

	/**
	 * Update new identity.
	 *
	 * @return string
	 */
	public function updateTwitterBootstrapVersion3ClassNames() {

		// Easy search and replace.
		$classNames = array(
			'span' => 'col-md-',
		);
		$result = '';
		foreach ($classNames as $oldClassName => $newClassName) {
			$condition = "CType='fluidcontent_content' AND pi_flexform LIKE '%span%'";
			$rows = $this->getDatabaseConnection()->exec_SELECTgetRows('uid, pi_flexform', 'tt_content', $condition);
			foreach ($rows as $row) {
				$newFlexForm = str_replace($oldClassName, $newClassName, $row['pi_flexform']);
				$values = array(
					'pi_flexform' => $newFlexForm
				);
				$this->getDatabaseConnection()->exec_UPDATEquery('tt_content', 'uid=' . intval($row['uid']), $values);
			}
			$result .= sprintf('%s row(s) have been updated: class name "%s[1-x]" replaced by "%s[1-x]" <br/>',
				count($rows),
				$oldClassName,
				$newClassName
			);
		}

		// These are special cases for class "default" and "error" which can not be blindly replaced.
		// But need to be parsed.
		$classNames = array(
			'default' => 'warning',
			'error' => 'danger',
		);

		foreach ($classNames as $oldClassName => $newClassName) {

			$counter = 0;
			$condition = "CType='fluidcontent_content' AND pi_flexform != ''";
			$rows = $this->getDatabaseConnection()->exec_SELECTgetRows('uid, pi_flexform', 'tt_content', $condition);
			foreach ($rows as $row) {

				$dom = new DOMDocument;
				$dom->loadXML($row['pi_flexform']);
				$dom->formatOutput = TRUE;

				$xpath = new DOMXpath($dom);

				/** @var DOMNodeList $elements */
				$elements = $xpath->query('//*[@index="class"]/value[text()="' . $oldClassName . '"]');
				if ($elements->length > 0) {

					foreach ($elements as $element) {
						/** @var DOMElement $element */
						$element->nodeValue = $newClassName;
					}

					$values = array(
						'pi_flexform' => $dom->saveXml()
					);

					$counter++;
					$this->getDatabaseConnection()->exec_UPDATEquery('tt_content', 'uid=' . intval($row['uid']), $values);
				}
			}
			$result .= sprintf('%s row(s) have been updated: class name "%s" replaced by "%s" <br/>',
				$counter,
				$oldClassName,
				$newClassName
			);
		}

		return '<strong>Updating Twitter Bootstrap 3.x class names</strong><br/>' . $result;
	}

	/**
	 * Return a pointer to the database.
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseConnection() {
		return $GLOBALS['TYPO3_DB'];
	}
}
