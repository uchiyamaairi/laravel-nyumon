<?php

namespace Tests\Feature\LaravelNyumon\Station12;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Diary;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;


class DiaryControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station12')]
    public function test_編集用のページが表示される()
    {
        // テスト用の日記データを作成
        $diary = Diary::factory()->create();

        // 編集ページにアクセス
        $response = $this->get("/diary/{$diary->id}/edit");

        // ステータスコードが200であることを確認
        $response->assertStatus(200);

        // 編集ページに必要な要素が含まれていることを確認
        $response->assertSee($diary->title);
        $response->assertSee($diary->body);
        $response->assertSee('更新する');
    }

    #[Test]
    #[Group('station12')]
    public function test_日記が更新される()
    {
        // テスト用の日記データを作成
        $diary = Diary::factory()->create();

        // 更新用のデータを準備
        $updatedData = [
            'title' => '更新タイトル',
            'body' => '更新する文面',
        ];

        // 更新リクエストを送信
        $this->withoutMiddleware(ValidateCsrfToken::class);
        $response = $this->patch("/diary/{$diary->id}", $updatedData);

        // リダイレクトされることを確認
        $response->assertStatus(302);

        // データベースが更新されていることを確認
        $this->assertDatabaseHas('diaries', [
            'id' => $diary->id,
            'title' => '更新タイトル',
            'body' => '更新する文面',
        ]);

        // 更新成功メッセージが表示されることを確認
        $response->assertSessionHas('message', '更新しました');
    }
}