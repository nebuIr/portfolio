function copyToClipboard() {
    let codeElement = document.getElementById('copyToClipboard');
    let copyText = document.getElementById('copyToClipboard-txt');

    let code = codeElement.title;

    navigator.clipboard.writeText(code).then(function() {
        console.log('Async: Copying to clipboard was successful!');
    }, function(err) {
        console.error('Async: Could not copy code: ', err);
    });

    copyText.innerHTML = 'Code copied!';

    setTimeout(function() {
        copyText.innerHTML = 'Copy to Clipboard';
    }, 3000);
}