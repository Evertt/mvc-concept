# MVC-concept

This proof of concept is inspired by the blog article ["Views are not templates"](https://r.je/views-are-not-templates.html).

So this is an implementation of MVC where the controller is not the middle-man between the model and the view. Instead the view-layer has become more comprehensive. Where before the view was nothing more than a template, now the view layer consists of a view-model (which I just call the view) as well as a template.

This has worked well to make everything very reusable. As you can see in `config/routes.yaml` I have three routes setup which all reuse quite some objects. Please read the code and get familiar with it and let me know if you like the way this is structured. :-)