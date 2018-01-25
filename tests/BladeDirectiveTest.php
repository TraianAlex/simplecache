<?php

use Vic\Laracache\BladeDirective;
use Vic\Laracache\RussianCaching;

class BladeDirectiveTest extends TestCase
{
    protected $doll;
    /** @test */
    function it_sets_up_the_opening_cache_directive()
    {
        $directive = $this->createNewCacheDirecive();
        $isCached = $directive->setUp($post = $this->makePost());
        $this->assertFalse($isCached);
        echo '<div>fragment</div>';
        $cachedFragment = $directive->tearDown();
        $this->assertEquals('<div>fragment</div>', $cachedFragment);
        $this->assertTrue($this->doll->has($post));
    }

    protected function createNewCacheDirecive()
    {
         $cache = new \Illuminate\Cache\Repository(
            new \Illuminate\Cache\ArrayStore
        );
        $this->doll = new RussianCaching($cache);
        return new BladeDirective($this->doll);
    }
}
