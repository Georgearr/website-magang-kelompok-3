<?php
// Get competition ID from URL
$competition_id = isset($_GET['id']) ? $_GET['id'] : '';

// Competition data with Google Forms URLs
$competitions = [
    'trilomba' => [
        'title' => 'Trilomba',
        'description' => 'Kompetisi gabungan tiga permainan: merangkak di rumput sintetis, pipa bocor, dan mengisi baskom sambil menahan dengan kaki.',
        'requirements' => [
            'Tim terdiri dari 3 orang',
            'Setiap anggota mengerjakan satu permainan',
            'Waktu maksimal 10 menit untuk semua tahap',
            'Peralatan disediakan panitia'
        ],
        'prizes' => ['Juara 1: Menara Snack', 'Juara 2: Menara Snack', 'Juara 3: Menara Snack'],
        'google_form_id' => '1FAIpQLSdYourFormIdHere-Trilomba' // Replace with actual Google Form ID
    ],
    'golden-egg' => [
        'title' => 'Golden Egg (Treasure Hunt)',
        'description' => 'Permainan treasure hunt mencari telur emas yang tersembunyi di berbagai lokasi.',
        'requirements' => [
            'Tim terdiri dari 2-4 orang',
            'Mengikuti petunjuk dan teka-teki yang diberikan',
            'Waktu maksimal 30 menit',
            'Dilarang merusak properti sekolah'
        ],
        'prizes' => ['Juara 1: Mystery Box', 'Juara 2: Mystery Box', 'Juara 3: Mystery Box'],
        'google_form_id' => '1FAIpQLSdYourFormIdHere-GoldenEgg' // Replace with actual Google Form ID
    ],
    'yelyel-kelompok' => [
        'title' => 'Yel-yel Kelompok',
        'description' => 'Kompetisi yel-yel kreatif seperti pada waktu MPLS dan perayaan 17 Agustus.',
        'requirements' => [
            'Tim terdiri dari 8-15 orang',
            'Durasi yel-yel 3-5 menit',
            'Tema semangat kebersamaan',
            'Boleh menggunakan properti dan kostum sederhana'
        ],
        'prizes' => ['Juara 1: -', 'Juara 2: -', 'Juara 3: -'],
        'google_form_id' => '1FAIpQLSdYourFormIdHere-YelYel' // Replace with actual Google Form ID
    ],
    'udara-darat-laut' => [
        'title' => 'Udara Darat Laut',
        'description' => 'Permainan klasik dengan gerakan sesuai instruksi: udara (angkat tangan), darat (berdiri), laut (jongkok).',
        'requirements' => [
            'Peserta individual',
            'Mengikuti instruksi dengan cepat dan tepat',
            'Yang salah gerakan akan tereliminasi',
            'Pemenang adalah yang bertahan hingga akhir'
        ],
        'prizes' => ['Juara 1: -', 'Juara 2: -', 'Juara 3: -'],
        'google_form_id' => '1FAIpQLSdYourFormIdHere-UdaraDaratLaut' // Replace with actual Google Form ID
    ],
    'box-is-lava' => [
        'title' => 'Box is Lava',
        'description' => 'Permainan dimana lantai adalah lava dan hanya kotak yang menjadi tempat aman untuk berdiri.',
        'requirements' => [
            'Tim terdiri dari 4-6 orang',
            'Harus berpindah dari satu kotak ke kotak lain',
            'Tidak boleh menyentuh lantai',
            'Waktu maksimal 15 menit untuk mencapai finish'
        ],
        'prizes' => ['Juara 1: -', 'Juara 2: -', 'Juara 3: -'],
        'google_form_id' => '1FAIpQLSdYourFormIdHere-BoxIsLava' // Replace with actual Google Form ID
    ]
];

$competition_data = isset($competitions[$competition_id]) ? $competitions[$competition_id] : null;

