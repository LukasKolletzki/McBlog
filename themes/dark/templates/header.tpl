<!DOCTYPE html>
<html>
	<head>
		<title>{$blog.name}</title>

		<meta charset="utf-8">
		<meta name="generator" content="McBlog" />

		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu+Mono:400|Ubuntu:400,300">
		<link rel="stylesheet" type="text/css" href="{#THEME_URL#}/styles/main.css" />
		<link rel="stylesheet" type="text/css" href="{#THEME_URL#}/styles/markdown.css" />
	</head>

	<body>
		<section class="container">
			<header>
				<section class="name">
					{$blog.name}
				</section>
				<section class="slogan">
					{$blog.slogan}
				</section>
				{if="isset($nav)"}
					<nav>
						<ul>
							{loop="nav"}
								<li>
									<a href="{$value.url}">{$value.text}</a>
								</li>
							{/loop}
						</ul>
					</nav>
				{/if}
			</header>

			<section class="content">
