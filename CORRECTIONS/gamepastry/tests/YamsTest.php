<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use App\Service\Yams;

class YamsTest extends TestCase
{
    private $yams;
    public function setUp(): void
    {
        $this->yams = new Yams();
    }
    public function testArrayUnique(): void
    {
        $data = [1, 2, 3, 1];

        $data = array_unique($data);

        $this->assertSame(count($data), 3);
    }

    public function testIsSquare(): void
    {

        $this->assertTrue($this->yams->isSquare([1, 1, 1, 1, 2,]));
        $this->assertTrue($this->yams->isSquare([2, 2, 2, 2, 3,]));
        $this->assertTrue($this->yams->isSquare([3, 3, 3, 3, 4]));
        $this->assertTrue($this->yams->isSquare([4, 4, 4, 4, 5]));
        $this->assertTrue($this->yams->isSquare([5, 5, 5, 5, 6]));
        $this->assertTrue($this->yams->isSquare([6, 6, 6, 6, 1]));
    }


    public function testIsYams(): void
    {
        $this->assertTrue($this->yams->isYams([1, 1, 1, 1, 1]));
        $this->assertTrue($this->yams->isYams([2, 2, 2, 2, 2]));
        $this->assertTrue($this->yams->isYams([3, 3, 3, 3, 3]));
        $this->assertTrue($this->yams->isYams([4, 4, 4, 4, 4]));
        $this->assertTrue($this->yams->isYams([5, 5, 5, 5, 5]));
        $this->assertTrue($this->yams->isYams([6, 6, 6, 6, 6]));
    }

    public function testIsNotYams(): void
    {
        $this->assertFalse($this->yams->isYams([1, 2, 1, 1, 1]));
        $this->assertFalse($this->yams->isYams([1, 1, 3, 1, 1]));
        $this->assertFalse($this->yams->isYams([1, 1, 1, 4, 1]));
        $this->assertFalse($this->yams->isYams([1, 1, 1, 1, 5]));
        $this->assertFalse($this->yams->isYams([1, 1, 1, 1, 6]));
        $this->assertFalse($this->yams->isYams([11, 2, 3, 4, 5]));

    }


    public function testIsLargeStraight(): void
    {
        $this->assertTrue($this->yams->isLargeStraight([1, 2, 3, 4, 5]));
        $this->assertTrue($this->yams->isLargeStraight([2, 3, 4, 5, 6]));
        $this->assertFalse($this->yams->isLargeStraight([1, 1, 2, 2, 3]));
        $this->assertFalse($this->yams->isLargeStraight([5, 2, 1, 6, 4]));
    }

    public function testPlayDices(): void
    {
        $dices = $this->yams->playDices();

        $this->assertSame(count($dices), 5);
    }
}
