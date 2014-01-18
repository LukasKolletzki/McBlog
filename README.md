#McBlog
A very simple PHP blog engine, using Markdown files as article ressource

##Installation
###Simple (requires a GNU/Linux system with SSH access)
1. Download all files and extract them, if neccessary
2. Upload all files to your webserver
3. Open a ssh connection to your server and navigate to McBlog
3. Make `install.sh` writeable by typing `chmod +x install.sh`
4. Run `./install.sh` and follow the guide.
5. Upload some Markdown articles to `articles/`
6. Have fun, using McBlog ;-)

###Manually
1. Download all files and extract them, if neccessary
2. Open `includes/config.php` in a text editor and fill in your values
       * `name` is the name of your blog
       * `slogan` is the slogan/subtitle
       * `url` is the URL of your blog
3. Upload all files to your webserver
4. Make `cache/` folder writeable
5. Upload some Markdown articles to `content/articles/` and some Markdown pages to `content/pages/`
6. Have fun, using McBlog ;-)

##Writing
You can write your articles and pages in regular Markdown.
McBlog also supports metadata for articles and pages. If you want to specify some information on an article or a page, use the following syntax:
```
@@@
{
    "title": "Example post",
    "author": "My name",
    "time": "13-3-7 at 13:37",
    "whatever": "whatever content"
}
@@@
This is the article or page content. You can write your article or page here with regular Markdown.
```
Notice, that the code between the two `@@@` has to be valid JSON. This JSON gets parsed and is available through the variable `articles` or `page` in your template. That means, that you can write what ever you want into this JSON, it will be available in your template.

##Theming
McBlog uses [RainTPL](http://raintpl.com), a very simple but powerful template engine.
You can change your theme at `includes/config.php`.
If you want to customize your theme, this information might be useful:

* Each theme is represented by a folder in `themes/`.
* McBlog requires the files `themes/<your_theme_name>/templates/article.tpl` and `themes/<your_theme_name>/templates/page.tpl`, they are your main template file. Using the functions of RainTPL, you can build your theme on top of these files.
* Theme-related styles, scripts, images and more should be stored in the theme folder.
* The navigation gets automatically generated, see _Ressources_ for more information

###Ressources
* Variables:
      * `blog` is an array with the values of the `blog` section in `includes/config.php`
      * `nav` is an array containing the navigation. Each field is an array with `test` and `url` in it, representing the link text and the link url.
      * `articles` is an array containig all articles. Each field contains the JSON you wrote above your article, (see _Writing_) and the field `content` which is your parsed Markdown __[only available in blog]__
      * `page` contains the content of the current page and the JSON, wrote above (see _Writing_)__[only avalable on pages]__
* Constants:
      * `BASE_URL` is a constant that contains your blog URL, configured in `includes/config.php`.
      * `THEME_URL` contains the path to your to the current theme.  Make sure you use this when including stylesheets or other ressources in your markup
* Markdown:
      * McBlog parses standard Markdown. You might have a look at `styles/markdown.css`, it might be  a sample for own styles

##Todo
* Pages containing `n` articles
* Password protected articles
* Article preview
* RSS/Atom feed

##License
McBlog is a very simple PHP blog engine, using Markdown files as article ressource.
Copyright (C) 2013 Lukas Kolletzki

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/.
