function submit_code()
{
    let code = document.getElementById('code-input').value.toUpperCase();
    if (code.length === 0) {
        messageCodeEnter();

        return;
    } else {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let response = parseInt(this.responseText);

                switch (response) {
                    case 0:
                        messageCodeAdded(code);
                        break;
                    case 1:
                        messageCodeUpdated(code);
                        break;
                    case 2:
                        messageCodeInvalid(code);
                        break;
                    case 3:
                        messageCodeEnter();
                        break;
                }
            }
        };
        xmlhttp.open('GET', 'assets/php/frontend_star.php?code=' + code, true);
        xmlhttp.send();
    }

    return false;
}

function messageCodeEnter() {
    let message = 'Please enter a referral code.';
    let messageElement = document.getElementById('code-message');

    messageElement.innerHTML = message;
    messageElement.className = 'color-red align-center';
}

function messageCodeUpdated(code) {
    let message = 'The referral code "' + code +'" was updated!';
    let messageElement = document.getElementById('code-message');

    messageElement.innerHTML = message;
    messageElement.className = 'color-green align-center';
}

function messageCodeAdded(code) {
    let message = 'The referral code "' + code +'" was added!';
    let messageElement = document.getElementById('code-message');

    messageElement.innerHTML = message;
    messageElement.className = 'color-green align-center';
}

function messageCodeInvalid(code) {
    let message = 'The referral code "' + code + '" is not valid, please check your formatting.';
    let messageElement = document.getElementById('code-message');

    messageElement.innerHTML = message;
    messageElement.className = 'color-red align-center';
}

function copyToClipboard() {
    let codeElement = document.getElementById('copyToClipboard');
    let copyText = document.getElementById('copyToClipboard-txt');

    let code = codeElement.title;

    navigator.clipboard.writeText(code).then(function() {
        console.log('Copying to clipboard was successful!');
    }, function(err) {
        console.error('Could not copy code: ', err);
    });

    copyText.innerHTML = 'Code copied!';

    setTimeout(function() {
        copyText.innerHTML = 'Copy to Clipboard';
    }, 3000);
}