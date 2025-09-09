// Google Apps Script untuk Memoria Aeterna Registration System
// Copy script ini ke Google Apps Script untuk menghubungkan form dengan Google Sheets

/**
 * INSTRUKSI SETUP:
 * 1. Buat Google Sheet baru dengan nama "Memoria Aeterna Registrations"
 * 2. Buat header kolom di baris pertama: 
 *    A1: Timestamp | B1: Name | C1: Class | D1: Phone | E1: Email | F1: Team Name | G1: Team Members | H1: Competition
 * 3. Go to Extensions > Apps Script
 * 4. Replace kode default dengan script ini
 * 5. Save dan Deploy sebagai Web App
 * 6. Set permissions: Execute as "Me", Access "Anyone"
 * 7. Copy URL yang diberikan dan update di form-handler.js
 */

function doPost(e) {
  try {
    // Parse JSON data from request
    const data = JSON.parse(e.postData.contents);
    
    // Get the active spreadsheet (atau gunakan ID sheet tertentu)
    const sheet = SpreadsheetApp.getActiveSheet();
    
    // Jika sheet kosong, tambahkan header
    if (sheet.getLastRow() === 0) {
      sheet.getRange(1, 1, 1, 8).setValues([
        ['Timestamp', 'Name', 'Class', 'Phone', 'Email', 'Team Name', 'Team Members', 'Competition']
      ]);
      
      // Format header
      const headerRange = sheet.getRange(1, 1, 1, 8);
      headerRange.setFontWeight('bold');
      headerRange.setBackground('#4285f4');
      headerRange.setFontColor('#ffffff');
    }
    
    // Tambahkan data baru ke baris berikutnya
    const newRow = [
      data.timestamp || new Date().toLocaleString('id-ID'),
      data.name || '',
      data.class || '',
      data.phone || '',
      data.email || '',
      data.team_name || '',
      data.team_members || '',
      data.competition || ''
    ];
    
    sheet.appendRow(newRow);
    
    // Return success response
    return ContentService
      .createTextOutput(JSON.stringify({
        result: 'success',
        message: 'Data berhasil disimpan',
        row: sheet.getLastRow()
      }))
      .setMimeType(ContentService.MimeType.JSON);
      
  } catch (error) {
    // Return error response
    return ContentService
      .createTextOutput(JSON.stringify({
        result: 'error',
        error: error.toString()
      }))
      .setMimeType(ContentService.MimeType.JSON);
  }
}

function doGet(e) {
  // Handle GET requests (untuk testing)
  return ContentService
    .createTextOutput(JSON.stringify({
      message: 'Memoria Aeterna Registration API is running',
      timestamp: new Date().toLocaleString('id-ID')
    }))
    .setMimeType(ContentService.MimeType.JSON);
}

// Function untuk testing dari Apps Script editor
function testScript() {
  const testData = {
    timestamp: new Date().toLocaleString('id-ID'),
    name: 'Test User',
    class: 'XII IPA 1',
    phone: '08123456789',
    email: 'test@example.com',
    team_name: 'Test Team',
    team_members: 'User1, User2, User3',
    competition: 'Trilomba'
  };
  
  const mockEvent = {
    postData: {
      contents: JSON.stringify(testData)
    }
  };
  
  const result = doPost(mockEvent);
  console.log(result.getContent());
}