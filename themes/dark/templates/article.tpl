{include="header"}
{loop="articles"}
	<article class="markdown">
		<section class="title">
			{$value.title}
		</section>
		<section class="text">
			{$value.content}
		</section>
		<section class="info">
			Written by {$value.author} on {$value.time}
		</section>
	</article>
	
	<section class="separator"></section>
{/loop}
{include="footer"}
