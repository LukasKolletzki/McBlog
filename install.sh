#!/bin/bash
echo "Welcome to McBlog installer"
echo "Your blog's name: "
read blogname
echo "A slogan for your blog: "
read blogslogan
echo "The URL, your blog will available through (WITHOUT / at the end): "
read blogurl
echo "<?php

/**
 * Main config file
 * @author: Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2013-11-09
 * @copyright (c) 2013, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
defined(\"INLINE\") or die(\"No direct access allowed!\\n\");

return [
	\"blog\" => [
		\"name\" => \"$blogname\",
		\"slogan\" => \"$blogslogan\",
		\"url\" => \"$blogurl\",
		\"theme\" => \"bright\"
	],
	\"system\" => [
		\"cache\" => true  //if set to false, McBlog will parse your templates every time the page is visited
	]
];" > includes/config.php
echo "Config file created successfully."
echo "Your webserver user (usually www-data): "
read webserveruser
chmod 0775 cache/
chown $USER:$webserveruser cache/
echo "Cache folder made writeable"
echo "Everything set up correctly, have fun writing articles ;-)"