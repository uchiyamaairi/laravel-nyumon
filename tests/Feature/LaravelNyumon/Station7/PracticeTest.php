<?php

namespace Tests\Feature\LaravelNyumon\Station7;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

class PracticeTest extends TestCase
{
    #[Test]
    #[Group('station7')]
    public function test_indexビューが存在する(): void
    {
        $response = $this->assertFileExists(__DIR__ . '/../../../../resources/views/diary/index.blade.php');
    }

    #[Test]
    #[Group('station7')]
    public function test_indexビューに変数が定義されている(): void
    {
        $view = $this->view('diary.index', ['name' => 'Laravel']);
        $view->assertSee('Laravel');
    }

    #[Test]
    #[Group('station7')]
    public function test_Routerを通じてHelloLaravelと表示する(): void
    {
        $response = $this->get('/diary');
        $response->assertStatus(200);
        $response->assertSeeText('Hello, Laravel');
    }
}