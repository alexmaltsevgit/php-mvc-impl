<aside class="sidebar column">
    <form class="fields" id="signup">
        <label class="field">
            <span>Логин</span>
            <input name="username" type="text" placeholder="Логин">
        </label>

        <label class="field">
            <span>Пароль</span>
            <input name="password" type="password" placeholder="Пароль">
        </label>

        <label class="field">
            <span>ФИО</span>
            <input name="realname" type="text" placeholder="Фамилия Имя Отчество">
        </label>

        <label class="field">
            <span>Email</span>
            <input name="email" type="text" placeholder="Email">
        </label>

        <label class="field">
            <span>Дата рождения</span>
            <input name="birthdate" type="date" placeholder="Дата рождения">
        </label>

        <div class="error-message" id="error">
            Ошибка: форма заполнена неверно.
        </div>

        <label class="field">
            <input type="submit" value="Зарегистрироваться">
        </label>
    </form>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const formEl = document.querySelector('#signup');
        const errorMessage = document.querySelector('#error');

        formEl.addEventListener("submit", async (e) => {
            e.preventDefault();
            const body = new FormData(formEl);

            const response = await fetch("/php-mvc-impl/signup/try", {
                method: 'POST',
                body: body
            });

            const result = await response.json();
            if (result) {
                clearForm(formEl);
                errorMessage.style.display = 'none';
                document.location.href = '/php-mvc-impl/'
            } else {
                errorMessage.style.display = 'block';
            }
        })
    });


    function clearForm(formEl) {
        const inputs = formEl.querySelectorAll('input:not([type="submit"])');
        inputs.forEach(input => input.value = "");
    }
</script>
