function submit_code(check)
{
    let code = document.getElementById('code-input').value.toUpperCase();
    let email = document.getElementById('email-input').value;

    let messageCodeEnter = 'Please enter a referral code.';
    let messageCodeUpdated = 'The referral code "' + code +'" was updated!';
    let messageCodeAdded = 'The referral code "' + code +'" was added!';
    let messageCodeInvalid = 'The referral code "' + code + '" is not valid, please check your formatting.';
    let messageCodeNotExist = 'The referral code "' + code + '" was not added to the database.';
    let messageCodeInactive = 'The referral code "' + code + '" is inactive.<br>Resubmit to activate the referral code again.';
    let messageCodeShare = '<br>You can copy <a class=\'text-underline\' href=\'https://nebulr.me/module/scrcr/?referral=' + code + '\' target=\'_blank\' rel=\'nofollow\'>this link</a> or the QR-Code below to share this referral code.';
    let messageClassesGreen = 'code-message badge badge-outline-green font-poppins-regular align-center-force margin-semi-medium-top overflow-hidden';
    let messageClassesYellow = 'code-message badge badge-outline-yellow font-poppins-regular align-center-force margin-semi-medium-top overflow-hidden';
    let messageClassesRed = 'code-message badge badge-outline-red font-poppins-regular align-center-force margin-semi-medium-top overflow-hidden';
    let messageQRCode = '<img class=\'qr-code\' src=\'cache/qr/' + code + '.jpg\' alt=\'qr-code\'>';

    if (code.length === 0) {
        renderMessage(messageCodeEnter, messageClassesYellow);

        return;
    } else {
        let url = 'assets/php/frontend_scrcr.php?code=' + code + '&email=' + email;

        if (check) {
            url = 'assets/php/frontend_scrcr.php?code=' + code + '&email=' + email + '&check=true';
        }

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let response = parseInt(this.responseText);

                let messageCodeTimeLeft = 'The referral code "' + code + '" is active until ' + getDate(response * 1000) + ' ' + getTime(response * 1000) + '.';

                switch (response) {
                    case 0:
                        renderMessage(messageCodeAdded + messageCodeShare, messageClassesGreen);
                        renderQR(messageQRCode);
                        break;
                    case 1:
                        renderMessage(messageCodeUpdated + messageCodeShare, messageClassesGreen);
                        renderQR(messageQRCode);
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
                        renderQR(messageQRCode);
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
    let messageElementContainer = document.getElementById('code-message-container');
    let messageElementQR = document.getElementById('code-message-qr');
    let messageElement = document.getElementById('code-message');

    messageElement.innerHTML = message;
    messageElementQR.innerHTML = '';
    messageElementContainer.className = classes;
}

function renderQR(message) {
    let messageElement = document.getElementById('code-message-qr');

    messageElement.innerHTML = message;
}

function getDate(timestamp) {
    return new Date(timestamp).toLocaleDateString('en-US')
}

function getTime(timestamp) {
    return new Date(timestamp).toLocaleTimeString('en-US');
}

function emailCheckbox() {
    let checkbox = document.getElementById('email-checkbox');
    let emailLabel = document.getElementById('email-label');
    let emailInput = document.getElementById('email-input');
    let submitButton = document.getElementById('code-submit');
    let container = document.getElementById('code-form-container');

    if (checkbox.checked === true){
        emailLabel.className = '';
        submitButton.className = 'border-button-transparent margin-large-sides submit-button no-highlight align-center-force margin-medium-bottom';
        container.className = 'align-center-force code-form-large';
        addElement('email-label', 'br', 'form-br', '');
    } else {
        emailLabel.className = 'no-display';
        submitButton.className = 'border-button-transparent margin-large-sides submit-button no-highlight align-center margin-medium-bottom';
        container.className = 'align-center-force code-form';
        emailInput.value = '';
        removeElement('form-br');
    }
}

function addElement(parentId, elementTag, elementId, html) {
    let parent = document.getElementById(parentId);
    let newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.innerHTML = html;

    parent.parentNode.insertBefore(newElement, parent.nextSibling);
}

function removeElement(elementId) {
    let element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
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