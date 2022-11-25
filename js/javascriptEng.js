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
            $('all_error').innerHTML = 'Uploaded successfully';
            break;
        case "?l=0":
            $('all_error').innerHTML = 'No direct line';
            break;
        case "?l=1":
            $('id_error').innerHTML = 'Username taken!';
            break;
        case "?l=2":
            $('email_error').innerHTML = 'Email taken!';
            break;
        case "?r=0":
            $('all_error').innerHTML = 'No direct line';
            break;
        case "?r=1":
            $('all_error').innerHTML = 'Profile verification not done, verification email sent again';
            break;
        case "?r=2":
            $('all_error').innerHTML = 'Profile successfully verified';
            break;
        case "?r=3":
            $('id_error').innerHTML = "User doesn't exist";
            break;
        case "?r=4":
            $('pass_error').innerHTML = 'Wrong password';
            break;
        case "?r=5":
            $('code_error').innerHTML = 'Wrong captcha';
            break;
        case "?r=6":
            alert("verification email sent")
            break;
            case "?r=7":
            $('all_error').innerHTML = 'This user is banned, for more information you can reach us via email with your username';
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
        $('all_error').innerHTML = 'All fields must be filled';
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
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
    }
    else if ($('title').value.length > 50 || $('title').value.length < 4) {
        $('title_error').innerHTML = 'Title must contain more than 4 characters and less than 50';
        isValid = false;
    }
    if($('content').value == '') {
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
    }
    if($('image').value == '') {
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
    }
    return isValid;

}

var checkComment = function() {
    $('all_error').innerHTML = '';

    var isValid = true;

    if($('content').value == '') {
        $('all_error').innerHTML = "Can't make a empty comment";
        isValid = false;
    }
    return isValid;

}

var checkReport = function() {
    $('all_error').innerHTML = '';

    var isValid = true;

    if($('reason').value == '') {
        $('all_error').innerHTML = "Can't make a empty report";
        isValid = false;
    }
    else if($('reason').value.length > 100) {
        $('all_error').innerHTML =  "Reason can't be more than 100 characters";
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
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
    }
    else if ($('inputname').value.length > 64 || $('inputname').value.length < 4) {
        $('id_error').innerHTML = 'Username must be between 4 and 64 characters';
        isValid = false;
    }


    var em = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if($('inputemail').value == '') {
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
    }
    else if (!em.test($('inputemail').value)) {
        $('email_error').innerHTML = 'Wrong Email format (E.g. example@gmail.com)';
        isValid = false;
    }

    if ($('inputtelefon').value == '') {
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
    }
    else if (isNaN($('inputtelefon').value))
    {
        $('phone_error').innerHTML = 'Phone number must be a number';
        isValid = false;
    }


    if($('inputsifra').value == '') {
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
        return $('inputsifra').value;
    }
    else if ($('inputsifra').value.length > 128 || $('inputsifra').value.length < 4) {
        $('pass_error').innerHTML = 'Password must be between 4 i 128 characters';
        isValid = false;
    }

    if($('inputpsifra').value == '') {
        $('all_error').innerHTML = 'All fields must be filled';
        isValid = false;
    }
    else if ($('inputpsifra').value != $('inputsifra').value) {
        $('rpass_error').innerHTML = "Password doesn't match";
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