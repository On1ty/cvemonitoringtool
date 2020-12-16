<script src="<?= base_url(); ?>plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        const accountForm = $('#account_info_form');
        const passwordForm = $('#account_password_form');

        accountForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(accountForm[0]);

            const url = 'settings/change/info';

            const request = fetch(url, {
                method: 'POST',
                body: formData,
            }).then((response) => {
                return response.json();
            }).then((json) => {
                if (json.error === 0) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Your account information has been updated! Please logout your account to see changes'
                    });
                }
            }).catch((err) => {
                Toast.fire({
                    icon: 'error',
                    title: err
                })
            });
        });

        passwordForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(passwordForm[0]);

            const url = 'settings/change/password';

            const request = fetch(url, {
                method: 'POST',
                body: formData,
            }).then((response) => {
                return response.json();
            }).then((json) => {
                if (json.error != 0) {
                    Toast.fire({
                        icon: 'error',
                        title: json.err,
                    });
                } else {
                    $("input[name*='_pass']").val('');
                    Toast.fire({
                        icon: 'success',
                        title: 'Account password has been updated successfully!',
                    });
                }
            });
        });


    });
</script>