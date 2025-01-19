<?php

namespace Tests\Feature\LaravelNyumon\Station3;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

class PracticeTest extends TestCase
{
    #[Test]
    #[Group('station3')]
    public function test_LaravelのデフォルトTOPページが表示される(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('Laravel');
    }
}
