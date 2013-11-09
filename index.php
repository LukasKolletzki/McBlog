<?php

/**
 * Index file
 * @author Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2013-11-08
 * @copyright (c) 2013, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
define("INLINE", true);

$cfg = require_once("includes/config.php");
define("BASE_URL", $cfg["blog"]["url"]);
require_once("includes/functions.php");
require_once("includes/raintpl.class.php");
require_once("includes/parsedown.class.php");

//template engine setup
RainTPL::configure("tpl_dir", "templates/");
RainTPL::configure("tpl_ext", "tpl");
RainTPL::configure("cache_dir", "cache/");
RainTPL::configure("path_replace", false);
RainTPL::configure("base_url", BASE_URL);
RainTPL::configure("check_template_update", !$cfg["system"]["cache"]);
$tpl = new RainTPL;

//read articles
$articles_file = [];
$article_handle = opendir("articles");
while (false !== ($file = readdir($article_handle))) {
	if ($file != "." && $file != "..") {
		$articles_file[] = $file;
	}
}
closedir($article_handle);

//parse articles
$articles = [];
foreach ($articles_file as $article_file) {
	$article_content = file_get_contents("articles/" . $article_file);
	$matches = [];
	preg_match("/^@{3}(.*)@{3}/s", $article_content, $matches);
	$articles[] = json_decode($matches[1], true);
	$articles[key($articles)]["content"] = Parsedown::instance()->parse(str_replace($matches[0], "", $article_content));
	$articles[key($articles)]["filetime"] = filemtime("articles/" . $article_file);
	next($articles);
}

//sort articles by filetime
usort($articles, "sort_articles");

//put everything together
$tpl->assign("blog", $cfg["blog"]);
$tpl->assign("articles", $articles);
$tpl->draw("main");
