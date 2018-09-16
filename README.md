<h1 align="center">Project 1 gezinshuis</h1>
<h3 align="center">Made by: Tuan, Mick, Romy Mae, Ricardo en Thomas</h3>

#### Project_Structure
```

    // Used for autoloading / bootstrapping things
├── bootstrap.php
│    // Regular old autoloading composer.json file
├── composer.json
├── composer.lock
│    // This is where the web server runs on, so the routing is handled here
│    // See this as the entry point where the request first lands
├── index.php
├── README.md
│    // Where all the classes and fun stuff resides, the root for autoloading
│    // as defined in composer.json
├── src
│    // This is where you store your controllers 
│   ├── controllers
│   │   └── ExampleController.php
│    // Database client
│   ├── Database.php
│    // Interfaces used for controlling how controllers/middleware look
│   ├── interfaces
│   │   ├── IController.php
│   │   ├── IMiddleware.php
│   │   └── IRouter.php
│    // Middleware, basically a function that should run before letting these routes get used
│   ├── middleware
│   │   └── ExampleMiddleware.php
│    // The class used for routing / handling middleware
│   └── Router.php
│    // where all the views reside (using Blade)
├── views
│   ├── 404.blade.php
│   └── index.blade.php
│    // example sql file which is currently used as an example
└── voorbeeldsql.sql

```
Command for re-generating the project structure (linux): `tree -I 'vendor|cache'`


#### Packages
Packages used in this project are
```
phpdotenv
    this is used to handle .env file contents
blade
    this is used for 'rendering' a view
illuminate/database
    this is used for query building with Eloquents query builder (not used for modelling, just the query builder)
    see https://laravel.com/docs/5.7/queries
```
