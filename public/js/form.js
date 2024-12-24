$(document).ready(function () {
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    // Tambahkan ini untuk memonitor tombol download
    const downloadButton = $("#downloadStatement");
    const nextButton = $("#nextButton");

    // Pastikan tombol next step disable di awal
    nextButton.prop("disabled", true);

    // Enable tombol next step setelah tombol download di klik
    downloadButton.on("click", function () {
        nextButton.prop("disabled", false);
    });

    // Fungsi untuk melanjutkan ke fieldset berikutnya
    $(".next").click(function () {
        current_fs = $(this).parent(); // Mengambil fieldset saat ini
        next_fs = $(this).parent().next(); // Fieldset berikutnya

        // Tambahkan Class Active pada step berikutnya
        $("#progressbar li")
            .eq($("fieldset").index(next_fs))
            .addClass("active");

        // Tampilkan fieldset berikutnya
        next_fs.show();

        // Sembunyikan fieldset saat ini dengan animasi
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });
                    next_fs.css({ opacity: opacity });
                },
                duration: 600,
            }
        );
    });

    // Fungsi untuk kembali ke fieldset sebelumnya
    $(".previous").click(function () {
        current_fs = $(this).parent(); // Mengambil fieldset saat ini
        previous_fs = $(this).parent().prev(); // Fieldset sebelumnya

        // Hapus class active dari step saat ini
        $("#progressbar li")
            .eq($("fieldset").index(current_fs))
            .removeClass("active");

        // Tampilkan fieldset sebelumnya
        previous_fs.show();

        // Sembunyikan fieldset saat ini dengan animasi
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });
                    previous_fs.css({ opacity: opacity });
                },
                duration: 600,
            }
        );
    });

    $(".submit").click(function (event) {
        event.preventDefault(); // Mencegah pengiriman form secara langsung

        var formData = $("#msform").serialize(); // Ambil data form

        $.ajax({
            url: submitFormUrl, // Menggunakan nama rute
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Menambahkan CSRF token
            },
            success: function (response) {
                if (response.success) {
                    // Mengarahkan ke fieldset 'Formulir Berhasil Dikirim!'
                    var step3 = $("#step3"); // Fieldset dengan pesan berhasil
                    current_fs = $(".submit").parent();
                    next_fs = step3;

                    // Tambahkan Class Active pada step terakhir
                    $("#progressbar li")
                        .eq($("fieldset").index(next_fs))
                        .addClass("active");

                    // Tampilkan fieldset untuk pesan berhasil
                    next_fs.show();

                    // Sembunyikan fieldset saat ini dengan animasi
                    current_fs.animate(
                        { opacity: 0 },
                        {
                            step: function (now) {
                                opacity = 1 - now;
                                current_fs.css({
                                    display: "none",
                                    position: "relative",
                                });
                                next_fs.css({ opacity: opacity });
                            },
                            duration: 600,
                            complete: function () {
                                // Jangan reload halaman, tetap di step 3
                            },
                        }
                    );
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;

                // Hapus pesan error sebelumnya
                $(".text-danger").remove();
                $(".is-invalid").removeClass("is-invalid");

                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        var input = $('[name="' + key + '"]');
                        input.addClass("is-invalid");

                        // Tampilkan pesan error yang sesuai
                        var errorMessages = errors[key];
                        var errorMessage = "";

                        if (
                            errorMessages.includes(
                                "Nama Universitas harus diisi."
                            )
                        ) {
                            errorMessage = "Nama Universitas harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Nama Universitas harus berupa teks."
                            )
                        ) {
                            errorMessage =
                                "Nama Universitas harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Nama Universitas tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Nama Universitas tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes(
                                "Alamat Universitas harus diisi."
                            )
                        ) {
                            errorMessage = "Alamat Universitas harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Alamat Universitas harus berupa teks."
                            )
                        ) {
                            errorMessage =
                                "Alamat Universitas harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Alamat Universitas tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Alamat Universitas tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes(
                                "Kota/Kab Universitas harus diisi."
                            )
                        ) {
                            errorMessage = "Kota/Kab Universitas harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Kota/Kab Universitas harus berupa teks."
                            )
                        ) {
                            errorMessage =
                                "Kota/Kab Universitas harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Kota/Kab Universitas tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Kota/Kab Universitas tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes(
                                "Kode Pos Universitas harus diisi."
                            )
                        ) {
                            errorMessage = "Kode Pos Universitas harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Kode Pos Universitas harus berupa angka."
                            )
                        ) {
                            errorMessage =
                                "Kode Pos Universitas harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Masukkan 5 digit kode pos yang valid."
                            )
                        ) {
                            errorMessage =
                                "Masukkan 5 digit kode pos yang valid.";
                        } else if (
                            errorMessages.includes("Tahun Berdiri harus diisi.")
                        ) {
                            errorMessage = "Tahun Berdiri harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Tahun Berdiri harus berupa angka."
                            )
                        ) {
                            errorMessage = "Tahun Berdiri harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Masukkan 4 digit tahun yang valid."
                            )
                        ) {
                            errorMessage = "Masukkan 4 digit tahun yang valid.";
                        } else if (
                            errorMessages.includes("Jumlah Prodi harus diisi.")
                        ) {
                            errorMessage = "Jumlah Prodi harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Jumlah Prodi harus berupa angka."
                            )
                        ) {
                            errorMessage = "Jumlah Prodi harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Email Universitas harus diisi."
                            )
                        ) {
                            errorMessage = "Email Universitas harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Email Universitas harus berupa alamat email yang valid."
                            )
                        ) {
                            errorMessage =
                                "Email Universitas harus berupa alamat email yang valid.";
                        } else if (
                            errorMessages.includes(
                                "Email Universitas tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Email Universitas tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes(
                                "Telepon Kantor harus diisi."
                            )
                        ) {
                            errorMessage = "Telepon Kantor harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Telepon Kantor harus berupa angka."
                            )
                        ) {
                            errorMessage = "Telepon Kantor harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Masukkan nomor telepon kantor yang valid (6-15 digit)."
                            )
                        ) {
                            errorMessage =
                                "Masukkan nomor telepon kantor yang valid (6-15 digit).";
                        } else if (
                            errorMessages.includes(
                                "Fax Kantor harus berupa angka."
                            )
                        ) {
                            errorMessage = "Fax Kantor harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Masukkan nomor fax yang valid (6-15 digit)."
                            )
                        ) {
                            errorMessage =
                                "Masukkan nomor fax yang valid (6-15 digit).";
                        } else if (
                            errorMessages.includes(
                                "Website Universitas harus diisi."
                            )
                        ) {
                            errorMessage = "Website Universitas harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Website Universitas tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Website Universitas tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes("Nama Lengkap harus diisi.")
                        ) {
                            errorMessage = "Nama Lengkap harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Nama Lengkap harus berupa teks."
                            )
                        ) {
                            errorMessage = "Nama Lengkap harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Nama Lengkap tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Nama Lengkap tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes("Tempat Lahir harus diisi.")
                        ) {
                            errorMessage = "Tempat Lahir harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Tempat Lahir harus berupa teks."
                            )
                        ) {
                            errorMessage = "Tempat Lahir harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Tempat Lahir tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Tempat Lahir tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes("Tanggal Lahir harus diisi.")
                        ) {
                            errorMessage = "Tanggal Lahir harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Tanggal Lahir harus berupa tanggal yang valid."
                            )
                        ) {
                            errorMessage =
                                "Tanggal Lahir harus berupa tanggal yang valid.";
                        } else if (
                            errorMessages.includes("Masa Jabatan harus diisi.")
                        ) {
                            errorMessage = "Masa Jabatan harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Masa Jabatan harus berupa teks."
                            )
                        ) {
                            errorMessage = "Masa Jabatan harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Masa Jabatan tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Masa Jabatan tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes("Alamat Rumah harus diisi.")
                        ) {
                            errorMessage = "Alamat Rumah harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Alamat Rumah harus berupa teks."
                            )
                        ) {
                            errorMessage = "Alamat Rumah harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Alamat Rumah tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Alamat Rumah tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes(
                                "Kota/Kab Rumah harus diisi."
                            )
                        ) {
                            errorMessage = "Kota/Kab Rumah harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Kota/Kab Rumah harus berupa teks."
                            )
                        ) {
                            errorMessage = "Kota/Kab Rumah harus berupa teks.";
                        } else if (
                            errorMessages.includes(
                                "Kota/Kab Rumah tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Kota/Kab Rumah tidak boleh lebih dari 255 karakter.";
                        } else if (
                            errorMessages.includes(
                                "Kode Pos Rumah harus diisi."
                            )
                        ) {
                            errorMessage = "Kode Pos Rumah harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Kode Pos Rumah harus berupa angka."
                            )
                        ) {
                            errorMessage = "Kode Pos Rumah harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Masukkan 5 digit kode pos yang valid."
                            )
                        ) {
                            errorMessage =
                                "Masukkan 5 digit kode pos yang valid.";
                        } else if (
                            errorMessages.includes("Telepon Rumah harus diisi.")
                        ) {
                            errorMessage = "Telepon Rumah harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Telepon Rumah harus berupa angka."
                            )
                        ) {
                            errorMessage = "Telepon Rumah harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Masukkan nomor telepon rumah yang valid (6-15 digit)."
                            )
                        ) {
                            errorMessage =
                                "Masukkan nomor telepon rumah yang valid (6-15 digit).";
                        } else if (
                            errorMessages.includes(
                                "Nomor Handphone harus diisi."
                            )
                        ) {
                            errorMessage = "Nomor Handphone harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Nomor Handphone harus berupa angka."
                            )
                        ) {
                            errorMessage =
                                "Nomor Handphone harus berupa angka.";
                        } else if (
                            errorMessages.includes(
                                "Masukkan nomor handphone yang valid (10-15 digit)."
                            )
                        ) {
                            errorMessage =
                                "Masukkan nomor handphone yang valid (10-15 digit).";
                        } else if (
                            errorMessages.includes("Email Pribadi harus diisi.")
                        ) {
                            errorMessage = "Email Pribadi harus diisi.";
                        } else if (
                            errorMessages.includes(
                                "Email Pribadi harus berupa alamat email yang valid."
                            )
                        ) {
                            errorMessage =
                                "Email Pribadi harus berupa alamat email yang valid.";
                        } else if (
                            errorMessages.includes(
                                "Email Pribadi tidak boleh lebih dari 255 karakter."
                            )
                        ) {
                            errorMessage =
                                "Email Pribadi tidak boleh lebih dari 255 karakter.";
                        }

                        input.before(
                            '<div class="text-danger">' +
                                errorMessage +
                                "</div>"
                        );
                    }
                }
            },
        });

        return false; // Pastikan form tidak dikirim secara default
    });
});
