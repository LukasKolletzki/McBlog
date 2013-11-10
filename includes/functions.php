<?php
/**
 * Main functions file
 * @author: Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2013-11-09
 * @copyright (c) 2013, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
defined("INLINE") or die("No direct access allowed!\n");

/**
 * Helper function for sorting articles
 * @param array $a article array a
 * @param array $b article array b
 * @return int -1: a < b; 0: a = b; 1: a > b
 */
function sort_articles($a, $b) {
	if($a["filetime"] == $b["filetime"]) {
		return 0;
	} elseif($a["filetime"] > $b["filetime"]) {
		return -1;
	} else {
		return 1;
	}
}

/**
 * Removes . and .. from an array containing a list of all files in a directory
 * @param array $pDirList array with directory list
 * @return array cleaned array
 */
function cleanDirList($pDirList) {
	unset($pDirList[0]);
	unset($pDirList[1]);
	return $pDirList;
}