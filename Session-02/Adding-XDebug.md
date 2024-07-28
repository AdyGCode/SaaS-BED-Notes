---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../images/Black-Red-Banner.svg)"
auto-scaling: true
size: 4k
color: "#ccc"
backgroundColor: "#060606"
tags: SaaS, APIs, Back-End

date created: 03 July 2024
date modified: 07 July 2024
---

# Adding XDebug

![[Adding-XDebug-20240719134756048.png]]

```table-of-contents
title: # Contents
style: nestedList
minLevel: 0
maxLevel: 0
includeLinks: true
```

# What is XDebug

XDebug is an extension for [PHP](https://php.net/), and provides a range of features to improve the PHP development experience.

[Step Debugging](https://xdebug.org/docs/step_debug)

A way to step through your code in your IDE or editor while the script is executing.

[Improvements to PHP's error reporting](https://xdebug.org/docs/develop)

An improved `[var_dump()](https://xdebug.org/docs/develop#display)` function, stack traces for Notices, Warnings, Errors and Exceptions to highlight the code path to the error

[Tracing](https://xdebug.org/docs/trace)

Writes every function call, with arguments and invocation location to disk. Optionally also includes every variable assignment and return value for each function.

[Profiling](https://xdebug.org/docs/profiler)

Allows you, with the help of visualisation tools, to analyse the performance of your PHP application and find bottlenecks.

[Code Coverage Analysis](https://xdebug.org/docs/code_coverage)

To show which parts of your code base are executed when running unit tests with PHPUnit.

> This was taken from the XDebug home page.

# Installing XDebug into Laragon

The details at <https://xdebug.org/docs/install> are a little difficult to follow, so here is a simple step by step set of instructions to help when installing with Laragon on Windows.

For other systems, you will need to follow the instructions on the XDebug home page, or find a suitable article describing the steps.

## Download

Locate the most current (not alpha) version of XDebug, and download the required DLLs from <https://github.com/xdebug/xdebug/releases>.

At time of writing this was version 3.3.2.

You will see an Assets item int he summary, clicking this will expand the list and allow you to click on the required DLL for downloading.

Here are also direct links for some versions of PHP.

| PHP Version | Link to XDebug DLL                                                                                                            |
| ----------- | ----------------------------------------------------------------------------------------------------------------------------- |
| 8.0         | [php_xdebug-3.3.2-8.0-vs16-x86_64](https://github.com/xdebug/xdebug/releases/download/3.3.2/php_xdebug-3.3.2-8.0-vs16-x86_64) |
| 8.1         | [php_xdebug-3.3.2-8.1-vs16-x86_64](https://github.com/xdebug/xdebug/releases/download/3.3.2/php_xdebug-3.3.2-8.1-vs16-x86_64) |
| 8.2         | [php_xdebug-3.3.2-8.2-vs16-x86_64](https://github.com/xdebug/xdebug/releases/download/3.3.2/php_xdebug-3.3.2-8.2-vs16-x86_64) |
| 8.3         | [php_xdebug-3.3.2-8.3-vs16-x86_64](https://github.com/xdebug/xdebug/releases/download/3.3.2/php_xdebug-3.3.2-8.3-vs16-x86_64) |
| 8.4         | n/a - PHP 8.4 was in Beta at time of writing                                                                                  |

## Add XDebug to PHP in Laragon

1. Open Windows File Explorer (<kbd>WIN</kbd>+<kbd>E</kbd>) 
2. Navigate to the `Downloads` folder, and locate the newly downloaded DLL
3. Open a second Windows File Explorer  (<kbd>WIN</kbd>+<kbd>E</kbd>) 
4. In the address bar, type in `%ProgramData%` 
   (if on a PC in 3-06, or at home then `C:\` will be the default.)
5. Navigate to the `Laragon` :FasArrowRightLong: `bin` :FasArrowRightLong: `PHP` folder
6. For each version of PHP installed you will now go into the folder and locate the `ext` folder
7. Copy or move the correct DLL from the `Downloads` folder into this location
8. Make sure the DLL contains .dll at the end. Eg. php_xdebug-3.3.2-8.3-vs16-x86_64`.dll`

Repeat the steps 4-8 for the other versions of PHP as needed.

## Enable Extension

Enable XDebug by right click on the Laragon task-bar icon (or the Laragon window).

Then select `PHP` -->  `Extensions` --> click `xdebug-2.5.5...`  to enable it.

Access in your browser the file you created in step 1, make sure that it shows XDebug installed.

Open `php.ini` --> locate to the 'Dynamic Extensions' section (<kbd>ctrl</kbd>+<kbd>F</kbd>)
--> after ';extension=zip', add:

```ini
zend_extension=xdebug
zend_extension=php_xdebug-3.3.2-8.3-vs16-x86_64.dll
```

then at the bottom of the file, add:

```ini
[XDebug]
xdebug.profiler_enable = 1
xdebug.profiler_output_dir = "C:\\laragon\\www\\xdebug"
```

Next, create the folder `c:\laragon\www\xdebug` (or `c:\ProgramData\Laragon\www\xdebug` on TAFE systems).

> IMPORTANT: make sure that this directory exists. This is where all data will be logged.
   
For additional functions, see this link: <https://xdebug.org/docs/profiler

Make sure to restart Laragon (either quite the application completely and restart it, or use the Stop/Start all sequence) for changes to take effect. 

To check if XDebug has been installed successfuly by click <kbd>Web tab</kbd> --><kbd>info</kbd>

Basically XDebug creates a file which contains all the information that it profiled on your web page/application. 

You can use a tool called [QCacheGrind](https://xdebug.org/docs/profiler) to display the results in a much easier to understand graphical interface.

# XDebug and IDEs

XDebug can be used in conjunction with a number of IDEs. Below we dhow how to do so with PhpStorm.

An article is linked, but we do not guarantee it being correct or up to date, for VSCode.

## XDebug and PhpStorm

TODO: Add link to instructions to configure PhpStorm

## XDebug and VSCode

See here: <https://processwire.com/talk/topic/19089-how-to-use-xdebug-with-laragon-vscode/>


