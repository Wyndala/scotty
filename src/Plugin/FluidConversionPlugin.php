<?php
/**
 * Created by PhpStorm.
 * User: RalfMichael
 * Date: 29.10.2017
 * Time: 19:29
 */

namespace Wyndala\Scotty\Plugin;

use Symfony\Component\DomCrawler\Crawler;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class FluidConversionPlugin
{

    /**
     * @var Crawler
     */
    private $crawler;

    public function __construct()
    {

    }

    /**
     * @param $inputHtml string
     * @return string
     */
    public function process($inputHtml)
    {
        $this->crawler = HtmlPageCrawler::create($inputHtml);

        $this->crawler->filter('*')->each(function(HtmlPageCrawler $node) {
            if ($node->attr('property')) {
                $children = [];
                if ($node->children()->count() > 0) {
                    $children = $node->children();
                }

                $variableName = $node->attr('property');
                $node->text(sprintf('{%s}', $variableName));
                $node->removeAttr('property');

                $node->append($children);
            }

        });

        $fluidHtml = $this->crawler->saveHTML();

        return $fluidHtml;
    }
}