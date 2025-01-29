<?php

namespace Tests\Feature\LaravelNyumon\Station10;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

class DiaryControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station10')]
    public function test_日記作成フォームが表示される()
    {
        $response = $this->get('/diary/create');

        $response->assertStatus(200);
        $response->assertViewIs('diary.create');
    }

    #[Test]
    #[Group('station10')]
    public function test_新しい日記を保存できる()
    {
        $diaryData = [
            'date' => date("Y-m-d"),
            'title' => 'テスト日記',
            'body' => 'これはテスト用の日記内容です。',
        ];

        $this->withoutMiddleware(ValidateCsrfToken::class);
        $response = $this->post('/diary', $diaryData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('diaries', $diaryData);
    }
}