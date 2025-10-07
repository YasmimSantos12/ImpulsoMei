 function toggleMenu() {
            const sidebar = document.getElementById("sidebar");
            const hamburger = document.getElementById("hamburger");

            sidebar.classList.toggle("active");

            // muda o ícone
            if (sidebar.classList.contains("active")) {
                hamburger.textContent = "✖"; // X
            } else {
                hamburger.textContent = "☰"; // hamburguer
            }
        }