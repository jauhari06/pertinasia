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
    validateTextField("nama", "Nama harus diisi.");
    validateTextField("tempat", "Tempat lahir harus diisi.");
    validateTextField("tanggal_lahir", "Tanggal lahir harus diisi.");
    validateTextField("agama", "Agama harus diisi.");
    validateTextField(
        "institusi_tempat_bekerja",
        "Institusi Tempat Bekerja harus diisi."
    );

    validateTextField("jabatan", "Jabatan harus diisi.");
    validateTextField(
        "alamat_tempat_bekerja",
        "Alamat Tempat Bekerja harus diisi."
    );
    validatePhoneField("telp_faks", "Nomor Telp./Faks tidak valid.");
    validateTextField("alamat_kantor", "Alamat Kantor harus diisi.");

    validatePhoneField("telp_hp", "Nomor Handphone tidak valid.");

    validateEmailField("email", "Email tidak valid.");

    // Jika ada error, cegah submit form
    if (errors.length > 0) {
        event.preventDefault();
    }
});
