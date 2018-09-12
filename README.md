<h1 align="center">Project 1 gezinshuis</h1>
<h3 align="center">Made by: Tuan, Mick, Romy Mae, Ricardo en Thomas</h3>

#### Project_Structure
```
    // Used for autoloading / bootstrapping things
├── bootstrap.php
│    // Cache used by Twig when compiling templates
├── cache
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
│   ├── ExampleController.php
│   └── interfaces
│       └── IController.php
│   // The views directory used by Twig
└── views
    └── index.twig
```
Command for re-generating the project structure (linux): `tree -I vendor`


#### Packages
Packages used in this project are
```
phpdotenv
    his is used to handle .env file contents
twig
    this is used for 'rendering' a view
```
