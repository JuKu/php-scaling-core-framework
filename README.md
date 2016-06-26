# php-scaling-core-framework
an small php framework for creating better scalable Web applications in php.

As an developer from contentlion.org (currently Contentlion is an little bit outdated), i wanted to create an little small framework which can be used for many scalable php systems, for example CMS and so on.

Planned Features:
  - nice Api for Caching on high level, so your application dont have to know something about caching mechanism
    - File Cache
    - Memcache
    - Hazelcast Cache
    - Other caches can be added also
  - small Database Management (Connection, Instances and Updates)
  - Distributed session management (for scaling out)
  - and so on

Still work in progress!

## How To use
Download / copy all this files. All files in directory "lib" are required.
Your scripts have to include lib/init.php, an autoloader will be added automatically.
