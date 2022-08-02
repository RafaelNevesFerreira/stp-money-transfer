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

                if (valor >= 20 && valor <= 50) {
                    var minha_tax = 2
                } else if (valor > 50 && valor <= 150) {
                    minha_tax = 4.5
                } else if (valor > 150 && valor <= 300) {
                    minha_tax = 9
                } else if (valor > 300 && valor <= 500) {
                    minha_tax = 15
                } else if (valor > 500 && valor <= 1000) {
                    minha_tax = 30;
                } else if (valor > 1000 && valor <= 2500) {
                    minha_tax = 75;
                } else if (valor > 2500 && valor <= 5000) {
                    minha_tax = 150;
                } else if (valor < 20) {
                    minha_tax = 1;
                }

                if (valor < 1) {
                    var tax = 0
                } else {
                    var tax = valor * 0.030 + 0.3 + minha_tax
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

    $("#nova_transacao").click(function() {
        $("#nova_transacao_modal").modal("show")
    })
    $("#tipo_transacao").change(function() {
        var value, div_receptor
        value = $(this).val();
        if ($(".cambio").attr("hidden") ==
            "hidden") {
            div_receptor =
                "<div class='mb-3'><label for='receptor_name' class='form-label'>Nome do Receptor</label><input class='form-control' type='text' name='destinatary_name' id='receptor_name' required></div>"
            email =
                "<div class='mb-3'><label for='email' class='form-label'>Email</label><input class='form-control' type='text' name='email' id='email' required></div>"
            name =
                "<div class='mb-3'><label for='receptor_name' class='form-label'>Nome</label><input class='form-control' type='text' name='name' id='receptor_name' required></div>"
            country =
                "<div class='mb-3'><label for='country' class='form-label'>Pais de Residencia</label><input class='form-control' type='text' name='country' id='country' required></div>"
            address =
                "<div class='mb-3'><label for='address' class='form-label'>Morada</label><input class='form-control' type='text' name='address' id='address' required></div>"
            phone_number =
                "<div class='mb-3 '><label for='phone_number' class='form-label'>Numero de telemovel</label><input class='form-control' type='number' name='phone_number' id='phone_number' required></div>"
            comprovativo =
                "<div class='mb-3'><label for='comprovativo' class='form-label'>Comprovativo da Transferência</label><input class='form-control' accept='image/*' type='file' name='comprovativo' id='comprovativo' required></div>"
            button =
                "<div class='mb-3 text-center'><button class='btn btn-primary' id='enviar' type='submit'>Enviar</button></div>"


            $("#transacao_modal_body_1")
                .append(name + email + country);

            $("#transacao_modal_body_2")
                .append(address + phone_number + div_receptor);

            $(".modal-body-row").append(comprovativo + button)
            $(".cambio").removeAttr("hidden")
            $(".comprovativo").removeAttr("hidden");


        }
    });
