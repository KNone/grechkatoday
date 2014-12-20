requirejs.config({
    baseUrl: '/js/lib',
    paths: {
        'app': '../app',
        'jquery': 'jquery-2.1.1.min',
        'chartjs': 'Chart.min'
    }
});

requirejs(['app/main']);