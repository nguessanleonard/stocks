<li class="position-absolute pos-top pos-right d-none d-sm-block">
    <span id="js-get-date"></span>
</li>

<script>
    function afficherDateHeure() {
        const maintenant = new Date();

        const dateHeure = maintenant.toLocaleString('fr-FR', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        document.getElementById('js-get-date').textContent = dateHeure;
    }

    afficherDateHeure();

    setInterval(afficherDateHeure, 1000);
</script>
