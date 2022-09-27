window.addEventListener('load', function() {
    document.getElementById('reg-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkRegForm()) this.submit();
    });
});

window.addEventListener('load', function() {
    document.getElementById('log-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkLoginForm()) this.submit();
    });
});

window.addEventListener('load', myCaseFunction);

window.addEventListener('load', function() {
    document.getElementById('adminInsert-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkAdminInsert()) this.submit();
    });
});

window.addEventListener('load', function() {
    document.getElementById('insert-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkInsert()) this.submit();
    });
});

window.addEventListener('load', function() {
    document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkComment()) this.submit();
    });
});

window.addEventListener('load', function() {
    document.getElementById('report-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkReport()) this.submit();
    });
});

var $ = function(id) {
    return document.getElementById(id);
}

function myCaseFunction() {
    $('all_error').innerHTML = '';
    var link = window.location.href;
    var n = link.substr(link.length - 4);
    switch(n) {
        case "?i=0":
            $('all_error').innerHTML = 'Uspesno postavljeno';
            break;
        case "?l=0":
            $('all_error').innerHTML = 'Nema direktne linije';
            break;
        case "?l=1":
            $('id_error').innerHTML = 'Korisničko ime je zauzeto!';
            break;
        case "?l=2":
            $('email_error').innerHTML = 'E-mail vec postoji!';
            break;
        case "?r=0":
            $('all_error').innerHTML = 'Nema direktne linije';
            break;
        case "?r=1":
            $('all_error').innerHTML = 'Verifikacija profila nije odrađena, opet smo Vam poslali verifikacioni E-mail';
            break;
        case "?r=2":
            $('all_error').innerHTML = 'Uspešno je verifikovan profil';
            break;
        case "?r=3":
            $('id_error').innerHTML = 'Ne postoji taj korisnik';
            break;
        case "?r=4":
            $('pass_error').innerHTML = 'Pogrešna šifra';
            break;
        case "?r=5":
            $('code_error').innerHTML = 'Pogrešan captcha';
            break;
        case "?r=6":
            alert("Verifikacioni email je poslat")
            break;
            case "?r=7":
            $('all_error').innerHTML = 'Ovaj profil je banovan, ako zelite da znate zasto ili da se zalite na ovu odluku molimo vam da name se javite preko email-a sa korisnickim imeno';
            break;
            
    }


}

var checkLoginForm = function() {
    $('id_error').innerHTML = '';
    $('pass_error').innerHTML = '';
    $('code_error').innerHTML = '';
    $('all_error').innerHTML = '';

    var isValid = true;

    if($('userLogin').value == '' || $('passLogin').value == '' || $('code').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }

    return isValid;

}
var checkInsert = function() {
    $('title_error').innerHTML = '';
    $('content_error').innerHTML = '';
    $('image_error').innerHTML = '';
    $('all_error').innerHTML = '';

    var isValid = true;

    if($('title').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if ($('title').value.length > 50 || $('title').value.length < 4) {
        $('title_error').innerHTML = 'Titl mora sadržati preko 4 karaktera a ispod 50';
        isValid = false;
    }
    if($('content').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    if($('image').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    return isValid;

}

var checkComment = function() {
    $('all_error').innerHTML = '';

    var isValid = true;

    if($('content').value == '') {
        $('all_error').innerHTML = 'Ne moze se postaviti prazan komentar';
        isValid = false;
    }
    return isValid;

}

var checkReport = function() {
    $('all_error').innerHTML = '';

    var isValid = true;

    if($('reason').value == '') {
        $('all_error').innerHTML = 'Ne moze se postaviti prazan report';
        isValid = false;
    }
    else if($('reason').value.length > 100) {
        $('all_error').innerHTML = 'Razlog ne moze biti duzi od 100 karaktera';
        isValid = false;

    }
    return isValid;

}

var checkAdminInsert = function() {
    $('category_error').innerHTML = '';
    $('manufacturer_error').innerHTML = '';
    $('name_error').innerHTML = '';
    $('description_error').innerHTML = '';
    $('price_error').innerHTML = '';
    $('image_error').innerHTML = '';
    $('all_error').innerHTML = '';

    var isValid = true;

    if (isNaN($('category').value) || isNaN($('manufacturer').value) || $('description').value == ''||
        $('price').value == ''|| $('image').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    if($('name').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if ($('name').value.length < 4) {
        $('name_error').innerHTML = 'Naziv mora sadržati preko 4 karaktera';
        isValid = false;
    }

    if($('description').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if ($('description').value.length > 256) {
        $('description_error').innerHTML = 'Opis mora sadržati do 256 karaktera';
        isValid = false;
    }
    if($('price').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if (isNaN($('price').value)) {
        $('price_error').innerHTML = 'Cena mora sadržati samo brojeve';
        isValid = false;
    }

    return isValid;

}

var checkRegForm = function() {
    $('id_error').innerHTML = '';
    $('pass_error').innerHTML = '';
    $('rpass_error').innerHTML = '';
    $('email_error').innerHTML = '';
    $('phone_error').innerHTML = '';
    $('all_error').innerHTML = '';

    var isValid = true;

    if($('inputname').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if ($('inputname').value.length > 64 || $('inputname').value.length < 4) {
        $('id_error').innerHTML = 'Korisničko ime mora biti između 4 i 64 karaktera';
        isValid = false;
    }


    var em = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if($('inputemail').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if (!em.test($('inputemail').value)) {
        $('email_error').innerHTML = 'Pogrešan format e-mail (npr. example@gmail.com)';
        isValid = false;
    }

    if ($('inputtelefon').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if (isNaN($('inputtelefon').value))
    {
        $('phone_error').innerHTML = 'Telefon mora da sadrži samo brojeve';
        isValid = false;
    }


    if($('inputsifra').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
        return $('inputsifra').value;
    }
    else if ($('inputsifra').value.length > 128 || $('inputsifra').value.length < 4) {
        $('pass_error').innerHTML = 'Lozinka mora biti između 4 i 128 karaktera';
        isValid = false;
    }

    if($('inputpsifra').value == '') {
        $('all_error').innerHTML = 'Sva polja moraju biti popunjena';
        isValid = false;
    }
    else if ($('inputpsifra').value != $('inputsifra').value) {
        $('rpass_error').innerHTML = 'Lozinka se ne podudara';
        isValid = false;
    }

    return isValid;

}


function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    if( isNaN(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}