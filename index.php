<?php

/**
 * Index file
 * @author Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2013-11-09
 * @copyright (c) 2013, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
define("INLINE", true);

$cfg = require_once("includes/config.php");
define("BASE_URL", $cfg["blog"]["url"]);
define("THEME_URL", BASE_URL . "/themes/" . $cfg["blog"]["theme"]);
require_once("includes/functions.php");
require_once("includes/raintpl.class.php");
require_once("includes/parsedown.class.php");

//template engine setup
RainTPL::configure("tpl_dir", "themes/" . $cfg["blog"]["theme"] . "/templates/");
RainTPL::configure("tpl_ext", "tpl");
RainTPL::configure("cache_dir", "cache/");
RainTPL::configure("path_replace", false);
RainTPL::configure("base_url", BASE_URL);
RainTPL::configure("check_template_update", !$cfg["system"]["cache"]);
$tpl = new RainTPL;
$tpl->assign("blog", $cfg["blog"]);

//nav
if (!empty(cleanDirList(scandir("content/pages")))) {
	$nav =[];
	
	//insert blog nav link
	$nav[] = [
		"text" => "Blog",
		"url" => BASE_URL
	];
	
	//read pages
	$nav_handle = opendir("content/pages");
	while (false !== ($file = readdir($nav_handle))) {
		if ($file != "." && $file != "..") {
			//build field in $nav
			next($nav);
			$page_content = file_get_contents("content/pages/" . $file);
			$matches = [];
			preg_match("/^@{3}(.*)@{3}/s", $page_content, $matches);
			$nav[key($nav)]["text"] = json_decode($matches[1], true)["title"];
			$nav[key($nav)]["url"] = BASE_URL . "/?p=" . str_replace(".md", "", $file);
		}
	}
	closedir($nav_handle);
	
	//assign nav to template
	$tpl->assign("nav", $nav);
} else {
	goto articles;
}

//define content
if (($content = filter_input(INPUT_GET, "p")) === NULL) {
	$content = "blog";
}

if ($content == "blog") {
	articles:
	//read articles
	$articles_file = [];
	$article_handle = opendir("content/articles");
	while (false !== ($file = readdir($article_handle))) {
		if ($file != "." && $file != "..") {
			$articles_file[] = $file;
		}
	}
	closedir($article_handle);

	//parse articles
	$articles = [];
	foreach ($articles_file as $article_file) {
		$article_content = file_get_contents("content/articles/" . $article_file);
		$matches = [];
		preg_match("/^@{3}(.*)@{3}/s", $article_content, $matches);
		$articles[] = json_decode($matches[1], true);
		$articles[key($articles)]["content"] = Parsedown::instance()->parse(str_replace($matches[0], "", $article_content));
		$articles[key($articles)]["filetime"] = filemtime("content/articles/" . $article_file);
		next($articles);
	}

	//sort articles by filetime
	usort($articles, "sort_articles");

	//put everything together
	$tpl->assign("articles", $articles);
	$draw = "article";
} else {
	//parse page
	if (file_exists("content/pages/" . $content . ".md")) {
		$page_content = file_get_contents("content/pages/" . $content . ".md");
		$matches = [];
		preg_match("/^@{3}(.*)@{3}/s", $page_content, $matches);
		$page = json_decode($matches[1], true);
		$page["content"] = Parsedown::instance()->parse(str_replace($matches[0], "", $page_content));

		//put everything together
		$tpl->assign("page", $page);
		$draw = "page";
	} else {
		header("Location: " . BASE_URL);
		die();
	}
}

//finally draw template
$tpl->draw($draw);
