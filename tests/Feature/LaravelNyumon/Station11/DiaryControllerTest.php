<?php

namespace Tests\Feature\LaravelNyumon\Station11;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Diary;

class DiaryControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station11')]
    public function test_個別記事が表示される()
    {
        // テスト用の日記エントリーを作成
        $diary = Diary::factory()->create([
            'date' => date("Y-m-d"),
            'title' => 'テスト日記',
            'body' => 'これはテスト用の日記内容です。',
        ]);

        // /diary/1 にアクセス
        $response = $this->get("/diary/{$diary->id}");

        // レスポンスが成功していることを確認
        $response->assertStatus(200);

        // 日記のタイトルと内容が表示されていることを確認
        $response->assertSee($diary->title);
        $response->assertSee($diary->content);

        // 他の日記エントリーが表示されていないことを確認
        $otherDiary = Diary::factory()->create();
        $response->assertDontSee($otherDiary->title);
    }
}