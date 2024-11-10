<?php

namespace Tests\Unit\Rules;

use App\Rules\EnglishName;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class EnglishNameTest extends TestCase
{
    public function test_correct_name(): void
    {
        $validator = Validator::make(['name' => 'Melody Holiday Inn'], ['name' => new EnglishName()]);

        $this->assertTrue($validator->passes());
    }

    public function test_name_with_symbol(): void
    {
        $validator = Validator::make(['name' => 'XXX Hostel.'], ['name' => new EnglishName()]);

        $this->assertFalse($validator->passes());
    }

    public function test_chinese_name(): void
    {
        $validator = Validator::make(['name' => '大安森林公園'], ['name' => new EnglishName()]);

        $this->assertFalse($validator->passes());
    }
}
