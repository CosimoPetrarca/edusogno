document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
  
    form.addEventListener("submit", async function (event) {
      event.preventDefault();
  
      const nome = document.getElementById("nome").value;
      const cognome = document.getElementById("cognome").value;
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
  
      // validazione lato client
      const errors = validateForm(nome, cognome, email, password);
  
      if (errors.length === 0) {
        // Se non ci sono errori, invia la richiesta AJAX al server
        try {
          const response = await register(nome, cognome, email, password);
  
          if (response.success) {
            // Mostra il messaggio di registrazione effettuata nella modale
            showErrorModal("Registrazione effettuata con successo");
            // Reindirizza l'utente alla pagina di login dopo un breve ritardo
          setTimeout(() => {
            window.location.href = "login.html";
          }, 5000); // Ritardo di 5 secondi
          } else {
            // Mostra il messaggio di errore nella modale
            showErrorModal(response.message);
          }
        } catch (error) {
          console.error("Errore durante la richiesta AJAX:", error);
          // Mostra il messaggio di errore nella modale
          showErrorModal("Si è verificato un errore durante la registrazione.");
        }
      } else {
        // Mostra gli errori di validazione
        displayErrors(errors);
      }
    });
  
    function validateForm(nome, cognome, email, password) {
      const errors = [];
  
      // Esempio di validazione: verifica se il nome è vuoto
      if (nome.trim() === "") {
        errors.push("Il nome è obbligatorio.");
      }
  
      // Esempio di validazione: verifica se il cognome è vuoto
      if (cognome.trim() === "") {
        errors.push("Il cognome è obbligatorio.");
      }
  
      // Esempio di validazione: verifica se l'email è vuota e se è un indirizzo email valido
      if (email.trim() === "") {
        errors.push("L'indirizzo email è obbligatorio.");
      } else if (!isValidEmail(email)) {
        errors.push("L'indirizzo email non è valido.");
      }
  
      // Esempio di validazione: verifica se la password è vuota
      if (password.trim() === "") {
        errors.push("La password è obbligatoria.");
      }
  
      return errors;
    }
  
    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
  
    async function register(nome, cognome, email, password) {
      try {
        const response = await fetch("php/register.php", {
          method: "POST",
          body: new URLSearchParams({ nome, cognome, email, password }),
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
      const closeErrorModal = document.getElementById("close-error-modal");
  
      errorMessage.textContent = message;
      errorModal.style.display = "block";
  
      // Chiudi la finestra modale quando si fa clic sul pulsante "X"
      closeErrorModal.addEventListener("click", function () {
        errorModal.style.display = "none";
      });
  
      // Chiudi la finestra modale quando si fa clic al di fuori di essa
      window.addEventListener("click", function (event) {
        if (event.target === errorModal) {
          errorModal.style.display = "none";
        }
      });
    }
  });
  