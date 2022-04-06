    $(document).ready(function() {

        $("#youSend").keyup(function() {
            if ($("#youSend").val() < 1) {
                $("#recipientGets").val(0);
            } else {
                const valor = $(this).val()

                const formater = new Intl.NumberFormat("fr-FR", {
                    style: "currency",
                    currency: "stn"
                });
                valor = parseFloat(valor.replace(".", ''))

                if (valor >= 100 && valor <= 400) {
                    var minha_tax = 27
                } else if (valor > 400 && valor <= 800) {
                    minha_tax = 50
                } else if (valor > 800 && valor <= 1000) {
                    minha_tax = 150
                } else if (valor == 25) {
                    minha_tax = 5;
                } else if (valor < 25) {
                    minha_tax = 3;
                } else {
                    minha_tax = 10;
                }
                var tax = valor * 0.030 + 0.3 + minha_tax

                var total = valor + tax;
                $("#taxas").text(tax.toFixed(2));
                $("#total").text(total);

                valor_mueda = 25;
                $("#recipientGets").val(formater.format(valor * valor_mueda));

            }
        });



        $('#youSend').maskMoney()
        $("#youSendCurrency").change(function() {
            if ($(this).val() == "eur") {
                $(".moeda_mudar").text("€")

            } else if ($(this).val() == "usd") {
                $(".moeda_mudar").text("$")
                var valor = $("#youSend").val()

                var formater = new Intl.NumberFormat("fr-FR", {
                    style: "currency",
                    currency: "stn"
                });
                valor = parseFloat(valor.replace(".", ''))

                if (valor >= 100 && valor <= 400) {
                    var minha_tax = 27
                } else if (valor > 400 && valor <= 800) {
                    minha_tax = 50
                } else if (valor > 800 && valor <= 1000) {
                    minha_tax = 150
                } else if (valor == 25) {
                    minha_tax = 5;
                } else if (valor < 25) {
                    minha_tax = 3;
                } else {
                    minha_tax = 10;
                }
                var tax = valor * 0.030 + 0.3 + minha_tax

                var total = valor + tax;
                $("#taxas").text(tax.toFixed(2));
                $("#total").text(total);

                valor_mueda = 23;
                $("#recipientGets").val(formater.format(valor * valor_mueda));



            } else {
                $(".moeda_mudar").text("£")
            }
        })
        var formater = new Intl.NumberFormat("stn", {
            style: "currency",
            currency: "stn"
        });
        $("#recipientGets").val(formater.format(625));
        $(".embedded_image").children('img').addClass("img-fluid");


    })
