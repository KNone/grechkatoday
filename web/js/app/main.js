define(['jquery', 'app/chart-painter', 'yashare'], function ($, chartPainter) {
    'use strict';
    chartPainter.init($('.charts'));
    var socialDescription = $('.c-social-description').text() + ' #grechkatoday #grechka #usd #eur';
    new Ya.share({
        element: 'social',
        elementStyle: {
            'type': 'none',
            'quickServices': ['vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'moimir', 'gplus']
        },
        link: 'http://grechkatoday.ru/',
        title: 'Гречка Тудэй. Следи за курсом гречки!',
        image: 'http://grechkatoday.ru/images/share/snapshot.png',
        serviceSpecific: {
            vkontakte: {
                title: socialDescription
            },
            twitter: {
                title: socialDescription
            }
        }
    });
});
