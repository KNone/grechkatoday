define(['jquery', 'app/chart-painter', 'yashare'], function ($, chartPainter) {
    'use strict';
    chartPainter.init($('.charts'));
    new Ya.share({
        element: 'social',
        elementStyle: {
            'type': 'none',
            'quickServices': ['vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'moimir', 'gplus']
        },
        link: 'http://grechkatoday.ru/',
        title: 'Гречка Тудэй. Следи за курсом гречки!',
        image: 'http://grechkatoday.ru/images/share/grechka.jpg',
        serviceSpecific: {
            vkontakte: {
                title: 'Гречка Тудэй. Следи за курсом гречки! #grechkatoday #grechka #usd #eur'
            },
            twitter: {
                title: 'Гречка Тудэй. Следи за курсом гречки! #grechkatoday #grechka #usd #eur'
            }
        }
    });
});
