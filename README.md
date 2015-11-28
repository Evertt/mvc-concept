# MVC-concept

This proof of concept is inspired by the blog article ["Views are not templates"](https://r.je/views-are-not-templates.html).

So this is an implementation of MVC where the controller is not the middle-man between the model and the view. Instead the view-layer has become more comprehensive. Where before the view was nothing more than a template, now the view layer consists of a view-model (which I just call the view) as well as a template.

This has worked well to make everything very reusable. As you can see in `/config/routes.yaml` I have three routes setup which all reuse quite some objects. Please read the code and get familiar with it and let me know if you like the way this is structured. The code in `/framework` is just to pretend to have a framework, so that's not so important for making my point. I'm mostly interested in how you like the structure in `/app` and `/config/routes.yaml`.

One thing you might love or you might hate is the way I bind data from the view to the template. Basically, when you make a view class, all the public methods beginning with the word "get" will be used to bind data to the template. So for example, if your view class has a method called `getItems()` then whatever that returns will be mapped to `$items` in the template. Maybe it's a little bit magic, but I think it helps to keep the code much cleaner.

Download the code, run `composer install` and test if it works. The way I test this application is by running either the following commands in the terminal:

```
$ php index.php /users
$ php index.php /users/2
$ php index.php /posts
```

Granted I use php 5.6 in my terminal, so it might not work for you since I use short-hand syntax for arrays and stuff like that...