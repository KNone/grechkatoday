<?php
/** @var $price \KNone\Grecha\Entity\Price */
/** @var $exchanger \KNone\Grecha\ExchangeRate\ExchangeRateConverter */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Гречка Тудэй | Сколько стоит гречка сегодня? #grechkatoday #гречкатудэй</title>
    <meta name="keywords"
          content="гречка, греча, курс гречи, килограмм гречки, гречневая крупа, стоимость гречки, grechkatoday, grechka, гручка тудэй, гречка сегодня"/>
    <meta name="description" content="Сколько стоит гречка сегодня на прилавках российских магазинов"/>
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.png"/>
</head>
<body>
<div class="k-layout">
    <div class="k-currency">
        <div class="k-offer">
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:50px"
                 data-ad-client="ca-pub-1797214625818644"
                 data-ad-slot="7404976380"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div class="k-currency-amount">
            <?= $price->getValue() ?> <i class="fa fa-rub"></i>
            <span class="k-price_star">*</span>

            <div class="k-price_info">
                Среднее значение цены по оптовым предложениям гречневой крупы с наценкой розничного коэффициента.
            </div>
        </div>

        <div class="k-currency-date"><?= $price->getDateTime()->format('d.m.Y') ?></div>

        <div class="k-currency-any">
            <?= $exchanger->convertRoublesToUsd($price->getValue()) ?>$
            <?= $exchanger->convertRoublesToEur($price->getValue()) ?>€
        </div>
    </div>
    <div class="yashare-auto-init k-social" data-yashareL10n="ru" data-yashareType="none"
         data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"></div>
    <div class="k-contact"><a class="k-contact-link" href="mailto:grechka@knone.ru"
                              title="По всем вопросам пишите письма">info@grechkatoday.ru</a></div>
</div>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-57431312-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');
</script>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</body>
</html>
