// Show the first slide by default
showSlide();

// Form Tambah Kunjungan
const prosesButton = document.getElementById('simpan');

  prosesButton.addEventListener('click', () => {
    const idKunjungan = document.getElementById('id_kunjungan').value;
    const nama = document.getElementById('nama').value;
    const kelas = document.getElementById('kelas').value;
    const tanggal = document.getElementById('tanggal').value;
    const keluhan = document.getElementById('keluhan').value;
    const namaobat = document.getElementById('nama_obat').value;

    // Lakukan validasi data di sini

    // Simpan data ke database atau melakukan aksi lainnya
    console.log('Data berhasil disimpan!');
  });

    const slides = document.querySelectorAll('.slide');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let currentIndex = 0;

    function showSlide(index) {
        const totalSlides = slides.length;
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(${100 * (i - index)}%)`;
        });
    }

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex === 0) ? slides.length - 1 : currentIndex - 1;
        showSlide(currentIndex);
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    });

    // Initialize slider
    showSlide(currentIndex);
