<?php

namespace KNone\Grecha\Application\Price;

use Symfony\Component\DomCrawler\Crawler;

class Parser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function getByDate(\DateTimeInterface $date)
    {
        $url = $this->buildUrl($date);
        $html = $this->getHtml($url);
        $selector = $this->getSelector();

        $crawler = $this->getCrawler($html)
            ->filter($selector)
            ->reduce(function (Crawler $node, $i) {
                static $skipStep = false;
                //skip trash data
                if ($i < 3) {
                    return false;
                }

                if (!$skipStep) {
                    //Skip ads
                    if ($node->attr('id') !== null) {
                        return false;
                    }
                    //end day
                    if ($node->attr('valign') !== null) {

                        $value = $node->filter('td > b')->text();

                        if (empty($value)) {
                            return false; //skip
                        } else {
                            $skipStep = true;

                            return false; //end day data block
                        }
                    }

                    $value = $node->filter('td[bgcolor="#f8f0e8"]')->text();

                    if ($this->checkValue($value)) {
                        return true;
                    }
                }

                return false;
            });

        $prices = $crawler->each(function (Crawler $node, $i) {
            return $node->filter('td[bgcolor="#f8f0e8"]')->text();
        });

        return $prices;
    }

    /**
     * @param string $html
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    protected function getCrawler($html)
    {
        return new Crawler($html);
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return 'http://doska.zol.ru/Grechka/grechka.html/';
    }

    /**
     * @param  \DateTimeInterface $date
     * @return string
     */
    protected function buildUrl(\DateTimeInterface $date)
    {
        $params = $this->getUrlQueryParam();
        $params['date'] = $date->format($this->getDateFormat());

        return $this->getUrl() . '?' . http_build_query($params);
    }

    /**
     * @return string
     */
    protected function getDateFormat()
    {
        return 'Y-m-d';
    }

    /**
     * @return array
     */
    protected function getUrlQueryParam()
    {
        return [
            'sell' => 'on',
            'nearby_regions' => 'On',
            'nearby_countries' => 'On',
            'without_exact_fo' => 'On',
        ];
    }

    /**
     * @return string
     */
    protected function getSelector()
    {
        return '#table_offers > tr';
    }

    /**
     * @param  string $url
     * @return string
     */
    protected function getHtml($url)
    {
        return file_get_contents($url);
    }

    /**
     * @param  mixed $value
     * @return bool
     */
    protected function checkValue($value)
    {
        return !empty($value) && $value > 10 && $value < 200;
    }
}
