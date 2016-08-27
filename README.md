# Minimis Framework
A very minimalist PHP framework. Minimis means light in Latin because it is: only 148ko!

It's based on some Symfony components (see composer.json).

Go to the wiki (https://github.com/scorsi/minimis/wiki) to see all docs. And learn how Minimis works.

There is three folders:
 - Public: which can contains css, js, imgs... You have to target your server to this folder.
 - App: which contains the View-Controller structure and the routes file. Your application will be in this folder.
 - Src: which contains conf et primary skeleton of the framework:
    - Core: primary files. Do not edit them except if you know what you do.
    - Config: config files for the framework. It is highly recommended that you change it.

# Rain Template Engine
RainTPL is the official template engine of Minimis!
Made by Federico Ulfo and a lot of awesome contributors!

It is an easy template engine for PHP that enables designers and developers to work better together, it loads HTML template to separate the presentation from the logic.

It is integrated into Minimis. You can use it in few lines (show ExampleController for more information).

## Features
* Easy for designers, only 10 tags, *{$variable}*, *{#constant#}*, *{include="filename"}*, *{loop="array"}{/loop}*, *{if="expression"}{else}{/if}*, *{*\* \**}*, *{ignore}{/ignore}*, *{noparse}{/noparse}*, *{function="function name}*
* Easy for developers, only 1 method to call for drawing templates.
* Powerful, modifier and operation with variables.
* Extensible, load plugins and register new tags. (not enabled actually)
* Secure, sandbox with blacklist.

# Next update
- Add relationships methods (oneToOne, oneToMany, manyToMany) to the query builder
- Add plugins loader to template engine
- Add tags to template engine as {!$var} no autoescaping
- Add forms builder (symfony components)
- Add CSRF protection (symfony components)
- Add authentication functionnalities
- Add validation functionnalities
- Add translations functionnalities
- Add debug functionnalities with serializer (laravel components)