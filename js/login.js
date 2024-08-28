document.getElementById('login').addEventListener('submit', function(e) {
    e.preventDefault();

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    if( email && password) {
        
        fetch(`index.php?email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Logado com sucesso:', data);
                 window.location.href = 'page.html';
            } else {
                console.log('Erro ao logar:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
   
    
})


let button = document.getElementById('irPageCadastro'); 
button.addEventListener('click', function() {
    window.location.href = 'cadastro.html';
});