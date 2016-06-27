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
  - Multi Language System
  - and so on

Goals:
  - very flexible
  - very fast / high performance
  - easy extensible (with plugins and so on)
  - easy to use
  - SEO (for higher levels)
  - and so on

Still work in progress!

## How To use
Download / copy all this files. All files in directory "lib" are required.
Your scripts have to include lib/init.php, an autoloader will be added automatically.

## Requirements
  - PHP 7.0.7+ (it can also still work under PHP 5.4, but i cannot guarantee for this)
  - MySQL 5.7+

## File permissions
  - chmod 755 /framework/cache
  - chmod 755 /framework/lib/store
  - chmod 755 /framework/store
