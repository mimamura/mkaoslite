// complemento da interface para gerar o qrcode

var qrcode = new QRCode(document.getElementById("qrcode"), {
    width: 60,
    height: 60
});

function makeCode() {
    var elText = document.getElementById("text");

    if (!elText.value) {
        alert("Input a text for QR-code");
        elText.focus();
        return;
    }

    qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
    on("blur", function () {
        makeCode();
    }).
    on("keydown", function (e) {
        if (e.keyCode == 13) {
            makeCode();
        }
    });
