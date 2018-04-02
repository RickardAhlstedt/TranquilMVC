# Scripting #
Tranquil supports a few commands that are parsed upon rendering and when generating the cache.  
These commands are parsed in clView.php.  

## Include views ##
Code-examples:
```
{view:[model]/[viewfile]}
```
Using the example above, you can render out custom views in your pages.
Usage:
```
{view:infoContent/404}
```
The above example will render 404.php from views/infoContent/

## Render specific infoContent-blocks ##
You can also render a specific block of content by doing
```
{render:[ID]}
```
This way, you can create a new infoContent-entry in your database (soon available thru the administration) and render them out on the view that has this included script-line.  
Note that this uses the infoContent-module.

## Further development ##
Please post suggestions as an issue, or as a pull-request.

## Adding your own script-line ##
Please see clView.php, line 31 to 52 on how to add your own commands.