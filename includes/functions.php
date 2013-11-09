<?php
/**
 * Main functions file
 * @author: Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2013-11-09
 * @copyright (c) 2013, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
defined("INLINE") or die("No direct access allowed!\n");

function sort_articles($a, $b) {
	if($a["filetime"] == $b["filetime"]) {
		return 0;
	} elseif($a["filetime"] > $b["filetime"]) {
		return -1;
	} else {
		return 1;
	}
}