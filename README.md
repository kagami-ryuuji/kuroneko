# kuroneko [![Build Status](https://travis-ci.org/kagami-ryuuji/kuroneko.svg)](https://travis-ci.org/kagami-ryuuji/kuroneko)

## Installation
Just download and put into your www directory.
Requires mod_rewrite.

### /application/bootstrap.php
Global initialization here (init your database or session for example)

## Routing
### /application/routes.json
```json
[
  {
    "when": "route/template",
    "then": {
      "init": [
        "[Route.Specific Initialize]"
      ],
      "output": "Simple value or node. It'll be result"
    }
  }
  ... other routes
]
```

### URI template syntax

`otaku`,
`otaku/{param:type}`,
`otaku[/optional]`

Parameter type can be `string` or `integer`. String means alphanumeric words delimited by hyphen:
`string`,
`another-string`

### Nodes
Inspired by Blender nodes

### Route parameter node
Parameter passed in route: `[Name]`. Parameter names always processed with `lcfirst()`

### Template node
```json
{
  "@template": "Path.To.Template",
  "var1": "value1",
  "var2": "value2"
  ... other variables
}
```
Template path: `/application/Path/To/Template.php`
Template variables can be another template node, service node, string, number, boolean.

### Service node
Service is just class having static method. Method names always processed with `lcfirst()`
```json
{
  "@service": "[Path.To.Class Method]",
  "@params": [
    "param1",
    "[RouteParam]"
    ... other parameters
  ]
}
```
Class path: `/application/Path/To/Class.php`
Parameter can be another service node, template node, string, number, boolean.
Called class method doesn't know where its result will be used. It doesn't work with templates directly. It simplifies testing.

## Class loading
All your classes should be placed in `/application` directory. Otherwise autoloader can't find them.
