function logIn() {
  var crypt = new JSEncrypt();
  
  fetch('production/server/gen_key.php')
    .then(response => response.json())
    .then(data => {
      // Utilisez les données JSON ici
      var publicKey = data.public_key;

//alert(publicKey);

      crypt.setPublicKey(publicKey);

      // Récupérer les données du formulaire
      var codeInputValue = document.getElementById('codeInput').value;
      var passwordInputValue = document.getElementById('passwordInput').value;

      // Chiffrer les données avec la clé publique RSA
      var encrypted_id = crypt.encrypt(codeInputValue);
      var encrypted_pd = crypt.encrypt(passwordInputValue);

      // Créer un formulaire dynamiquement
      const form = document.createElement("form");
      form.setAttribute("method", "post");
      form.setAttribute("action", "production/server/authentic_users.php"); // Remplacez par l'URL de votre serveur Node.js

      // Ajouter des champs cachés pour les données chiffrées
      const input1 = document.createElement("input");
      input1.setAttribute("type", "hidden");
      input1.setAttribute("name", "codeInput");
      input1.setAttribute("value", encrypted_id);

      const input2 = document.createElement("input");
      input2.setAttribute("type", "hidden");
      input2.setAttribute("name", "passwordInput");
      input2.setAttribute("value", encrypted_pd);

      // Ajouter les champs cachés au formulaire
      form.appendChild(input1);
      form.appendChild(input2);

      // Ajouter le formulaire à la page et le soumettre
      document.body.appendChild(form);
      form.submit();
    })
    .catch(error => {
      alert('La clé de chiffrement incorrecte :', error);
    });
}
