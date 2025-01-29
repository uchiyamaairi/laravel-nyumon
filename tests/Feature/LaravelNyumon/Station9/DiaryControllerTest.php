<?php

namespace Tests\Feature\LaravelNyumon\Station9;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Diary;

class DiaryControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station9')]
    public function test_日記一覧を表示できる()
    {
        // テスト用の日記エントリーを作成
        $diary1 = Diary::factory()->create([
            'date' => date("Y-m-d"),
            'title' => '今日の出来事',
            'body' => '今日は晴れでした。'
        ]);
        $diary2 = Diary::factory()->create([
            'date' => date("Y-m-d"),
            'title' => '明日の予定',
            'body' => '明日は雨の予報です。'
        ]);

        // /diary にGETリクエストを送信
        $response = $this->get('/diary');

        // レスポンスが正常であることを確認
        $response->assertStatus(200);

        // ビューが正しいことを確認
        $response->assertViewIs('diary.index');

        // 作成した日記エントリーがビューに含まれていることを確認
        $response->assertSee($diary1->title);
        $response->assertSee($diary2->title);
    }
}