<?php

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
