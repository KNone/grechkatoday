<?php
/** @var $pricePresenter \KNone\Grecha\ViewModel\PricePresenter */
/** @var $debug boolean */
/** @var $helper \KNone\Grecha\View\Helper */
?>
<!DOCTYPE html>
<html lang="ru" id="nojs" xml:lang="ru">
<head>
    <meta charset="utf-8">
    <title>Гречка Тудэй | Сколько стоит гречка сегодня?</title>
    <meta name="keywords"
          content="гречка, греча, курс гречи, килограмм гречки, гречневая крупа, стоимость гречки, grechkatoday, grechka, гручка тудэй, гречка сегодня, доллар, евро"/>
    <meta name="description"
          content="Сколько стоит гречка сегодня на прилавках российских магазинов. Курс гречки по отношению в рублю, доллару и евро."/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE ]>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <![endif]-->
    <script type="text/javascript">document.documentElement.id = "js";</script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" media="screen" href="css/templates-styles.css"/>
</head>
<body>
<div class="b-page">
    <div class="b-page__in">
        <div class="b-stripe b-stripe_content_header">
            <div class="b-stripe__in">
                <div class="b-box b-box_content_main-logo">
                    <div class="b-logo b-logo_content_main">
                        <a class="b-logo__thumbnail" title="GRECHKA TODAY" href="/">
                            <ins class="b-ico b-ico_viewtype_logo-decor"></ins>
                            <img src="images/b-logo_type_main--b-logo__image.png" width="344" height="120"
                                 align="GRECHKA TODAY" title="GRECHKA TODAY">
                        </a>
                    </div>
                </div>
                <div class="b-box b-box_content_today-date">
                    <time class="b-date" datetime="<?=date('Y-m-d')?>"><?=date('F j')?><sup><?=$helper->getDateEnds()?></sup></time>
                </div>
            </div>
        </div>

        <div class="b-stripe b-stripe_content_present-value">
            <div class="b-stripe__in">
                <div class="b-cost-buckwheat">
                    <div class="b-cost-buckwheat__value b-cost-buckwheat__value_currency_ru">
                                <span class="b-cost-buckwheat__value-text">
                                    <span
                                        class="<?= $pricePresenter->getDifferenceInRubles() <= 0 ? 'cost_down' : 'cost_up' ?>"><?= $pricePresenter->getRubles() ?></span>
                                    <span class="b-remark b-remark_price_currency_ru">
                                        <span class="b-remark__icon"></span>
                                        <span class="b-remark__dropdown">
                                            Среднее значение цены по&nbsp;оптовым предложениям гречневой крупы с&nbsp;наценкой розничного коэффициента
                                        </span>
                                    </span>
                                </span>
                    </div>
                    <div class="b-cost-buckwheat__value b-cost-buckwheat__value_currency_other">
                        <div class="b-content-columns b-content-columns_content_currency-other">
                            <div class="b-content-column b-content-column_layout_a">
                                <div
                                    class="b-size-changes"><?= $pricePresenter->getDifferenceInRublesFormatted() ?></div>
                            </div>
                            <div class="b-content-column b-content-column_layout_b">
                                <span class="b-value_currency_usd"><?= $pricePresenter->getDollars() ?></span>
                                <span class="b-value_currency_eur"><?= $pricePresenter->getEuro() ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="b-stripe b-stripe_content_diagram-cost charts">
            <div class="b-stripe__in">
                <div class="b-story b-story_content_diagram-cost">
                    <div class="b-story__thumbnail">
                        <canvas id="chart-canvas" width="410" height="200"></canvas>
                    </div>
                    <div class="b-story__content">
                        <ul class="b-list b-list_content_select-period">
                            <li class="b-list__item">
                                <a class="b-list__item-text chart-button-week">неделя</a>
                            </li>
                            <li class="b-list__item b-list__item_type_delimiter">
                                <span class="b-list__item-text">/</span>
                            </li>
                            <li class="b-list__item">
                                <a class="b-list__item-text chart-button-month">месяц</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
        /*<div class="ads" style="text-align: center;padding-top:10px;">
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:50px"
                 data-ad-client="ca-pub-1797214625818644"
                 data-ad-slot="2183884388"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>*/
        ?>
    </div>
</div>
<div class="b-footer">
    <div class="b-footer__in">
        <div class="b-stripe b-stripe_content_social-like">
            <div class="b-stripe__in">
                <div class="b-box b-box_content_social-like">
                    <div id="social" class="social"></div>
                </div>
            </div>
        </div>
        <div class="b-stripe b-stripe_content_contacts">
            <div class="b-stripe__in">
                <div class="b-box b-box_content_mailto">
                    <a href="mailto:info@grechkatoday.ru"
                       title="По всем вопросам пишите письма">© grechkatoday.ru</a>
                </div>
            </div>
        </div>
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
