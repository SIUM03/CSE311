CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_name VARCHAR(255) NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    contact_info VARCHAR(255),
    application_status ENUM('pending', 'rejected', 'accepted') DEFAULT 'pending'
);

CREATE TABLE achievement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    details TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE premium_listings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE


    );


    INSERT INTO applications (applicant_name, job_title, contact_info, application_status)
    VALUES 
    ('Alice Johnson', 'Software Engineer', 'alice@example.com', 'pending'),
    ('Bob Smith', 'Data Analyst', 'bob@example.com', 'accepted'),
    ('Charlie Brown', 'Project Manager', 'charlie@example.com', 'rejected'),
    ('Diana Prince', 'UX Designer', 'diana@example.com', 'pending'),
    ('Ethan Hunt', 'DevOps Engineer', 'ethan@example.com', 'accepted'),
    ('Fiona Gallagher', 'Product Manager', 'fiona@example.com', 'pending'),
    ('George Michael', 'Backend Developer', 'george@example.com', 'rejected'),
    ('Hannah Baker', 'Frontend Developer', 'hannah@example.com', 'pending'),
    ('Ian Wright', 'QA Engineer', 'ian@example.com', 'accepted'),
    ('Jane Doe', 'Technical Writer', 'jane@example.com', 'pending');


    INSERT INTO achievement (title, details)
    VALUES 
    ('Employee of the Month', 'Awarded for outstanding performance in March 2023'),
    ('Top Salesperson', 'Achieved the highest sales in Q1 2023'),
    ('Best Innovator', 'Recognized for innovative solutions in product development'),
    ('Customer Excellence', 'Provided exceptional customer service in 2023'),
    ('Team Player Award', 'Acknowledged for excellent teamwork in project delivery'),
    ('Leadership Excellence', 'Demonstrated outstanding leadership skills in 2023'),
    ('Best Newcomer', 'Awarded for exceptional performance as a new hire'),
    ('Technical Excellence', 'Recognized for technical expertise in software development'),
    ('Outstanding Mentor', 'Provided excellent mentorship to junior team members'),
    ('Creative Thinker', 'Acknowledged for creative problem-solving skills');


    INSERT INTO premium_listings (job_id, start_date, end_date)
    VALUES 
    (1, '2023-10-01', '2023-10-31'),
    (2, '2023-11-01', '2023-11-30'),
    (3, '2023-12-01', '2023-12-31');