<?php
/**
 * Created by PhpStorm.
 * User: RalfMichael
 * Date: 29.10.2017
 * Time: 19:25
 */

namespace Wyndala\Scotty\Tests\Plugin;

use PHPUnit\Framework\TestCase;
use Wa72\HtmlPageDom\HtmlPageCrawler;
use Wyndala\Scotty\Plugin\FluidConversionPlugin;

class FluidConversionPluginTest extends TestCase
{
    public function testSimpleConversionFromHtmlToFluid()
    {
        $fixtureHtml = file_get_contents(__DIR__ . '/../Fixtures/Input/SimpleTest.html');
        $expectedHtml = file_get_contents(__DIR__ . '/../Fixtures/Output/SimpleFluidTest.html');
        $fixtureHtml = trim(preg_replace('/\s\s+/', '', $fixtureHtml));
        $expectedHtml = trim(preg_replace('/\s\s+/', '', $expectedHtml));

        $plugin = new FluidConversionPlugin();
        $outputHtml = $plugin->process($fixtureHtml);

        $this->assertEquals($expectedHtml, html_entity_decode($outputHtml));
    }
}