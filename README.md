# php-scaling-core-framework
an small php framework for creating better scalable Web applications in php.

*Current Version: 0.0.1* (Pre-Alpha)

As an developer from contentlion.org (currently Contentlion is an little bit outdated), i wanted to create an little small framework which can be used for many scalable php systems, for example CMS and so on.

Planned Features:
  - nice Api for Caching on high level, so your application dont have to know something about caching mechanism
    - File Cache
    - Memcache
    - Hazelcast Cache
    - Other caches can be added also
  - small Database Management (Connection, Instances and Updates)
  - Distributed session management (for scaling out)
  - Event / Hook System
  - Mobile Detection
  - Multi Domain Support
  - User Counter / Statistics
  - Intelligent HTTP Caching
  - Multi Language System
  - and so on

Goals:
  - very flexible
  - very fast / high performance
  - easy extensible (with plugins and so on)
  - easy to use
  - help to build secure applications as possible (against SQL Injections, SSRF, CSRF attacks and so on)
  - SEO (for higher levels)
  - and so on

Still work in progress!

## How To use
Download / copy all this files. All files in directory "framework" are required, all other files are only optional.
Your scripts have to include framework/lib/init.php, an autoloader will be added automatically.

## Scale out
This Framework is designed to scale out very easily, but there are a few things, you have to attend:
  - you cannot use file caching on first
  - if you can, use and CDN (content delivery network) to distribute static files like images
  
In the best case you use an load balancer with persistence session, so the same client will routed to same web server (if this webserver is available).
You can use haproxy (haproxy.com) as proxy server.

Links:
  - http://blog.haproxy.com/2012/03/29/load-balancing-affinity-persistence-sticky-sessions-what-you-need-to-know/
  - https://www.digitalocean.com/community/tutorials/how-to-use-haproxy-to-set-up-http-load-balancing-on-an-ubuntu-vps
  - https://www.howtoforge.com/tutorial/ubuntu-load-balancer-haproxy/

## Requirements
  - PHP 7.0.7+ (it can also still work under PHP 5.4, but i cannot guarantee for this)
  - MySQL 5.7+
  
  optional:
  - memcached 2.0.0+ (for faster caching and file I/O optimization)

## File permissions
  - chmod 755 /framework/cache
  - chmod 755 /framework/lib/store
  - chmod 755 /framework/store
  
## Databases
By default mysql database is supported, but you can also use some other relational databases with SQL queries, if you have an driver for this.

This databases are supported by default:
  - MySQL 5.7+
  - PostgreSQL (Not implemented yet)
  
## Caching
There are 2 cache levels:
  - first level cache (e.q. for sessions)
  - second level cache (for database query caches and so on)
  
For each cache level you can set another cache handler (optional).

This framework supports some types of cache handlers and you can extend other caching types with plugins:
  - File Cache (default, but cannot used if you want to scale out)
  - memcache
  - memcached (isnt the same as memcache! Use memcached, if its possible, because memcached is faster)
  - Hazelcast (http://hazelcast.org) cache (Work in progress, not implemented yet)
  - Redis (Work in progress, not implemented yet)
