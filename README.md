# Liumo Framework
A very minimalist framework. Liumo is lightweight, fast but still powerful.

It's based on some Symfony components (see composer.json).

There is three folders:
 - Public: which can contains css, js, imgs... It's the target of the server...
 - App: which contains the MVC structure, you can edit and add files. (Only Controller and Model works at this moment)
 - Src: which contains conf et primary skeleton of the framework:
    - Core: primary files.

# Rain Template Engine
RainTPL is the official template engine of Liumo!
Made by Federico Ulfo and a lot of awesome contributors!

RainTPL is an easy template engine for PHP that enables designers and developers to work better together, it loads HTML template to separate the presentation from the logic.

RainTPL is fully integrated into Liumo. You can use it in few lines (show ExampleController for more information).

## Features
* Easy for designers, only 10 tags, *{$variable}*, *{#constant#}*, *{include="filename"}*, *{loop}*, *{if}*, *{*\**comment*\**}*, *{noparse}*, *{function}*
* Easy for developers, 5 methods to load and draw templates.
* Powerful, modifier and operation with variables
* Extensible, load plugins and register new tags
* Secure, sandbox with blacklist.

# Next update
- Pixie as the official query builder!
