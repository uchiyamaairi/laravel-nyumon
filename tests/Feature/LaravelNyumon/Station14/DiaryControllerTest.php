<?php

namespace Tests\Feature\LaravelNyumon\Station14;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Diary;

class DiaryControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station14')]
    public function test_記事の一覧がJSONで返却される()
    {
        // テスト用のダミーデータを作成
        Diary::factory()->count(3)->create();

        // APIエンドポイントにGETリクエストを送信
        $response = $this->getJson('/api/diary');

        // レスポンスのステータスコードが200であることを確認
        $response->assertStatus(200);

        // レスポンスの構造を確認
        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'body',
                'created_at',
                'updated_at'
            ]
        ]);

        // 返されたデータ数が3であることを確認
        $this->assertCount(3, $response->json());
    }
}