$(function () {

    var a = '#back-to-top';

    if ($(a).length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $(a).on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    $.fn.datepicker.dates['fr'] = {
        days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Jun", "Jui", "Aoû", "Sep", "Oct", "Nov", "Déc"],
        format: "dd/mm/yyyy",
        titleFormat: "MM yyyy",
        weekStart: 0
    };

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        startDate: "new Date()",
        language: "fr",
        multidate: false,
        keyboardNavigation: false,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });

    var datepickercl = '.datepicker-tickets';

    $(datepickercl).datepicker({
        format: "dd/mm/yyyy",
        language: "fr",
        multidate: false,
        keyboardNavigation: false,
        autoclose: true,
        toggleActive: true,
        startView: 'century'
    });

});