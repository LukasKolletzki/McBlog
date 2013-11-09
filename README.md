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

###Manual
1. Download all files and extract them, if neccessary
2. Open `includes/config.php` in a text editor and fill in your values
       * `name` is the name of your blog
       * `slogan` is the slogan/subtitle
       * `url` is the URL of your blog
3. Upload all files to your webserver
4. Make `cache/` folder writeable
5. Upload some Markdown articles to `articles/`
6. Have fun, using McBlog ;-)

##Writing
You can write your articles in regular Markdown.
McBlog also supports metadata for articles. If you want to specify some information on an article, use the following syntax:
```
@@@
{
    "title": "Example post",
    "author": "My name",
    "time": "13-3-7 at 13:37",
    "whatever": "whatever content"
}
@@@
This is the article content. You can write your article here with regular Markdown.
```
Notice, that the code between the two `@@@` has to be valid JSON. This JSON gets parsed and is available through the variable `articles` in your template. That means, that you can write what ever you want into this JSON, it will be available in your template.

##Theming
McBlog uses [RainTPL](http://raintpl.com), a very simple but powerful template engine.
You can change your theme at `includes/config.php`.
If you want to customize your theme, this information might be useful:

* Each theme is represented by a folder in `themes/`.
* McBlog requires the file `themes/<your_theme_name>/templates/main.tpl`, it is your main template file. Using the functions of RainTPL, you can build your theme on top of this file
* Theme-related styles, scripts, images and more should be stored in the theme folder.

###Ressources
* Variables:
      * `blog` is an array with the values of the `blog` section in `includes/config.php`
      * `articles` is an array containig all articles. Each field contains the JSON you wrote above your article, (See _Writing_) and the field `content` which is your parsed Markdown
* Constants:
      * `BASE_URL` is a constant that contains your blog URL, configured in `includes/config.php`.
      * `THEME_URL` contains the path to your to the current theme.  Make sure you use this when including stylesheets or other ressources in your markup
* Markdown:
      * McBlog parses standard Markdown. You might have a look at `styles/article.css`, it might be  a sample for own styles

##Todo
* Sites
* Navigation
* Pages containing `n` articles
* Password protected articles
* Article preview

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