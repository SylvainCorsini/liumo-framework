# Minimis Framework
A very minimalist PHP framework. Minimis means light in Latin because it is: only 148ko!

It's based on some Symfony components (see composer.json).

Go to the wiki (https://github.com/scorsi/minimis/wiki) to see all docs. And learn how Minimis works.

## Next update
- Add relationships methods (oneToOne, oneToMany, manyToMany) to the query builder
- Add plugins loader to template engine
- Add tags to template engine as {!$var} no autoescaping
- Add forms builder (symfony components)
- Add CSRF protection (symfony components)
- Add authentication functionnalities
- Add validation functionnalities
- Add translations functionnalities
- Add debug functionnalities with serializer (laravel components)

## Possible improvement
- Remove these vendors:
  - symfony/event-dispatcher
  - symfony/http-kernel create own http-kernel
  - symfony/http-foundation create own Request and Response objects
  - symfony/routing fork from nikic/FastRoute

# License

See on https://tldrlegal.com/license/x11-license the terms of the X11 license.
