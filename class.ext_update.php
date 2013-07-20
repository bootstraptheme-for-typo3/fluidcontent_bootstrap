<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Claus Due <claus@wildside.dk>, Wildside A/S
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
 * @author Claus Due <claus@wildside.dk>
 * @package FluidcontentBootstrap
 */
class ext_update {
	public function access() {
		return TRUE;
	}

	public function main() {
		$condition = "CType='fed_fce' AND tx_fed_fcefile LIKE 'fluidcontent_twitterbootstrap:%'";
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid,tx_fed_fcefile', 'tt_content', $condition);
		foreach ($rows as $row) {
			$newIdentity = str_replace('fluidcontent_twitterbootstrap', 'fluidcontent_bootstrap', $row['tx_fed_fcefile']);
			$values = array(
				'tx_fed_fcefile' => $newIdentity
			);
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_content', 'uid=' . intval($row['uid']), $values);
		}

		return count($rows) . ' row(s) have been updated';
	}
}
