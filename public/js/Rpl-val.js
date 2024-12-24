// Script untuk validasi form
document.querySelector("form").addEventListener("submit", function (event) {
    const errors = [];

    // Fungsi untuk menambahkan pesan error
    function addError(id, message) {
        const field = document.getElementById(id);
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
        const errorSpan = field.nextElementSibling;
        if (errorSpan && errorSpan.classList.contains("error-message")) {
            errorSpan.textContent = "";
        }
    }

    // Validasi field teks
    function validateTextField(id, message) {
        const field = document.getElementById(id);
        clearError(id);
        if (!field.value.trim()) {
            addError(id, message);
        }
    }

    // Validasi email
    function validateEmailField(id, message) {
        const field = document.getElementById(id);
        clearError(id);
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value.trim())) {
            addError(id, message);
        }
    }

    // Validasi nomor telepon
    function validatePhoneField(id, message) {
        const field = document.getElementById(id);
        clearError(id);
        const phoneRegex = /^\d+$/;
        if (!phoneRegex.test(field.value.trim())) {
            addError(id, message);
        }
    }

    // Daftar validasi
    validateTextField("program_studi", "Program studi harus diisi.");
    validateTextField("nama_lengkap", "Nama lengkap harus diisi.");
    validateTextField("tempat", "Tempat lahir harus diisi.");
    validateTextField("tanggal_lahir", "Tanggal lahir harus diisi.");
    validateTextField("kebangsaan", "Kebangsaan harus diisi.");
    validateTextField("alamat_rumah", "Alamat rumah harus diisi.");
    validateTextField("kode_pos", "Kode pos harus diisi.");
    validatePhoneField("no_telepon", "No. Telepon/HP harus berupa angka.");
    validateEmailField("email", "Email tidak valid.");
    validateTextField(
        "pendidikan_terakhir",
        "Pendidikan terakhir harus diisi."
    );
    validateTextField(
        "nama_perguruan_tinggi",
        "Nama perguruan tinggi/sekolah harus diisi."
    );
    validateTextField(
        "program_studi_pendidikan",
        "Program studi pendidikan harus diisi."
    );
    validateTextField("tahun_lulus", "Tahun lulus harus diisi.");

    // Jika ada error, cegah submit form
    if (errors.length > 0) {
        event.preventDefault();
    }
});
