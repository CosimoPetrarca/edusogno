document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
  
    form.addEventListener("submit", async function (event) {
      event.preventDefault();
  
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
  
      // validazione lato client
      const errors = validateForm(email, password);
  
      if (errors.length === 0) {
        // Se non ci sono errori, invia la richiesta AJAX al server
        try {
          const response = await login(email, password);
  
          if (response.success) {
            // Reindirizza l'utente alla pagina privata
            window.location.href = "../edusogno/private-area.php";
          } else {
            // Mostra la modale di errore con il messaggio ricevuto dal server
            showErrorModal(response.message);
          }
        } catch (error) {
          console.error("Errore durante la richiesta AJAX:", error);
          alert("Si è verificato un errore durante il login.");
        }
      } else {
        // Mostra gli errori di validazione
        displayErrors(errors);
      }
    });
  
    function validateForm(email, password) {
      const errors = [];
  
      // Esempio di validazione: verifica se l'email è vuota
      if (email.trim() === "") {
        errors.push("L'indirizzo email è obbligatorio.");
      }
  
      // Esempio di validazione: verifica se la password è vuota
      if (password.trim() === "") {
        errors.push("La password è obbligatoria.");
      }
  
      return errors;
    }
  
    async function login(email, password) {
      try {
        const response = await fetch("php/login.php", {
          method: "POST",
          body: new URLSearchParams({ email, password }),
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
        });
  
        if (!response.ok) {
          throw new Error("Errore durante la richiesta AJAX.");
        }
  
        return await response.json();
      } catch (error) {
        throw error;
      }
    }
  
    function displayErrors(errors) {
      const errorContainer = document.getElementById("error-container");
      errorContainer.innerHTML = "";
  
      const ul = document.createElement("ul");
  
      errors.forEach((error) => {
        const li = document.createElement("li");
        li.textContent = error;
        ul.appendChild(li);
      });
  
      errorContainer.appendChild(ul);
    }
  
    function showErrorModal(message) {
      const errorModal = document.getElementById("error-modal");
      const errorMessage = document.getElementById("error-message");
  
      errorMessage.textContent = message;
      errorModal.style.display = "block";
  
      const closeBtn = document.querySelector(".close");
      closeBtn.addEventListener("click", function () {
        errorModal.style.display = "none";
      });
  
      window.addEventListener("click", function (event) {
        if (event.target === errorModal) {
          errorModal.style.display = "none";
        }
      });
    }
  });
  