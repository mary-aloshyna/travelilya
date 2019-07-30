$(document).ready(function () {

    const inputsAreEmpty = (inputs) => {
        let isEmpty = false;

        inputs.each(function() {
            if ($(this).val() === "") {
                isEmpty = true;
            }
        });

        return isEmpty;
    }

    $('.gallery__row--mobile').slick({
        centerMode: true,
        arrows: false,
        centerPadding: '60px',
        slidesToShow: 1,
        responsive: [{
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }]
    });

    $('#contact__form').submit((event) => {
        event.preventDefault();

        const $form = $('#contact__form');
        const $inputs = $form.find("input, textarea");
        const serializedData = $form.serialize();

        if(inputsAreEmpty($inputs)) {
            $.snackbar({
                content: "Упс! Необходимо заполнить все поля.",
                style: 'error',
                timeout: 5000
            });
            return;
        }

        $inputs.prop("disabled", true);

        const request = $.post("mailer/send_form_email.php", serializedData, () => {
                $.snackbar({
                    content: "Письмо отправлено успешно!",
                    style: 'successful',
                    timeout: 5000
                });
            })
            .fail(() => {
                $.snackbar({
                    content: "Упс, произошла ошибка!",
                    style: 'error',
                    timeout: 5000
                });
            })
            .always(() => {
                $inputs.prop("disabled", false);
            });
    });
});