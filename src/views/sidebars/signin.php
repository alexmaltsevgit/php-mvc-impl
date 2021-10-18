<aside class="sidebar column">
    <form id="signin">
        <div class="fields">

            <label class="field">
                <span>Логин</span>
                <input name="username" type="text" placeholder="Логин">
            </label>

            <label class="field">
                <span>Пароль</span>
                <input name="password" type="password" placeholder="Пароль">
            </label>

            <label class="field">
                <input type="submit" value="Зарегистрироваться">
            </label>

        </div>
    </form>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const formEl = document.querySelector('#signin');
        formEl.addEventListener("submit", async (e) => {
            e.preventDefault();
            const body = new FormData(formEl);
            clearForm(formEl);

            const response = await fetch("/php-mvc-impl/signin/try", {
                method: 'POST',
                body: body
            });

            const data = await response.json();
            console.log(data)
        })
    });


    function clearForm(formEl) {
        const inputs = formEl.querySelectorAll('input:not([type="submit"])');
        inputs.forEach(input => input.value = "");
    }
</script>