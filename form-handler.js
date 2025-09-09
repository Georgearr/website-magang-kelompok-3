// Google Sheets Form Handler for Memoria Aeterna
// This script handles form submissions to Google Sheets

class GoogleSheetsFormHandler {
    constructor() {
        this.SCRIPT_URL = 'https://script.google.com/macros/s/YOUR_SCRIPT_ID/exec';
        this.init();
    }

    init() {
        // Initialize form handlers for all competition forms
        this.setupFormHandlers();
    }

    setupFormHandlers() {
        // Handle forms on all pages
        const forms = document.querySelectorAll('form[data-competition]');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => this.handleFormSubmit(e));
        });

        // Handle forms with specific IDs (for existing pages)
        const registrationForm = document.getElementById('registration-form');
        if (registrationForm) {
            registrationForm.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }
    }

    async handleFormSubmit(event) {
        event.preventDefault();
        
        const form = event.target;
        const submitBtn = form.querySelector('.submit-btn, button[type="submit"]');
        const messageDiv = document.getElementById('form-message') || this.createMessageDiv(form);
        
        // Show loading state
        this.showLoadingState(submitBtn);
        
        try {
            // Get form data
            const formData = new FormData(form);
            const data = this.formDataToObject(formData);
            
            // Add timestamp
            data.timestamp = new Date().toLocaleString('id-ID');
            
            // Send to Google Sheets
            const response = await this.sendToGoogleSheets(data);
            
            if (response.result === 'success') {
                this.showSuccess(messageDiv, form);
            } else {
                throw new Error(response.error || 'Submission failed');
            }
            
        } catch (error) {
            this.showError(messageDiv, error.message);
        } finally {
            this.resetLoadingState(submitBtn);
        }
    }

    formDataToObject(formData) {
        const object = {};
        formData.forEach((value, key) => {
            object[key] = value;
        });
        return object;
    }

    async sendToGoogleSheets(data) {
        const response = await fetch(this.SCRIPT_URL, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data)
        });

        return await response.json();
    }

    showLoadingState(submitBtn) {
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '📤 Mengirim...';
        }
    }

    resetLoadingState(submitBtn) {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Daftar Sekarang';
        }
    }

    showSuccess(messageDiv, form) {
        form.reset();
        messageDiv.innerHTML = `
            <div class="alert alert-success">
                ✅ Pendaftaran berhasil! Data Anda telah tersimpan di Google Sheets. 
                Tim panitia akan menghubungi Anda segera.
            </div>
        `;
        messageDiv.style.display = 'block';
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    showError(messageDiv, errorMessage) {
        messageDiv.innerHTML = `
            <div class="alert alert-error">
                ❌ Terjadi kesalahan: ${errorMessage}
                <br><small>Silakan coba lagi atau hubungi panitia.</small>
            </div>
        `;
        messageDiv.style.display = 'block';
    }

    createMessageDiv(form) {
        const messageDiv = document.createElement('div');
        messageDiv.id = 'form-message';
        messageDiv.className = 'form-message';
        messageDiv.style.display = 'none';
        form.parentNode.insertBefore(messageDiv, form.nextSibling);
        return messageDiv;
    }

    // Method to set the Google Apps Script URL
    setScriptURL(url) {
        this.SCRIPT_URL = url;
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.formHandler = new GoogleSheetsFormHandler();
    
    // Check if we're in development mode and show setup instructions
    if (window.location.hostname === 'localhost' || window.location.hostname.includes('replit')) {
        console.log('🔧 Setup Instructions for Google Sheets Integration:');
        console.log('1. Create a new Google Sheet');
        console.log('2. Go to Extensions > Apps Script');
        console.log('3. Replace the default code with the provided Google Apps Script');
        console.log('4. Deploy as web app');
        console.log('5. Update the SCRIPT_URL in form-handler.js');
    }
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = GoogleSheetsFormHandler;
}