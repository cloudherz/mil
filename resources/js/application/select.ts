function initApplicationSelect() {

    document.getElementById('LANDING-APPLICATION-SELECT-STUDENT_BUTTON').addEventListener('click', function() {
        document.getElementById('LANDING-APPLICATION-WINDOW-SELECT').style.display = 'none';
        document.getElementById('LANDING-APPLICATION-WINDOW-INDIVIDUAL').style.display = 'none';
        document.getElementById('LANDING-APPLICATION-WINDOW-ENTITY').style.display = 'none';
        document.getElementById('LANDING-APPLICATION-WINDOW-STUDENT').style.display = 'unset';
    });

    document.getElementById('LANDING-APPLICATION-SELECT-INDIVIDUAL_BUTTON').addEventListener('click', function() {
        document.getElementById('LANDING-APPLICATION-WINDOW-SELECT').style.display = 'none';
        document.getElementById('LANDING-APPLICATION-WINDOW-INDIVIDUAL').style.display = 'unset';
        document.getElementById('LANDING-APPLICATION-WINDOW-ENTITY').style.display = 'none';
        document.getElementById('LANDING-APPLICATION-WINDOW-STUDENT').style.display = 'none';
    });

    document.getElementById('LANDING-APPLICATION-SELECT-ENTITY_BUTTON').addEventListener('click', function() {
        document.getElementById('LANDING-APPLICATION-WINDOW-SELECT').style.display = 'none';
        document.getElementById('LANDING-APPLICATION-WINDOW-INDIVIDUAL').style.display = 'none';
        document.getElementById('LANDING-APPLICATION-WINDOW-ENTITY').style.display = 'unset';
        document.getElementById('LANDING-APPLICATION-WINDOW-STUDENT').style.display = 'none';
    });

}

initApplicationSelect();
