    $(document).ready(function() {
        $('#copy-button').click(function() {
            var copyText = document.getElementById("url-text");
            navigator.clipboard.writeText(copyText.value).then(function() {
                alert("Kopyalandı: " + copyText.value);
            }, function(err) {
                alert('Kopyalama işlemi başarısız oldu: ', err);
            });
        });
    });
