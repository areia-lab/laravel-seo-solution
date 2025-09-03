<script>
    // Mobile sidebar toggle
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const sidebar = document.getElementById('sidebar');
    const mobileOverlay = document.getElementById('mobileOverlay');

    function toggleSidebar() {
        sidebar.classList.toggle('active');
        sidebar.classList.toggle('hidden');
        mobileOverlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    }

    mobileMenuButton?.addEventListener('click', toggleSidebar);
    mobileOverlay?.addEventListener('click', toggleSidebar);
</script>
