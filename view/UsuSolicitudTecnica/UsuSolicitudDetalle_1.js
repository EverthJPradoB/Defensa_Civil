document.addEventListener('DOMContentLoaded', function () {
    var radioButtons = document.querySelectorAll('[name="grupoItse"]');
    var postActiviSection = document.querySelector('.itse_post_activi');
    var preActiviSection = document.querySelector('.itse_pre_activi');
    var renovaActiviSection = document.querySelector('.itse_renova_certi');
    var hasta_mayor_3000ActiviSection = document.querySelector('.itse_hasta_mayor_3000');


    var checkboxesPostActivi = document.querySelectorAll('[name="post_activi"]');
    var checkboxesPreActivi = document.querySelectorAll('[name="pre_activi"]');

    //
    var checkboxesrenovaActivi = document.querySelectorAll('[name="itse_renova"]');
    var checkboxesHasta_Mayor_3000Activi = document.querySelectorAll('[name="hasta_mayor_3000"]');

    radioButtons.forEach(function (radioButton) {
        radioButton.addEventListener('change', function () {
            if (radioButton.value === '1') {
                // ITSE POSTERIOR AL INICIO DE ACTIVIDADES seleccionado
                postActiviSection.style.display = 'block';
                preActiviSection.style.display = 'none';
                renovaActiviSection.style.display = 'none';
                hasta_mayor_3000ActiviSection.style.display = 'none';

                // Seleccionar todos los checkboxes de post_activi
                checkboxesPostActivi.forEach(function (checkbox) {
                    checkbox.checked = true;
                });

                // Desmarcar todos los checkboxes de pre_activi
                checkboxesPreActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                checkboxesrenovaActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                checkboxesHasta_Mayor_3000Activi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
            } else if (radioButton.value === '2') {
                // ITSE PREVIA AL INICIO DE ACTIVIDADES seleccionado
                postActiviSection.style.display = 'none';
                preActiviSection.style.display = 'block';
                renovaActiviSection.style.display = 'none';
                hasta_mayor_3000ActiviSection.style.display = 'none';
                // Seleccionar todos los checkboxes de pre_activi


                // Desmarcar todos los checkboxes de post_activi
                checkboxesPostActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                checkboxesPreActivi.forEach(function (checkbox) {
                    checkbox.checked = true;
                });

                checkboxesrenovaActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                checkboxesHasta_Mayor_3000Activi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
            } else if (radioButton.value === '3' || radioButton.value === '4') {

                // ITSE PREVIA AL INICIO DE ACTIVIDADES seleccionado
                postActiviSection.style.display = 'none';
                preActiviSection.style.display = 'none';
                renovaActiviSection.style.display = 'block';
                hasta_mayor_3000ActiviSection.style.display = 'none';
                // Seleccionar todos los checkboxes de pre_activi
                checkboxesPreActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                // Desmarcar todos los checkboxes de post_activi
                checkboxesPostActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                // Desmarcar todos los checkboxes de post_activi
                checkboxesrenovaActivi.forEach(function (checkbox) {
                    checkbox.checked = true;
                });
                checkboxesHasta_Mayor_3000Activi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
            } else if (radioButton.value === '5' || radioButton.value === '6') {

                // ITSE PREVIA AL INICIO DE ACTIVIDADES seleccionado
                postActiviSection.style.display = 'none';
                preActiviSection.style.display = 'none';
                renovaActiviSection.style.display = 'none';
                hasta_mayor_3000ActiviSection.style.display = 'block';

                // Seleccionar todos los checkboxes de pre_activi
                checkboxesPreActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                // Desmarcar todos los checkboxes de post_activi
                checkboxesPostActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                // Desmarcar todos los checkboxes de post_activi
                checkboxesrenovaActivi.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                checkboxesHasta_Mayor_3000Activi.forEach(function (checkbox) {
                    checkbox.checked = true;
                });
            }
        });
    });
    checkboxesPostActivi.forEach(function (checkbox) {
        checkbox.disabled = true;

    });

    checkboxesPreActivi.forEach(function (checkbox) {
        checkbox.disabled = true;

    });

    checkboxesrenovaActivi.forEach(function (checkbox) {
        checkbox.disabled = true;

    });

    checkboxesHasta_Mayor_3000Activi.forEach(function (checkbox) {
        checkbox.disabled = true;

    });

    // checkboxesPostActivi.forEach(function (checkbox) {
    //     checkbox.addEventListener('change', function () {
    //         // Puedes agregar código aquí para manejar eventos cuando los checkboxes de post_activi cambian
    //     });
    // });

    // checkboxesPreActivi.forEach(function (checkbox) {
    //     checkbox.addEventListener('change', function () {
    //         // Puedes agregar código aquí para manejar eventos cuando los checkboxes de pre_activi cambian
    //     });
    // });
});



// var inputSelect = document.querySelectorAll('[name="inputSelect"]');
// var checkboxes = document.querySelectorAll('[name="color"], [name="redesSociales"]');

// inputSelect.forEach(function (input) {
//     input.addEventListener("change", function () {
//         // Hide all checkbox groups
//         document.querySelectorAll('.redes, .colores').forEach(function (group) {
//             group.style.display = 'none';
//         });

//         // Show the selected checkbox group
//         var selectedGroup = document.querySelector('.' + input.value);
//         selectedGroup.style.display = 'block';

//         // Uncheck all checkboxes
//         checkboxes.forEach(function (checkbox) {
//             checkbox.checked = false;
//         });

//         // Check the checkboxes in the selected group
//         selectedGroup.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
//             checkbox.checked = true;
//         });
//     });
// });