{include="header"}
{loop="articles"}
	<article>
		<section class="title">
			{$value.title}
		</section>
		<section class="text">
			{$value.content}
		</section>
	</article>
	
	<section class="separator"></section>
{/loop}
{include="footer"}