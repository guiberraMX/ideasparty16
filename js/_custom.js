(function ($) {
    //jorge Juarez


    var availableTags = [
        "Aguascalientes",
        "Baja California",
        "Baja California Sur",
        "Campeche",
        "CDMX",
        "Chiapas",
        "Chihuahua",
        "Coahuila",
        "Colima",
        "Durango",
        "Estado de México",
        "Guanajuato",
        "Guerrero",
        "Hidalgo",
        "Jalisco",
        "Michoacán",
        "Morelos",
        "Nayarit",
        "Nuevo León",
        "Oaxaca",
        "Puebla",
        "Querétaro",
        "Quintana Roo",
        "San Luis Potosí",
        "Sinaloa",
        "Sonora",
        "Tabasco",
        "Tamaulipas",
        "Tlaxcala",
        "Veracruz",
        "Yucatán",
        "Zacatecas",
        "Otro"
    ];


    $(document).ready(function () {
        $("#ciudad").autocomplete({
            source: availableTags
        });
    });


    $("#submit_btn_2").click(function (e) {
        e.preventDefault();

        var _form    = $("#myForm").serializeArray();
        var formData = {};
        _form.forEach(function (item) {
            formData[item.name] = item.value.toString();
        });

        // var error1 = '<div class="enter-name col-lg-3 align-center"> Enter the name </div>';
        // jQuery("#result").hide().html(error1).fadeIn(500);


        try {

            var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;


            if (formData.nombre == '') throw new Error("Ingresa tu Nombre");
            if (formData.edad == '') throw new Error("Ingresa tu Edad");
            if (formData.ciudad == '') throw new Error("Ingresa tu Ciudad");
            if (formData.correo == '') throw new Error("Ingresa tu Correo");
            if (!filter.test(formData.correo)) throw new Error("Correo Invalido");
            if (formData.codigo == '') throw new Error("Ingresa tu Codigo");


            $.post("/contact.php", formData, function (response) {
                var output;
                if (response.type == 'error') {
                    output = '<div class="error col-lg-3 align-center">' + response.text + '</div>';
                } else {
                    output = '<div class="success col-lg-3 align-center">' + response.text + '</div>';
                }
                $("#result").hide().html(output).fadeIn(500);
            }, 'json');


        } catch (ex) {
            var error1 = '<div class="enter-name col-lg-3 align-center"> ' + ex.message + ' </div>';
            $("#result").hide().html(error1).fadeIn(500);
        }


    });

})(jQuery);