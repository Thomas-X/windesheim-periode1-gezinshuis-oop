<h1 align="center">Project 1 gezinshuis</h1>
<h3 align="center">Made by: Tuan, Mick, Romy Mae, Ricardo en Thomas</h3>

#### Project_Structure
```
    // used for autoloading and setting up phpdotenv
├── bootstrap.php
    // packages list / autoloading root
├── composer.json
├── composer.lock
├── LICENSE
    // public folder for serving static files
├── public
│   ├── css
│   │   └── app.css
    // the root of it all, here is where the app DI container gets setup and ran
│   └── index.php
├── README.md
    // routes folder containing routes that are being used
├── routes
│   └── web.php
    // a simple php script (like 2 lines simple) for running this project, run it with php run.php
├── run.php
    // the folder where SQL database dumps should be in (ERD per example)
├── sql
│   └── voorbeeldsql.sql
    // the autoloading root (the root name is Qui)
├── src
        // place your favorite controllers here
│   ├── controllers
│   │   └── ExampleController.php
        // the 'core' classes of the 'framework', see comments inside the files for more info
│   ├── core
│   │   ├── App.php
│   │   ├── BoundMethodWrapper.php
│   │   ├── Database.php
│   │   ├── facades
│   │   │   ├── DB_PDO.php
│   │   │   ├── DB.php
│   │   │   ├── Facade.php
│   │   │   ├── Router.php
│   │   │   ├── Util.php
│   │   │   ├── Validator.php
│   │   │   └── View.php
│   │   ├── Request.php
│   │   ├── Response.php
│   │   ├── Router.php
│   │   ├── Util.php
│   │   ├── Validator.php
│   │   └── View.php
        // place some interfaces you need here
│   ├── interfaces
│   │   ├── IController.php
│   │   ├── IMiddleware.php
│   │   └── IRouter.php
        // place some middleware for example for authing user. must always return a boolean (currently can't pass values to req/res)
│   └── middleware
│       └── ExampleMiddleware.php
    // place your views here, check laravel's blade documentation for more info
└── views
    ├── 404.blade.php
    ├── index.blade.php
    └── layouts
        └── app.blade.php
```
Command for re-generating the project structure (linux): `tree -I 'vendor|cache'`


#### Packages
Packages used on the older branches are: 
No dependencies are used on the master branch.
```
phpdotenv
    this is used to handle .env file contents
blade
    this is used for 'rendering' a view
illuminate/database
    this is used for query building with Eloquents query builder (not used for modelling, just the query builder)
    see https://laravel.com/docs/5.7/queries
```

#### TODO
* ❌ give middleware the option to pass req/res via a cb function passed to said middleware
* ✅ add more comments
