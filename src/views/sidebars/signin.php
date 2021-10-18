<?php


use Core\Session;


$session = new Session();
$is_authenticated = $session->get_is_authenticated();

?>

<aside class="sidebar column">
  <?php if ($is_authenticated): ?>
      <form class="fields" id="signout">
          <label class="field">
              <input id="signout" type="submit" value="Выйти">
          </label>
      </form>
  <?php else: ?>
      <form class="fields" id="signin">
          <label class="field">
              <span>Логин</span>
              <input name="username" type="text" placeholder="Логин">
          </label>

          <label class="field">
              <span>Пароль</span>
              <input name="password" type="password" placeholder="Пароль">
          </label>

          <div class="error-message" id="error">
              Ошибка: неверный логин и/или пароль.
          </div>

          <label class="field">
              <input type="submit" value="Войти">
          </label>
      </form>
  <?php endif; ?>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const signInFormEl = document.querySelector('#signin');
        const errorMessage = document.querySelector('#error') ?? {};

        signInFormEl?.addEventListener("submit", async (e) => {
            e.preventDefault();
            const body = new FormData(signInFormEl);
            clearForm(signInFormEl);

            const response = await fetch("/php-mvc-impl/signin/try", {
                method: 'POST',
                body: body
            });

            const result = await response.json();
            if (result) {
                errorMessage.style.display = 'none';
                document.location.reload();
            } else {
                errorMessage.style.display = 'block';
            }
        })


        const signOutFormEl = document.querySelector('#signout');
        signOutFormEl?.addEventListener("submit", async (e) => {
            e.preventDefault();

            const response = await fetch("/php-mvc-impl/signout/try", {
                method: 'POST',
            });

            const result = await response.json();
            if (result) {
                document.location.reload();
            }
        })
    });


    function clearForm(formEl) {
        const inputs = formEl.querySelectorAll('input:not([type="submit"])');
        inputs.forEach(input => input.value = "");
    }
</script>