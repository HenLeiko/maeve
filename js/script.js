document.querySelector('#register').onclick = function () {
    document.querySelector('#modal').style.display = 'block';
}

document.querySelector('.close').onclick = function () {
    document.querySelector('#modal').style.display = 'none';
}

function register() {
    var hrx = new XMLHttpRequest();

    hrx.open('POST', 'register.php');

    var formData = {
        email: document.querySelector('input[name="email"]').value,
        login: document.querySelector('input[name="login"]').value,
        password: document.querySelector('input[name="password"]').value,
        repeat_password: document.querySelector('input[name="repeat-password"]').value
    }
    let body = JSON.stringify(formData);
    //alert(body);
    hrx.send(body);
    hrx.onreadystatechange = function () {
        if (hrx.readyState === 4 && hrx.status === 200) {

            data = JSON.parse(hrx.response);

        }

    }

}