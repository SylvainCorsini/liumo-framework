# Liumo Framework
A very minimalist framework. Liumo is lightweight, fast and still powerful.

It's based on some Symfony components (see composer.json).

There is three folders:
 - Public: which can contains css, js, imgs... You have to target your server to this folder.
 - App: which contains the MVC structure and the routes file. Your application will be in this folder.
 - Src: which contains conf et primary skeleton of the framework:
    - Core: primary files. Do not edit them except if you know what you do.
    - Config: config files for the framework. It is highly recommended that you change it.

# Rain Template Engine
RainTPL is the official template engine of Liumo!
Made by Federico Ulfo and a lot of awesome contributors!

RainTPL is an easy template engine for PHP that enables designers and developers to work better together, it loads HTML template to separate the presentation from the logic.

RainTPL is fully integrated into Liumo. You can use it in few lines (show ExampleController for more information).

## Features
* Easy for designers, only 10 tags, *{$variable}*, *{#constant#}*, *{include="filename"}*, *{loop="array"}{/loop}*, *{if="expression"}{else}{/if}*, *{*\* \**}*, *{ignore}{/ignore}*, *{noparse}{/noparse}*, *{function="function name}*
* Easy for developers, 5 methods to load and draw templates.
* Powerful, modifier and operation with variables
* Extensible, load plugins and register new tags
* Secure, sandbox with blacklist.

# Next update
- Pixie as the official query builder!
