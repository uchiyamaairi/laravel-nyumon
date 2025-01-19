<?php

namespace Tests\Feature\LaravelNyumon\Station5;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

class PracticeTest extends TestCase
{
    #[Test]
    #[Group('station5')]
    public function test_Helloと表示する(): void
    {
        $response = $this->get('/diary');
        $response->assertStatus(200);
        $response->assertSeeText('Hello!');
    }
}