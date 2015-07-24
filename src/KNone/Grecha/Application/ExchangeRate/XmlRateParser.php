<?php

namespace KNone\Grecha\Application\ExchangeRate;

use KNone\Grecha\Domain\Model\ExchangeRate;

class XmlRateParser
{
    const DATE_STRING_FORMAT = 'd.m.Y';
    const URL_TEMPLATE = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=%s';
    const CODE_EURO = 'EUR';
    const CODE_DOLLAR = 'USD';

    /**
     * @param \DateTimeInterface $dateTime
     * @return ExchangeRate
     */
    public function getExchangeRateByDate(\DateTimeInterface $dateTime)
    {
        $usd = null;
        $eur = null;
        $simpeXmlElement = new \SimpleXMLElement($this->requestRateByDate($dateTime));
        foreach ($simpeXmlElement->Valute as $valute) {
            switch ($valute->CharCode) {
                case self::CODE_DOLLAR:
                    $usd = $this->parseFloat($valute->Value);
                    break;
                case self::CODE_EURO:
                    $eur = $this->parseFloat($valute->Value);
                    break;
            }
        }

        return new ExchangeRate($dateTime, $usd, $eur);
    }

    /**
     * @param string $value
     * @return float
     */
    private function parseFloat($value)
    {
        return (float)str_replace(',', '.', $value);
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @return string
     */
    private function requestRateByDate(\DateTimeInterface $dateTime)
    {
        $dateString = $dateTime->format(self::DATE_STRING_FORMAT);

        return file_get_contents($this->generateUrl($dateString));
    }

    /**
     * @param string $dateString
     * @return string
     */
    private function generateUrl($dateString)
    {
        return sprintf(self::URL_TEMPLATE, $dateString);
    }
}
