 Pasta de C:\xampp\htdocs\Projects\api

10/04/2020  10:35    <DIR>          .
10/04/2020  10:35    <DIR>          ..
24/02/2020  21:27             1.873 .gitignore
24/02/2020  21:27    <DIR>          app
24/02/2020  21:27             1.086 composer.json
24/02/2020  21:27             7.681 contributing.md
24/02/2020  21:27             3.228 env
24/02/2020  21:27             1.084 LICENSE
24/02/2020  21:27             1.159 license.txt
24/02/2020  21:27             2.121 phpunit.xml.dist
24/02/2020  21:27    <DIR>          public
24/02/2020  21:27             2.689 README.md
24/02/2020  21:27             1.868 spark
24/02/2020  21:27    <DIR>          system
24/02/2020  21:27    <DIR>          tests
24/02/2020  21:27    <DIR>          writable
               9 arquivo(s)         22.789 bytes
               7 pasta(s)   41.168.740.352 bytes disponíveis

# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).

This repository holds the distributable version of the framework,
including the user guide. It has been built from the 
[development repository](https://github.com/codeigniter4/CodeIgniter4).

**This is pre-release code and should not be used in production sites.**

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/). 


## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!
The user guide updating and deployment is a bit awkward at the moment, but we are working on it!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script. 
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/contributing.md) section in the development repository.

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
