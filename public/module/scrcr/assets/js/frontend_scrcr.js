function submit_code(check)
{
    let code = document.getElementById('code-input').value.toUpperCase();

    let messageCodeEnter = 'Please enter a referral code.';
    let messageCodeUpdated = 'The referral code "' + code +'" was updated!';
    let messageCodeAdded = 'The referral code "' + code +'" was added!';
    let messageCodeInvalid = 'The referral code "' + code + '" is not valid, please check your formatting.';
    let messageCodeNotExist = 'The referral code "' + code + '" was not added to the database.';
    let messageCodeInactive = 'The referral code "' + code + '" is inactive.<br>Resubmit to activate the referral code again.';
    let messageCodeShare = '<br>You can copy <a class=\'text-underline\' href=\'http://nebulr.localhost/module/scrcr/?referral=' + code + '\' target=\'_blank\' rel=\'nofollow\'>this link</a> to share this referral code.';
    let messageClassesGreen = 'badge badge-outline-green font-poppins-regular align-center';
    let messageClassesYellow = 'badge badge-outline-yellow font-poppins-regular align-center';
    let messageClassesRed = 'badge badge-outline-red font-poppins-regular align-center';

    if (code.length === 0) {
        renderMessage(messageCodeEnter, messageClassesYellow);

        return;
    } else {
        let url = 'assets/php/frontend_scrcr.php?code=' + code;

        if (check) {
            url = 'assets/php/frontend_scrcr.php?code=' + code + '&check=true';
        }

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let response = parseInt(this.responseText);

                let messageCodeTimeLeft = 'The referral code "' + code + '" is active until ' + getDate(response * 1000) + ' ' + getTime(response * 1000) + '.';

                switch (response) {
                    case 0:
                        renderMessage(messageCodeAdded + messageCodeShare, messageClassesGreen);
                        break;
                    case 1:
                        renderMessage(messageCodeUpdated + messageCodeShare, messageClassesGreen);
                        break;
                    case 2:
                        renderMessage(messageCodeInvalid, messageClassesRed);
                        break;
                    case 3:
                        renderMessage(messageCodeEnter, messageClassesYellow);
                        break;
                    case 4:
                        renderMessage(messageCodeNotExist, messageClassesRed);
                        break;
                    case 5:
                        renderMessage(messageCodeInactive, messageClassesRed);
                        break;
                    default:
                        renderMessage(messageCodeTimeLeft + messageCodeShare, messageClassesGreen);
                        break;
                }
            }
        };
        xmlhttp.open('GET', url, true);
        xmlhttp.send();
    }

    return false;
}

function renderMessage(message, classes) {
    let messageElement = document.getElementById('code-message');

    messageElement.innerHTML = message;
    messageElement.className = classes;
}

function getDate(timestamp) {
    return new Date(timestamp).toLocaleDateString('en-US')
}

function getTime(timestamp) {
    return new Date(timestamp).toLocaleTimeString('en-US');
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

$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode === 13) {
            event.preventDefault();
            submit_code(false);
            return false;
        }
    });
});