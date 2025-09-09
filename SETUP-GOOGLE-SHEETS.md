# Setup Guide: Memoria Aeterna dengan Google Sheets

## 📝 Ringkasan Perubahan

Website sekarang sudah diubah dari PHP ke JavaScript murni yang kompatibel dengan **GitHub Pages**. Sistem pendaftaran sekarang menggunakan Google Sheets sebagai database.

---

## 🚀 Langkah Setup Google Sheets

### 1. Buat Google Sheet Baru
- Buka [Google Sheets](https://sheets.google.com)
- Buat sheet baru dengan nama "Memoria Aeterna Registrations"
- Di baris pertama, buat header kolom:
  ```
  A1: Timestamp    E1: Email
  B1: Name         F1: Team Name  
  C1: Class        G1: Team Members
  D1: Phone        H1: Competition
  ```

### 2. Setup Google Apps Script
- Di Google Sheet, klik `Extensions` → `Apps Script`
- Hapus kode default dan ganti dengan kode dari file `google-apps-script.js`
- Save dengan nama "Memoria Aeterna API"

### 3. Deploy sebagai Web App
- Di Apps Script, klik `Deploy` → `New deployment`
- Pilih type: `Web app`
- Execute as: `Me (your-email@gmail.com)`
- Who has access: `Anyone`
- Klik `Deploy`
- **Copy URL yang diberikan** (contoh: `https://script.google.com/macros/s/ABC123.../exec`)

### 4. Update Website
- Buka file `form-handler.js`
- Cari baris: `this.SCRIPT_URL = 'https://script.google.com/macros/s/YOUR_SCRIPT_ID/exec';`
- Ganti `YOUR_SCRIPT_ID` dengan URL yang didapat dari step 3

---

## 📁 File Yang Diubah

### ✅ File Baru:
- `form-handler.js` - JavaScript untuk menangani form submission
- `google-apps-script.js` - Script untuk Google Apps Script
- `SETUP-GOOGLE-SHEETS.md` - Dokumentasi ini

### ✅ File Yang Diupdate:
- `index.html` - Ditambah script form-handler.js
- `trilomba.html` - Form diubah ke JavaScript
- `yelyel-kelompok.html` - Form diubah ke JavaScript  
- `box-is-lava.html` - Form diubah ke JavaScript

### ❌ File Yang Dihapus:
- `submit_registration.php` - Tidak diperlukan lagi
- `config.php` - Tidak diperlukan lagi
- `memoria_aeterna.db` - Tidak diperlukan lagi

---

## 🌐 Deploy ke GitHub Pages

1. **Upload ke GitHub Repository**
   ```bash
   git add .
   git commit -m "Convert to JavaScript + Google Sheets"
   git push origin main
   ```

2. **Aktifkan GitHub Pages**
   - Go to repository Settings
   - Scroll ke Pages section
   - Source: Deploy from a branch
   - Branch: main
   - Save

3. **Website akan tersedia di:**
   `https://username.github.io/repository-name`

---

## 🧪 Testing

1. Buka website di browser
2. Klik salah satu kompetisi (misal: Trilomba)
3. Isi form pendaftaran
4. Submit form
5. Cek Google Sheet - data harus muncul di baris baru

---

## 🔧 Troubleshooting

**❌ Form tidak submit:**
- Pastikan Google Apps Script sudah di-deploy
- Pastikan URL di `form-handler.js` sudah benar
- Cek browser console untuk error

**❌ Data tidak masuk ke Sheet:**
- Pastikan Apps Script permission sudah diatur dengan benar
- Cek execution log di Google Apps Script

**❌ CORS Error:**
- Pastikan Apps Script di-deploy dengan access "Anyone"

---

## ✨ Fitur Yang Tersedia

✅ **Entrance Animation** - Logo dengan efek api saat loading  
✅ **Responsive Design** - Gambar kompetisi fit di card untuk desktop & mobile  
✅ **Google Sheets Integration** - Data tersimpan otomatis  
✅ **Form Validation** - Validasi field wajib  
✅ **Loading States** - Feedback visual saat submit  
✅ **Error Handling** - Pesan error jika ada masalah  

---

## 📞 Support

Jika ada pertanyaan atau masalah, silakan:
1. Cek browser console untuk error messages
2. Cek Google Apps Script execution log
3. Pastikan semua langkah setup sudah diikuti dengan benar

**Selamat! Website sekarang siap di-deploy ke GitHub Pages! 🎉**