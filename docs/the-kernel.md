# The Kernel

## General definition

In computer engineering, The kernel is a computer program at the core of a computer's operating system and generally has complete control over everything 
in the system. It is the portion of the operating system code that is always resident in memory and facilitates interactions between hardware and software components.

## Symfony Framework's definition:

The Kernel is the core of Symfony. It is responsible for setting 
up all the bundles used by your application and providing them 
with the application's configuration. It then creates the 
service container before serving requests in its handle() method.

## Our framework's definition:

The kernel is the core of our framework. It exists in a global scope, ready to be accessed by your application. It is primarily responsible for the booting process - during which the $_ENV variable is populated with data from the `.env` properties file, sharable libraries and helpers are loaded. It  provides an interface to your application's front controller to route requests to one or more child applications.

## Responsibilities

Responsibilities application-level filtering and authorization.
-- Filters which application the HTTP request should be passed to.
-- Filters if the HTTP request should be passed through or revoked.

## What I've learned
- Bootstrap runs before applications
- Bootstrap may invoke the init function of various classes
- Bootstrap is like loading the gun, run is like pulling the trigger 