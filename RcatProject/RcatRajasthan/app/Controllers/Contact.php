<?php
require_once 'app/Config.php';

class Contact {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function index() {
        // SEO Data
        $pageTitle = "Contact Us - R-CAT Rajasthan | Get in Touch";
        $pageDescription = "Contact R-CAT Rajasthan for course inquiries, admissions, career guidance, and any questions about our technology training programs.";
        $pageKeywords = "contact R-CAT, course inquiry, admission help, career guidance, technology training contact";
        
        // Contact information
        $contactInfo = [
            'phone' => '+91-9876543210',
            'email' => 'info@rcatrajasthan.com',
            'address' => 'R-CAT Institute, Technology Park, Jaipur, Rajasthan - 302001',
            'timings' => 'Mon - Sat: 9:00 AM - 7:00 PM',
            'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3557.5962127156243!2d75.82221731504805!3d26.916770983144576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db5c6f1f7b2a7%3A0x62df5b7e1b4e7f8c!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1634567890123!5m2!1sen!2sin'
        ];
        
        // Include the layout with content
        ob_start();
        include 'app/Views/pages/contact.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
    
    public function submit()
    {
        // Validation rules
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[15]',
            'subject' => 'required|min_length[5]|max_length[200]',
            'message' => 'required|min_length[10]|max_length[1000]',
            'inquiry_type' => 'required|in_list[general,course,admission,career,technical]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'inquiry_type' => $this->request->getPost('inquiry_type'),
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'new'
        ];
        
        try {
            // Insert into database (create table if needed)
            $this->createContactTable();
            $this->db->table('contact_submissions')->insert($data);
            
            // Send email notification (if configured)
            $this->sendEmailNotification($data);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you within 24 hours.'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'Contact form error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly.'
            ]);
        }
    }
    
    public function track()
    {
        $trackingId = $this->request->getGet('id');
        
        if (empty($trackingId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tracking ID is required'
            ]);
        }
        
        try {
            $submission = $this->db->query(
                'SELECT id, name, subject, status, created_at, admin_response 
                 FROM contact_submissions 
                 WHERE id = ? OR tracking_id = ?',
                [$trackingId, $trackingId]
            )->getRow();
            
            if (!$submission) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No submission found with this tracking ID'
                ]);
            }
            
            $statusLabels = [
                'new' => 'Received',
                'in_progress' => 'Under Review',
                'resolved' => 'Resolved',
                'closed' => 'Closed'
            ];
            
            return $this->response->setJSON([
                'success' => true,
                'data' => [
                    'id' => $submission->id,
                    'name' => $submission->name,
                    'subject' => $submission->subject,
                    'status' => $statusLabels[$submission->status] ?? 'Unknown',
                    'submitted_date' => date('M j, Y g:i A', strtotime($submission->created_at)),
                    'response' => $submission->admin_response
                ]
            ]);
            
        } catch (Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error retrieving submission details'
            ]);
        }
    }
    
    private function createContactTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS contact_submissions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(15) NOT NULL,
                subject VARCHAR(200) NOT NULL,
                message TEXT NOT NULL,
                inquiry_type ENUM('general', 'course', 'admission', 'career', 'technical') DEFAULT 'general',
                status ENUM('new', 'in_progress', 'resolved', 'closed') DEFAULT 'new',
                ip_address VARCHAR(45),
                user_agent TEXT,
                admin_response TEXT,
                tracking_id VARCHAR(20),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_email (email),
                INDEX idx_status (status),
                INDEX idx_created_at (created_at),
                INDEX idx_tracking_id (tracking_id)
            )
        ";
        
        $this->db->query($sql);
        
        // Generate tracking ID for new submissions
        $trackingId = 'RCT' . strtoupper(substr(md5(uniqid()), 0, 8));
        return $trackingId;
    }
    
    private function sendEmailNotification($data)
    {
        // This would integrate with your email service
        // For now, just log the submission
        log_message('info', 'New contact submission: ' . json_encode($data));
        
        // You can integrate with services like:
        // - CodeIgniter Email library
        // - PHPMailer
        // - SendGrid
        // - AWS SES
        // - Mailgun
        
        /*
        Example with CodeIgniter Email:
        
        $email = \Config\Services::email();
        $email->setTo('admin@rcatrajasthan.com');
        $email->setSubject('New Contact Form Submission - ' . $data['subject']);
        $email->setMessage("
            New contact form submission received:
            
            Name: {$data['name']}
            Email: {$data['email']}
            Phone: {$data['phone']}
            Subject: {$data['subject']}
            Type: {$data['inquiry_type']}
            
            Message:
            {$data['message']}
            
            IP: {$data['ip_address']}
            Time: {$data['created_at']}
        ");
        
        $email->send();
        */
    }
}

// Initialize and run
$controller = new Contact();
$controller->index();
?>
