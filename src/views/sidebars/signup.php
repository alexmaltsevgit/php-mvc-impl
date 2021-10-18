<aside class="sidebar column">
    <form id="signup">
        <div class="fields">

            <label class="field">
                <span>Логин</span>
                <input value="sashatxt" name="username" type="text" placeholder="Логин">
            </label>

            <label class="field">
                <span>Пароль</span>
                <input value="12345678" name="password" type="password" placeholder="Пароль">
            </label>

            <label class="field">
                <span>ФИО</span>
                <input value="Александр" name="realname" type="text" placeholder="Фамилия Имя Отчество">
            </label>

            <label class="field">
                <span>Email</span>
                <input value="orangealexmaltsev@gmail.com" name="email" type="text" placeholder="Email">
            </label>

            <label class="field">
                <span>Дата рождения</span>
                <input name="birthdate" type="date" placeholder="Дата рождения">
            </label>

            <label class="field">
                <input type="submit" value="Зарегистрироваться">
            </label>

        </div>
    </form>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const formEl = document.querySelector('#signup');
        formEl.addEventListener("submit", async (e) => {
            e.preventDefault();
            const body = new FormData(formEl);
            clearForm(formEl);

            const response = await fetch("/php-mvc-impl/signup/try", {
                method: 'POST',
                body: body
            });

            const result = await response.json();
            if (result) {
                document.location.href = '<?= \Config\General::$site_url ?>'
            }
        })
    });


    function clearForm(formEl) {
        const inputs = formEl.querySelectorAll('input:not([type="submit"])');
        inputs.forEach(input => input.value = "");
    }
</script>
