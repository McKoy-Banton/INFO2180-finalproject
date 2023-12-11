document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const loginButton = document.querySelector('button');
    const invalidMessage = document.getElementById('invalid');

    loginButton.addEventListener('click', (event) => {
        event.preventDefault();

        const formData = new FormData();
        formData.append('email', emailInput.value.trim());
        formData.append('password', passwordInput.value.trim());

        fetch('loginFunction.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) 
            {
                return response.text();
            }
        })
        .then(data => {
            if (data === "grant access") 
            {
                window.location.replace("dashboard.php");
            } 
            else 
            {
                invalidMessage.innerHTML = data;
            }
        })
        .catch(error => {
            console.error(`ERROR: ${error}`);
        });
    });
});
