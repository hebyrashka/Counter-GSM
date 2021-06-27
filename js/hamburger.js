let beOpenNavbar = false;
let canOpen = true;

$('#btn-hamburger').click(function () {
    if (canOpen == true) {
        switch (beOpenNavbar) {
            case true:
                canOpen = false;
                beOpenNavbar = false;
                if (beOpenNavbar == true) {
                    $('header').attr('style', 'width: 200px;');
                    setTimeout(function () {
                        $('.navbar-content').attr('style', 'display: block;');
                    }, 500)
                }
                if (beOpenNavbar == false) {
                    $('header').attr('style', '');
                    $('.navbar-content').attr('style', '');
                }
                setTimeout(function () {
                    canOpen = true;
                }, 500)
                break;
            case false:
                canOpen = false;
                beOpenNavbar = true;
                if (beOpenNavbar == true) {
                    $('header').attr('style', 'width: 200px;');
                    setTimeout(function () {
                        $('.navbar-content').attr('style', 'display: block;');
                    }, 500)
                }
                if (beOpenNavbar == false) {
                    $('header').attr('style', '');
                    $('.navbar-content').attr('style', '');
                }
                setTimeout(function () {
                    canOpen = true;
                }, 500)
                break;
        }
    }
});