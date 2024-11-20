<script>
    function show(title, details) {
        const htmlStyle = document.documentElement.getAttribute('data-style');
        const isDarkMode = htmlStyle === 'dark' || (htmlStyle !== 'light' && window.matchMedia(
            '(prefers-color-scheme: dark)').matches);

        let htmlContent = '';
        details.forEach(item => {
            htmlContent += `
            <div class="mb-3">
                <label class="form-label"><strong>${item.label}:</strong></label>
                <input type="text" value="${item.value}" class="form-control" disabled>
            </div>
        `;
        });

        Swal.fire({
            title: title,
            html: htmlContent,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: 'var(--bs-primary)',
            cancelButtonColor: '#8592a3',
            background: isDarkMode ? '#2b2c40' : '#fff',
            color: isDarkMode ? '#b2b2c4' : '#000'
        });
    }
</script>
