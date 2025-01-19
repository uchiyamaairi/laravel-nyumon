<?php

namespace Tests\Feature\LaravelNyumon\Station4;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

class PracticeTest extends TestCase
{
    #[Test]
    #[Group('station4')]
    public function test_Practiceコントローラーが存在する(): void
    {
        $response = $this->assertFileExists(__DIR__ . '/../../../../app/Http/Controllers/PracticeController.php');
    }

    #[Test]
    #[Group('station4')]
    public function test_Practiceモデルが存在する(): void
    {
        $response = $this->assertFileExists(__DIR__ . '/../../../../app/Models/Practice.php');
    }

    #[Test]
    #[Group('station4')]
    public function test_Practiceビューが存在する(): void
    {
        $response = $this->assertFileExists(__DIR__ . '/../../../../resources/views/Practice.blade.php');
    }

}