if (!$competition_data) {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $competition_data['title']; ?> - Memoria Aeterna OSIS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="competition.css">
</head>
<body>
    <header class="competition-header">
        <div class="container">
            <div class="header-top">
                <a href="index.html" class="back-btn">
                    <span class="back-icon">←</span>
                    <span class="back-text">Kembali ke Beranda</span>
                </a>
            </div>
            <div class="header-content">
                <h1 class="competition-title"><?php echo $competition_data['title']; ?></h1>
                <p class="competition-subtitle">Pendaftaran Lomba Memoria Aeterna OSIS 2025</p>
                <div class="competition-badge">
                    <span class="badge-free">🎉 GRATIS</span>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="competition-detail">
            <div class="container">
                <div class="detail-grid">
                    <div class="competition-info">
                        <h2>Deskripsi Lomba</h2>
                        <p><?php echo $competition_data['description']; ?></p>
                        
                        <h3>Syarat dan Ketentuan</h3>
                        <ul>
                            <?php foreach ($competition_data['requirements'] as $requirement): ?>
                                <li><?php echo $requirement; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <h3>Hadiah</h3>
                        <ul class="prizes">
                            <?php foreach ($competition_data['prizes'] as $prize): ?>
                                <li><?php echo $prize; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="registration-form">
                        <h2>Form Pendaftaran</h2>
                        
                        <div class="form-info">
                            <p><strong>Cara Pendaftaran:</strong></p>
                            <ol>
                                <li>Isi formulir pendaftaran di bawah ini</li>
                                <li>Data akan tersimpan otomatis di Google Sheets</li>
                                <li>Tim panitia akan menghubungi Anda untuk konfirmasi</li>
                                <li><strong>Pendaftaran GRATIS!</strong></li>
                            </ol>
                        </div>
                        
                        <form id="registration-form" class="custom-form">
                            <div class="form-group">
                                <label for="name">Nama Lengkap *</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="class">Kelas *</label>
                                <input type="text" id="class" name="class" placeholder="Contoh: XII IPA 1" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Nomor HP/WhatsApp *</label>
                                <input type="tel" id="phone" name="phone" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email">
                            </div>
                            
                            <div class="form-group">
                                <label for="team_name">Nama Tim (jika diperlukan)</label>
                                <input type="text" id="team_name" name="team_name">
                            </div>
                            
                            <div class="form-group">
                                <label for="team_members">Anggota Tim (jika diperlukan)</label>
                                <textarea id="team_members" name="team_members" placeholder="Tulis nama-nama anggota tim, pisahkan dengan koma"></textarea>
                            </div>
                            
                            <div class="form-group checkbox-group">
                                <input type="checkbox" id="agree" required>
                                <label for="agree">Saya menyetujui syarat dan ketentuan lomba</label>
                            </div>
                            
                            <button type="submit" class="submit-btn">
                                <span class="btn-text">Daftar Sekarang</span>
                                <span class="btn-loading" style="display: none;">Mengirim...</span>
                            </button>
                        </form>
                        
                        <div id="form-message" class="form-message" style="display: none;"></div>
                        
                        <script>
                        document.getElementById('registration-form').addEventListener('submit', function(e) {
                            e.preventDefault();
                            
                            const submitBtn = this.querySelector('.submit-btn');
                            const btnText = submitBtn.querySelector('.btn-text');
                            const btnLoading = submitBtn.querySelector('.btn-loading');
                            const messageDiv = document.getElementById('form-message');
                            
                            // Show loading state
                            btnText.style.display = 'none';
                            btnLoading.style.display = 'inline';
                            submitBtn.disabled = true;
                            
                            // Get form data
                            const formData = new URLSearchParams();
                            // Replace these entry IDs with actual Google Form entry IDs
                            formData.append('entry.1234567890', document.getElementById('name').value); // Name field
                            formData.append('entry.0987654321', document.getElementById('class').value); // Class field
                            formData.append('entry.1122334455', document.getElementById('phone').value); // Phone field
                            formData.append('entry.5566778899', document.getElementById('email').value); // Email field
                            formData.append('entry.9988776655', document.getElementById('team_name').value); // Team name field
                            formData.append('entry.1357924680', document.getElementById('team_members').value); // Team members field
                            formData.append('entry.2468013579', '<?php echo $competition_id; ?>'); // Competition field
                            
                            // Submit to Google Form
                            const googleFormURL = 'https://docs.google.com/forms/d/e/<?php echo $competition_data['google_form_id']; ?>/formResponse';
                            
                            fetch(googleFormURL, {
                                method: 'POST',
                                body: formData,
                                mode: 'no-cors'
                            })
                            .then(() => {
                                // Reset form
                                this.reset();
                                
                                // Show success message
                                messageDiv.innerHTML = '<div class="alert alert-success">✅ Pendaftaran berhasil! Data Anda telah tersimpan. Tim panitia akan menghubungi Anda segera.</div>';
                                messageDiv.style.display = 'block';
                                
                                // Scroll to message
                                messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                messageDiv.innerHTML = '<div class="alert alert-error">❌ Terjadi kesalahan. Silakan coba lagi atau hubungi panitia.</div>';
                                messageDiv.style.display = 'block';
                            })
                            .finally(() => {
                                // Reset button state
                                btnText.style.display = 'inline';
                                btnLoading.style.display = 'none';
                                submitBtn.disabled = false;
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Multimedia OSIS Kelompok 3</p>
        </div>
    </footer>
</body>
</html>