# Liumo Framework
A very minimalist framework by Sylvain Corsini.

It's based on some Symfony components (see composer.json).

There is three folders:
 - Public: which can contains css, js, imgs... It's the target of the server Apache, Nginx...
 - App: which contains the MVC structure, you can edit and add files. (Only Controller and Model works at this moment)
 - Src: which contains conf et primary skeleton of the framework. There is two folders:
    - Core: primary files. Do not edit them because they will be deleted at a next update.
    - Override: this folder is empty. It was made for you to allow you to override the core files. Do not do this except if you know what you do. (Not working)

# Next update
In the next update, the class to create views will be added. May be with a famous template as Twig or Blade (Laravel's template).
