<?php

namespace Tests\Unit\Rules;

use App\Rules\TitleCase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class TitleCaseTest extends TestCase
{
    public function test_correct_name(): void
    {
        $validator = Validator::make(['name' => 'Melody Holiday Inn'], ['name' => new TitleCase()]);

        $this->assertTrue($validator->passes());
    }

    public function test_name_with_abbreviation(): void
    {
        $validator = Validator::make(['name' => 'UCLA Hostel'], ['name' => new TitleCase()]);

        $this->assertTrue($validator->passes());
    }

    public function test_name_without_space(): void
    {
        $validator = Validator::make(['name' => 'DaanHostel'], ['name' => new TitleCase()]);

        $this->assertFalse($validator->passes());
    }

    public function test_name_all_lower_case(): void
    {
        $validator = Validator::make(['name' => 'melody holiday inn'], ['name' => new TitleCase()]);

        $this->assertFalse($validator->passes());
    }
}
