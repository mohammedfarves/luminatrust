<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Volunteer;
use App\Models\Donation;
use App\Models\ContactMessage;
use App\Models\ActivityLog;
use Illuminate\Database\Seeder;

class LuminaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create 11 Projects (Matching user spec: Total Projects 11)
        $p1 = Project::create(['title' => 'Clean Water for Rural Schools', 'category' => 'Water & Sanitation', 'status' => 'active', 'target_amount' => 150000.00, 'raised_amount' => 95000.00, 'description' => 'Purification systems for 15 schools']);
        $p2 = Project::create(['title' => 'Empower Girls Education', 'category' => 'Education', 'status' => 'active', 'target_amount' => 200000.00, 'raised_amount' => 140000.00, 'description' => 'Scholarships for 200 girl students']);
        $p3 = Project::create(['title' => 'Tree Plantation & Green Drive', 'category' => 'Environment', 'status' => 'completed', 'target_amount' => 80000.00, 'raised_amount' => 80000.00, 'description' => '5,000 native saplings planted']);
        $p4 = Project::create(['title' => 'Healthcare Screening Camp', 'category' => 'Healthcare', 'status' => 'active', 'target_amount' => 120000.00, 'raised_amount' => 60000.00, 'description' => 'Free medical checkups in remote villages']);
        $p5 = Project::create(['title' => 'Disable Youth Skill Training', 'category' => 'Skill Development', 'status' => 'active', 'target_amount' => 100000.00, 'raised_amount' => 45000.00, 'description' => 'Computer training for specially abled youth']);
        $p6 = Project::create(['title' => 'Nutrition Meal Distribution', 'category' => 'Food & Shelter', 'status' => 'active', 'target_amount' => 90000.00, 'raised_amount' => 50000.00, 'description' => 'Daily nutritious lunches for homeless seniors']);
        $p7 = Project::create(['title' => 'Digital Literacy Bus', 'category' => 'Education', 'status' => 'upcoming', 'target_amount' => 250000.00, 'raised_amount' => 20000.00, 'description' => 'Mobile computer classroom for tribal areas']);
        $p8 = Project::create(['title' => 'Disaster Relief Fund', 'category' => 'Emergency', 'status' => 'active', 'target_amount' => 300000.00, 'raised_amount' => 180000.00, 'description' => 'Emergency relief kits for flood victims']);
        $p9 = Project::create(['title' => 'Solar Lighting for Villages', 'category' => 'Clean Energy', 'status' => 'completed', 'target_amount' => 110000.00, 'raised_amount' => 110000.00, 'description' => 'Solar street lights installed in 8 hamlets']);
        $p10 = Project::create(['title' => 'Women Micro-Entrepreneurship', 'category' => 'Women Empowerment', 'status' => 'active', 'target_amount' => 175000.00, 'raised_amount' => 90000.00, 'description' => 'Micro-grants for rural women artisans']);
        $p11 = Project::create(['title' => 'Stray Animal Care & Rescue', 'category' => 'Animal Welfare', 'status' => 'active', 'target_amount' => 60000.00, 'raised_amount' => 35000.00, 'description' => 'Medical treatment and shelter for injured animals']);

        // 2. Create 52 Volunteers (Matching user spec: Total Volunteers 50+)
        for ($i = 1; $i <= 52; $i++) {
            Volunteer::create([
                'name' => "Volunteer Applicant #{$i}",
                'email' => "volunteer{$i}@example.com",
                'phone' => "+91 98765 " . sprintf('%05d', $i),
                'area_of_interest' => ['Teaching', 'Event Management', 'Social Media', 'Medical Support'][$i % 4],
                'status' => $i <= 5 ? 'pending' : ($i <= 20 ? 'approved' : 'active'),
            ]);
        }

        // 3. Create Sample Donations (Totaling e.g. ₹95,000)
        Donation::create(['donor_name' => 'Rajesh Kumar', 'donor_email' => 'rajesh.k@example.com', 'amount' => 25000.00, 'project_id' => $p1->id, 'payment_method' => 'GPay / UPI', 'payment_status' => 'completed']);
        Donation::create(['donor_name' => 'Priya Sharma', 'donor_email' => 'priya.s@example.com', 'amount' => 50000.00, 'project_id' => $p2->id, 'payment_method' => 'Net Banking', 'payment_status' => 'completed']);
        Donation::create(['donor_name' => 'Anand Gopal', 'donor_email' => 'anand@example.com', 'amount' => 10000.00, 'project_id' => $p3->id, 'payment_method' => 'Credit Card', 'payment_status' => 'completed']);
        Donation::create(['donor_name' => 'Sneha Murali', 'donor_email' => 'sneha@example.com', 'amount' => 5000.00, 'project_id' => null, 'payment_method' => 'PhonePe', 'payment_status' => 'completed']);
        Donation::create(['donor_name' => 'Karthik Raja', 'donor_email' => 'karthik@example.com', 'amount' => 5000.00, 'project_id' => $p4->id, 'payment_method' => 'UPI', 'payment_status' => 'pending']);

        // 4. Create 12 Contact Messages (Matching user spec: Contact Messages 12)
        for ($j = 1; $j <= 12; $j++) {
            ContactMessage::create([
                'name' => "Contact Sender #{$j}",
                'email' => "contact{$j}@domain.org",
                'subject' => $j === 1 ? 'CSR Partnership Proposal' : ($j === 2 ? 'Weekend Volunteering Inquiry' : "General Inquiry #{$j}"),
                'message' => "Hello Lumina Trust team, I am writing to inquire regarding your NGO programs and partnership options.",
                'is_read' => $j > 3,
            ]);
        }

        // 5. Create Activity Logs
        ActivityLog::create(['title' => 'New Donation Received', 'description' => 'Rajesh Kumar donated ₹25,000 for Clean Water Cause', 'type' => 'donation']);
        ActivityLog::create(['title' => 'New Volunteer Application', 'description' => 'Volunteer Applicant #1 registered for Teaching', 'type' => 'volunteer']);
        ActivityLog::create(['title' => 'Project Milestone Achieved', 'description' => 'Empower Girls Education raised ₹1.4 Lakhs', 'type' => 'project']);
        ActivityLog::create(['title' => 'New Contact Message', 'description' => 'Senthil Nathan submitted CSR Partnership Proposal', 'type' => 'message']);
        ActivityLog::create(['title' => 'System Backup Completed', 'description' => 'Automatic database backup completed successfully', 'type' => 'system']);
    }
}
