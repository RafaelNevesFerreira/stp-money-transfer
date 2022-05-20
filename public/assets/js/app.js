    $(document).ready(function() {
        number_format = function(number, decimals, dec_point, thousands_sep) {
            number = number.toFixed(decimals);

            var nstr = number.toString();
            nstr += '';
            x = nstr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? dec_point + x[1] : '';
            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

            return x1 + x2;
        }
        $("#youSend").keyup(function() {
            if ($("#youSend").val() < 1) {
                $("#recipientGets").val(0);
            } else {

                var valor = $(this).val()


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

                if (valor < 1) {
                    var tax = 0
                } else {
                    var tax = valor * 0.029 + 0.3 + minha_tax
                }

                var total = valor + tax;
                $("#taxas").text(number_format(tax, 2, ",",
                    "."));
                $("#total").text(number_format(total, 2, ",",
                    "."));
                var selected = $('select[name="moeda"]').val()

                if (selected == "eur") {
                    // create a paragraph element
                    var span = $("<span class='moeda_mudar'>€</span>");

                    // append the paragraph to the parent
                    $("#total").append(span);

                } else if (selected == "usd") {
                    // create a paragraph element
                    var span = $("<span class='moeda_mudar'>$</span>");

                    // append the paragraph to the parent
                    $("#total").append(span);

                } else {
                    // create a paragraph element
                    var span = $("<span class='moeda_mudar'>£</span>");

                    // append the paragraph to the parent
                    $("#total").append(span);

                }

                var valor_mueda = 25;
                $("#recipientGets").val(formater.format(valor * valor_mueda));

            }
        });

        $('#youSend').maskMoney()

        $("#youSendCurrency").change(function() {
            if ($(this).val() == "eur") {
                if ($(".moeda_mudar").length) {
                    $(".moeda_mudar").text("€")
                } else {
                    // create a paragraph element
                    var span = $("<span class='moeda_mudar'>€</span>");

                    // append the paragraph to the parent
                    $("#total").append(span);
                }

                var valor = $("#youSend").val()

                var formater = new Intl.NumberFormat("fr-FR", {
                    style: "currency",
                    currency: "stn"
                });
                valor = parseFloat(valor.replace(".", ''))

                var valor_mueda = 25;

                $("#recipientGets").val(formater.format(valor * valor_mueda));


            } else if ($(this).val() == "usd") {

                if ($(".moeda_mudar").length) {
                    $(".moeda_mudar").text("$")

                } else {
                    // create a paragraph element
                    var span = $("<span class='moeda_mudar'>$</span>");

                    // append the paragraph to the parent
                    $("#total").append(span);
                }

                var valor = $("#youSend").val()

                var formater = new Intl.NumberFormat("fr-FR", {
                    style: "currency",
                    currency: "stn"
                });
                valor = parseFloat(valor.replace(".", ''))


                var valor_mueda = 22;

                $("#recipientGets").val(formater.format(valor * valor_mueda));





            } else {
                var valor = $("#youSend").val()

                var formater = new Intl.NumberFormat("fr-FR", {
                    style: "currency",
                    currency: "stn"
                });
                valor = parseFloat(valor.replace(".", ''))

                var valor_mueda = 29;
                $("#recipientGets").val(formater.format(valor * valor_mueda));

                if ($(".moeda_mudar").length) {
                    $(".moeda_mudar").text("£")

                } else {
                    // create a paragraph element
                    var span = $("<span class='moeda_mudar'>£</span>");

                    // append the paragraph to the parent
                    $("#total").append(span);
                }
            }
        })
        var formater = new Intl.NumberFormat("stn", {
            style: "currency",
            currency: "stn"
        });
        $("#recipientGets").val(formater.format(625));


        //imagem dos posts do blog
        $(".embedded_image").children('img').addClass("img-fluid");

        /////////////////////////////////////////////////////
        $('#total').maskMoney()

        $(".pagar_em_prestacoes").click(function() {

            if ($(this).val() == "sim") {
                $("#memes").removeAttr("hidden")

                $(".prestacoes").prop("required", true)
            } else {
                $("#memes").prop("hidden", true)
                $(".prestacoes").removeAttr("required")


            }
        });


    })