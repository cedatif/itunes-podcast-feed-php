<?php
/**
 * Created by PhpStorm.
 * User: ninoskopac
 * Date: 01/05/2018
 * Time: 23:32
 */
declare(strict_types=1);
namespace iTunesPodcastFeed\Tests;

use iTunesPodcastFeed\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private const Title = "Trump Says Disclosure of Mueller Questions in Russia Probe Is ‘Disgraceful’";
    private const File_Url = 'https://s3.read2me.online/audio/www-nytimes-com-2018-05-01-us-politics-trump-mueller-russia-questions-html-7e9601.mp3';
    private const Duration = '2:18';
    private const Description = 'WASHINGTON — President Trump on Tuesday said it was “disgraceful” that questions the special counsel would like to ask him were publicly disclosed, and he incorrectly noted that there were no questions about collusion. The president also said collusion was a “phony” crime.';
    private const Date = 1525177808;
    private const Filesize = 828387;
    private const Mime = 'audio/mpeg';

    public static function getItem(?string $guid = null, ?string $link = null): Item {
        return new Item(
            self::Title, self::File_Url, self::Duration,
            self::Description, self::Date, self::Filesize,
            self::Mime, $guid, $link
        );
    }

    public function testItem(): void {
        $item = static::getItem();
        $expected = file_get_contents(__DIR__ . '/fixtures/item.xml');
        $actual = $item->getXml();

        $this->assertEquals($expected, $actual);
    }

    public function testCustomGuid(): void {
        $item = static::getItem('foobar');
        $expected = file_get_contents(__DIR__ . '/fixtures/item-custom-guid.xml');
        $actual = $item->getXml();

        $this->assertEquals($expected, $actual);
    }

    public function testCustomLink(): void {
        $item = static::getItem(null, 'https://mysite.com/podcast/episodes/123');
        $expected = file_get_contents(__DIR__ . '/fixtures/item-custom-link.xml');
        $actual = $item->getXml();

        $this->assertEquals($expected, $actual);
    }
}