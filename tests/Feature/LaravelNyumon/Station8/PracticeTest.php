<?php

namespace Tests\Feature\LaravelNyumon\Station8;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class PracticeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station8')]
    public function test_diariesテーブルが存在する()
    {
        $this->assertTrue(Schema::hasTable('diaries'));
    }

    #[Test]
    #[Group('station8')]
    public function test_diariesテーブルにカラムが存在する()
    {
        $this->assertTrue(
            Schema::hasColumns('diaries', [
                'id',
                'date',
                'title',
                'body',
                'created_at',
                'updated_at'
            ])
        );
    }

    #[Test]
    #[Group('station8')]
    public function test_diariesテーブルのカラムの型が正しい()
    {
        $columns = Schema::getColumnListing('diaries');

        $this->assertEquals('bigint', Schema::getColumnType('diaries', 'id'));
        $this->assertEquals('date', Schema::getColumnType('diaries', 'date'));
        $this->assertEquals('varchar', Schema::getColumnType('diaries', 'title'));
        $this->assertEquals('text', Schema::getColumnType('diaries', 'body'));
        $this->assertEquals('timestamp', Schema::getColumnType('diaries', 'created_at'));
        $this->assertEquals('timestamp', Schema::getColumnType('diaries', 'updated_at'));
    }
}