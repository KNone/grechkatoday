<?php
/** @var $pricePresenter \KNone\Grecha\ViewModel\PricePresenter */
/** @var $debug boolean */
/** @var $helper \KNone\Grecha\View\Helper */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Гречка Тудэй | Сколько стоит гречка сегодня?</title>
        <meta name="keywords" content="гречка, греча, курс гречи, килограмм гречки, гречневая крупа, стоимость гречки, grechkatoday, grechka, гручка тудэй, гречка сегодня, доллар, евро"/>
        <meta name="description" content="Сколько стоит гречка сегодня на прилавках российских магазинов. Курс гречки по отношению в рублю, доллару и евро."/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="wrapper">
            <div class="space"></div>
            <div class="logo">
                <div class="logo__date"><?=date('F j')?><sup class="logo__date-ending"><?=$helper->getDateEnds()?></sup></div>
            </div>
            <div class="price">
                <div class="price-star">
                    <span class="star-icon">*</span>
                </div>
                <div class="price-value">
                    <div class="price-value-first">
                        <span class="cost<?=$pricePresenter->getDifferenceInRubles()>0?' cost_up':' cost_down'?>"><?=$pricePresenter->getRubles()?></span>
                        <span class="symbol">p</span>
                    </div>
                    <div class="price-value-second">
                        <span class="diff"><?=$pricePresenter->getDifferenceInRublesFormatted()?></span>
                        <span class="currency"><?=$pricePresenter->getDollars()?>$ <?=$pricePresenter->getEuro()?>€</span>
                    </div>
                </div>
            </div>
            <div class="charts">
                <div class="charts-area">
                    <canvas id="chart-canvas" width="410" height="200"></canvas>
                </div>
                <div class="charts-controls">
                    <ul>
                        <li><a class="chart-button-week" href="#">неделя</a></li>
                        <li><a class="chart-button-month" href="#">месяц</a></li>
                    </ul>
                </div>
            </div>
            <div class="ads"></div>
            <div class="footer">
                <div class="yashare-auto-init social" data-yashareL10n="ru" data-yashareType="none"
         data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"></div>
                <div class="contacts"><a class="k-contact-link" href="mailto:grechka@knone.ru" title="По всем вопросам пишите письма">grechka@knone.ru</a></div>
            </div>
        </div>
        <script <?= ($debug ? 'data-main="js/app"' : 'data-main="js/scripts"') ?> src="js/lib/require.js"></script>
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
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </body>
</html>