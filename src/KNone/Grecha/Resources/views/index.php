<?php
/** @var $price \KNone\Grecha\Entity\Price */
/** @var $exchanger \KNone\Grecha\ExchangeRate\Exchanger */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Гречка Тудэй | Сколько стоит гречка сегодня? #grechkatoday #гречкатудэй</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
    <meta name="keywords"
          content="гречка, греча, курс гречи, килограмм гречки, гречневая крупа, стоимость гречки, grechkatoday, grechka, гручка тудэй, гречка сегодня"/>
    <meta name="description" content="Сколько стоит гречка сегодня на прилавках российских магазинов"/>
    <link rel="icon" type="image/png" href="favicon.png"/>
</head>
<body>
<div class="k-layout">
    <div class="k-currency">
        <p class="k-currency-amount"><?= $price->getValue() ?> руб.</p>

        <p class="k-currency-date"><?= $price->getDateTime()->format('d.m.Y') ?></p>

        <p class="k-currency-any"><?= $exchanger->exchangeToUsd($price->getValue()) ?>$
            <?= $exchanger->exchangeToEur($price->getValue()) ?>€</p>
    </div>
    <div class="yashare-auto-init k_social" data-yashareL10n="ru" data-yashareType="small"
         data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"
         data-yashareTheme="counter"></div>
    <div class="k-contact"><a class="k-contact-link" href="mailto:grechka@knone.ru"
                              title="По всем вопросам пишите письма">grechka@knone.ru</a></div>
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
</body>
</html>