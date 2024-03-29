document.addEventListener("DOMContentLoaded", function() {
    // Obtenir le chemin de l'URL
    var path = window.location.pathname;

    // Ajouter une classe active au lien correspondant à la page actuelle
    if (path.includes("home")) {
        document.querySelector(".navbar .accueil").classList.add("active");
    } else if (path.includes("dashboard")) {
        document.querySelector(".navbar .dashboard").classList.add("active");
    } else if (path.includes("forum")) {
        document.querySelector(".navbar .forum").classList.add("active");
    } else if (path.includes("contact")) {
        document.querySelector(".navbar .contact").classList.add("active");
    } else if (path.includes("history")) {
        document.querySelector(".navbar .history").classList.add("active");
    }
});
