<?php

namespace Vic\Laracache;

class BladeDirective
{
     protected $keys = [];

     protected $cache;

     public function __construct(RussianCaching $cache)
     {
         $this->cache = $cache;
     }

    public function setUp($model)
    {
        //if (static::shouldCache()) {
            ob_start();
            $this->keys[] = $key = $model->getCacheKey();
            return $this->cache->has($key);
        //}
    }

    public function tearDown()
    {
        //if (static::shouldCache()) {
            return $this->cache->put(array_pop($this->keys), ob_get_clean());
        //}
    }

     public static function shouldCache()
    {
       return ! app()->environment('local');// ! app()->environment('local') for local
    }
}
