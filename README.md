# kuroneko

/application/bootstrap.php - global initialization

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

Parameter type can be string or integer. String means alphanumeric words delimited by hyphen:
`string`,
`another-string`

### Route parameter node
Parameter passed in route: `[Name]`

### Template nodes
```json
{
  "@template": "Path.To.Template",
  "var1": "value1",
  "var2": "value2"
  ... other variables
}
```
Template variables can be another template node, service node, string, number, boolean.

### Service nodes
Service is just class having static method.
```json
{
  "@service": "Path.To.Class Method",
  "@params": [
    "param1",
    "[RouteParam]"
    ... other parameters
  ]
}
```
Params can be another service node, template node, string, number, boolean.

## Class loading
All your classes should be placed in `/application` directory. Otherwise autoloader can't find them.
