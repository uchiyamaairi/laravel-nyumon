<?php

namespace Tests\Feature\LaravelNyumon\Station13;

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
    #[Group('station13')]
    public function test_個別記事ページに削除ボタンが表示される()
    {
        // ダミーの日記データを作成
        $diary = Diary::factory()->create();

        // 個別ページにアクセス
        $response = $this->get("/diary/{$diary->id}");

        // ステータスコードが200であることを確認
        $response->assertStatus(200);

        // 削除ボタンが表示されていることを確認
        $response->assertSee('削除');
    }

    #[Test]
    #[Group('station13')]
    public function test_指定した記事が削除される()
    {
        // ダミーの日記データを作成
        $diary = Diary::factory()->create();
        $this->assertDatabaseHas('diaries', ['id' => $diary->id]);

        // 削除リクエストを送信
        $this->withoutMiddleware(ValidateCsrfToken::class);
        $response = $this->delete(route('diary.destroy', $diary));

        // データベースから削除されたことを確認
        $this->assertDatabaseMissing('diaries', ['id' => $diary->id]);

        // 一覧ページにリダイレクトされたことを確認
        $response->assertRedirect(route('diary.index'));
    }
}