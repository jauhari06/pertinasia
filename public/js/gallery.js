$(document).ready(function () {
  // Inisialisasi Magnific Popup
  $(".portfolio-img").magnificPopup({
    type: "image",
    gallery: {
      enabled: true, // Mengaktifkan navigasi galeri
      navigateByImgClick: true,
      preload: [0, 1], // Preload gambar next dan previous
    },
    removalDelay: 300,
    mainClass: "mfp-fade",
    closeBtnInside: true,
  });

  // Inisialisasi Isotope setelah semua gambar selesai dimuat
  var $container = $(".lx-portfolio");

  // Pastikan semua gambar telah dimuat sebelum menginisialisasi Isotope
  $container.imagesLoaded(function () {
    $container.isotope({
      itemSelector: ".single_gallery_item",
      layoutMode: "fitRows", // Mengatur tata letak grid
    });
  });

  // Event listener untuk tombol filter
  $(".portfolio-menu .btn").on("click", function () {
    var filterValue = $(this).attr("data-filter");
    $container.isotope({ filter: filterValue }); // Menggunakan filter
    $(".portfolio-menu .btn").removeClass("active");
    $(this).addClass("active");
    return false; // Mencegah reload halaman
  });
});
