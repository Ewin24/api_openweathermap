$(function () {
    $('#forecast').hide();
    $('#prev').hide();

    $('#arrowPrev').mouseover(function () {
        $('#prev').show();
    });
    $('#arrowPrev').mouseout(function () {
        $('#prev').hide();
    });

    $('#btn_forecast').on('click', function () {
        if ($('#arrowPrev').hasClass('fa-arrow-circle-down')) {
            $('#prev').html() === 'Mostrar las previsiones';
            $('#forecast').show();
            $('#arrowPrev').removeClass('fa-arrow-circle-down').addClass('fa-arrow-circle-up');
            $('#prev').html('Ocultar las previsiones');
        }
        else if ($('#arrowPrev').hasClass('fa-arrow-circle-up')) {
            $('#prev').html() === 'Ocultar las previsiones';
            $('#forecast').hide();
            $('#arrowPrev').removeClass('fa-arrow-circle-up').addClass('fa-arrow-circle-down');
            $('#prev').html('Mostrar las previsiones');
        }
    });
});