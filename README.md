<h1 align="center">Project 1 gezinshuis</h1>
<h3 align="center">Made by: Tuan, Mick, Romy Mae, Ricardo en Thomas</h3>

#### Usage and Requirements
```
For this project you need:

Composer
PHP >= 7
NodeJS >= 10.0.0

installed

Usage (development):
node run.js

Usage (production):
npm run build
php run.php

Usage (phpdoc build. you need to have phpdocumentor globally installed):
phpdoc -d ./src -t ./docs/
```

#### Project_Structure
```
├── bootstrap.php
├── composer.json
├── composer.lock
├── executePHP.php
├── LICENSE
├── output
│   └── build
├── package.json
├── package-lock.json
├── public
│   ├── css
│   │   └── app.css
│   ├── imgs
│   │   └── GezinshuisRegterink_logo_breed.png
│   ├── index.php
│   └── js
│       ├── 404.js
│       ├── 404.js.map
│       ├── about.js
│       ├── about.js.map
│       ├── contact.js
│       ├── contact.js.map
│       ├── global.js
│       ├── global.js.map
│       ├── home.js
│       ├── home.js.map
│       ├── login.js
│       ├── login.js.map
│       ├── register.js
│       └── register.js.map
├── README.md
├── routes
│   └── web.php
├── run.js
├── sql
│   ├── db1.sql
│   ├── db2.sql
│   └── voorbeeldsql.sql
├── src
│   ├── controllers
│   │   ├── AboutController.php
│   │   ├── ContactController.php
│   │   ├── HomeController.php
│   │   ├── LoginController.php
│   │   ├── LogoutController.php
│   │   └── RegisterController.php
│   ├── core
│   │   ├── App.php
│   │   ├── Authentication.php
│   │   ├── BoundMethodWrapper.php
│   │   ├── Database.php
│   │   ├── ENV.php
│   │   ├── facades
│   │   │   ├── Auth.php
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
│   ├── interfaces
│   │   ├── IController.php
│   │   ├── IMiddleware.php
│   │   └── IRouter.php
│   └── middleware
│       └── ExampleMiddleware.php
├── views
│   ├── javascript
│   │   ├── 404
│   │   │   └── 404.js
│   │   ├── About
│   │   │   └── about.js
│   │   ├── Contact
│   │   │   └── contact.js
│   │   ├── global.js
│   │   ├── Home
│   │   │   └── home.js
│   │   ├── Login
│   │   │   └── login.js
│   │   └── Register
│   │       └── register.js
│   ├── layouts
│   │   └── app.php
│   ├── pages
│   │   ├── 404.php
│   │   ├── About.php
│   │   ├── Contact.php
│   │   ├── Home.php
│   │   ├── Login.php
│   │   └── Register.php
│   └── partials
│       ├── footer.php
│       └── nav.php
└── webpack.config.js
```
Command for re-generating the project structure (linux): `tree -I 'vendor|docs|cache|node_modules|samples|logogezinshuis'`


#### Packages
Packages used on the older branches are: 
<br/>No dependencies are used on the master branch.
```
phpdotenv
    this is used to handle .env file contents
blade
    this is used for 'rendering' a view
illuminate/database
    this is used for query building with Eloquents query builder (not used for modelling, just the query builder)
    see https://laravel.com/docs/5.7/queries
webpack
    used for compiling modern javascript so there's support for older browsers
    also nice for minifying and structurering the javascript setup
```

#### TODO
* ❌ give middleware the option to pass req/res via a cb function passed to said middleware
* ✅ add more comments
