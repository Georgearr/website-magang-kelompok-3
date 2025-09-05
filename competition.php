<?php
// Database configuration
require_once 'config.php';

// Get competition ID from URL
$competition_id = isset($_GET['id']) ? $_GET['id'] : '';

// Competition data
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
        'prizes' => ['Juara 1: Rp 400.000', 'Juara 2: Rp 250.000', 'Juara 3: Rp 150.000'],
        'registration_fee' => 'Rp 30.000 per tim'
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
        'prizes' => ['Juara 1: Rp 500.000', 'Juara 2: Rp 300.000', 'Juara 3: Rp 200.000'],
        'registration_fee' => 'Rp 25.000 per tim'
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
        'prizes' => ['Juara 1: Rp 450.000', 'Juara 2: Rp 300.000', 'Juara 3: Rp 200.000'],
        'registration_fee' => 'Rp 40.000 per tim'
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
        'prizes' => ['Juara 1: Rp 200.000', 'Juara 2: Rp 150.000', 'Juara 3: Rp 100.000'],
        'registration_fee' => 'Rp 10.000 per peserta'
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
        'prizes' => ['Juara 1: Rp 350.000', 'Juara 2: Rp 225.000', 'Juara 3: Rp 125.000'],
        'registration_fee' => 'Rp 35.000 per tim'
    ]
];

// No additional competitions needed - only the main 5 competitions above

// Handle form submission
if ($_POST && isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $team_members = mysqli_real_escape_string($conn, $_POST['team_members']);
    $competition = mysqli_real_escape_string($conn, $competition_id);
    
    $sql = "INSERT INTO registrations (name, class, phone, email, team_name, team_members, competition, registration_date) 
            VALUES ('$name', '$class', '$phone', '$email', '$team_name', '$team_members', '$competition', NOW())";
    
    if (mysqli_query($conn, $sql)) {
        $success_message = "Pendaftaran berhasil! Terima kasih telah mendaftar.";
    } else {
        $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
    }
}

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
    <header>
        <div class="container">
            <a href="index.html" class="back-btn">← Kembali</a>
            <h1><?php echo $competition_data['title']; ?></h1>
            <p>Pendaftaran Lomba Memoria Aeterna OSIS</p>
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
                        
                        <?php if (isset($success_message)): ?>
                            <div class="alert alert-success">
                                <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-error">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
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
                            
                            <button type="submit" name="register" class="submit-btn">Daftar Sekarang</button>
                        </form>
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