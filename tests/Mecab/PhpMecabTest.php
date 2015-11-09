<?php

namespace Limelight\Tests\Classes;

use Limelight\Tests\TestCase;
use Limelight\Mecab\PhpMecab\PhpMecab;

class PhpMecabTest extends TestCase
{
    /**
     * @var Limelight\Limelight
     */
    protected static $phpmecab;

    /**
     * Set static limelight on object.
     */
    public static function setUpBeforeClass()
    {
        self::$phpmecab = new PhpMecab([]);
    }

    /**
     * Class can be instantiated.
     *
     * @test
     */
    public function it_can_be_instantiated()
    {
        $phpmecab = new PhpMecab([]);

        $this->assertInstanceOf('Limelight\Mecab\PhpMecab\PhpMecab', $phpmecab);
    }

    /**
     * It can perform mecab parseToNode().
     *
     * @test
     */
    public function it_can_perform_mecab_parseToNode_method()
    {
        $nodes = self::$phpmecab->parseToNode('大丈夫');

        $expected = [
            'BOS/EOS,*,*,*,*,*,*,*,*',
            '名詞,形容動詞語幹,*,*,*,*,大丈夫,ダイジョウブ,ダイジョーブ',
            'BOS/EOS,*,*,*,*,*,*,*,*',
        ];

        $this->assertNodeResult($nodes, $expected);
    }

    /**
     * It can perform mecab parseToString().
     *
     * @test
     */
    public function it_can_access_mecab_parseToString_method()
    {
        $results = self::$phpmecab->parseToString('美味しい');

        $this->assertContains('形容詞,自立,*,*,形容詞・イ段,基本形,美味しい,オイシイ,オイシイ', $results);
    }

    /**
     * It can perform mecab split().
     *
     * @test
     */
    public function it_can_access_mecab_split_method()
    {
        $results = self::$phpmecab->split('めっちゃ眠い。');

        $this->assertEquals('めっちゃ', $results[0]);

        $this->assertEquals('眠い', $results[1]);

        $this->assertEquals('。', $results[2]);
    }
}