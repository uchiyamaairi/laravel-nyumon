<?php

namespace Tests\Feature\LaravelNyumon\Station6;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

class PracticeTest extends TestCase
{
    #[Test]
    #[Group('station6')]
    public function test_Diaryコントローラーが存在する(): void
    {
        $response = $this->assertFileExists(__DIR__ . '/../../../../app/Http/Controllers/DiaryController.php');
    }

    #[Test]
    #[Group('station6')]
    public function test_indexメソッドが存在する(): void
    {
        $controller = new \App\Http\Controllers\DiaryController();
        $response = $controller->index();
        $this->assertEquals('Hello, Controller!', $response);
    }

    #[Test]
    #[Group('station6')]
    public function test_Routerを通じてHelloControllerと表示する(): void
    {
        $response = $this->get('/diary');
        $response->assertStatus(200);
        $response->assertSeeText('Hello, Controller!');
    }
}