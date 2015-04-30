$(function() {
    $(document).ready(function() {
        
        //Quand on clique sur le bouton pour quitter, on ferme le menu et on affiche le bouton
        $('#slide-submenu').on('click', function() {
            $(this).closest('.list-group').fadeOut('slide', function() {
                $('.mini-submenu').fadeIn();
            });

        });
        
        //Quand on clique sur le bouton, on affiche le menu
        $('.mini-submenu').on('click', function() {
            $(this).next('.list-group').toggle('slide');
            $('.mini-submenu').hide();
        });
    });
});