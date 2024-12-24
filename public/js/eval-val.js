document.querySelector("form").addEventListener("submit", function (event) {
    const errors = [];

    // Fungsi untuk menambahkan pesan error
    function addError(id, message) {
        const field = document.getElementById(id);
        if (!field) return; // Pastikan field ada
        const errorSpan = field.nextElementSibling;
        if (errorSpan && errorSpan.classList.contains("error-message")) {
            errorSpan.textContent = message;
        } else {
            const span = document.createElement("span");
            span.className = "error-message text-danger";
            span.textContent = message;
            field.parentNode.appendChild(span);
        }
        errors.push(id);
    }

    // Fungsi untuk membersihkan pesan error
    function clearError(id) {
        const field = document.getElementById(id);
        if (!field) return; // Pastikan field ada
        const errorSpan = field.nextElementSibling;
        if (errorSpan && errorSpan.classList.contains("error-message")) {
            errorSpan.textContent = "";
        }
    }

    // Validasi field teks
    function validateTextField(id, message) {
        const field = document.getElementById(id);
        clearError(id);
        if (!field || !field.value.trim()) {
            addError(id, message);
        }
    }

    // Validasi email
    function validateEmailField(id, message) {
        const field = document.getElementById(id);
        clearError(id);
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!field || !emailRegex.test(field.value.trim())) {
            addError(id, message);
        }
    }

    // Validasi nomor telepon
    function validatePhoneField(id, message) {
        const field = document.getElementById(id);
        clearError(id);
        const phoneRegex = /^\d+$/;
        if (!field || !phoneRegex.test(field.value.trim())) {
            addError(id, message);
        }
    }

    // Daftar validasi
    validateTextField("prodi", "Program studi harus diisi.");
    validateTextField("nama_calon", "Nama lengkap harus diisi.");
    validateTextField("tempat", "Tempat lahir harus diisi.");
    validateTextField("tanggal_lahir", "Tanggal lahir harus diisi.");
    validateTextField("alamat", "Alamat harus diisi.");
    validatePhoneField("notlp", "Nomor Handphone tidak valid.");
    validateEmailField("email", "Email tidak valid.");
    validateTextField("mk", "Mata Kuliah harus diisi.");

    // Jika ada error, cegah submit form
    if (errors.length > 0) {
        event.preventDefault();
    }
});
