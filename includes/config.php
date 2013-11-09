<?php

/**
 * Main config file
 * @author: Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2013-11-09
 * @copyright (c) 2013, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
defined("INLINE") or die("No direct access allowed!\n");

return [
	"blog" => [
		"name" => "Your blog's name",
		"slogan" => "A short description of your blog",
		"url" => "The URL your blog is available through"
	], 
	"system" => [
		"cache" => true  //if set to false, McBlog will parse your templates every time the page is visited
	]
];
