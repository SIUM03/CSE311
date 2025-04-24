
CREATE TABLE `admin` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1005 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci	

CREATE TABLE `Jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` enum('Software','Marketing','Finance','Healthcare') DEFAULT NULL,
  `job_type` enum('Full-time','Part-time') DEFAULT NULL,
  `location` enum('Online','In-office') DEFAULT NULL,
  `Company` varchar(50) NOT NULL,
  `status` enum('pending','varified','rejected') DEFAULT 'pending',
  PRIMARY KEY (`job_id`)
) 

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('employer','job_seeker') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) 

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES (NULL, 'MD. Abdul Wadud\r\n', 'sium007@gmail.com', 'parents30'), (NULL, 'Admin', 'admin', 'admin'), (NULL, 'Sazim Rahman', 'cr007@nsu.com', 'tobitob\r\n')

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`) VALUES (NULL, 'John Doe', 'john.doe@example.com', 'password123', 'employer', 'active'), (NULL, 'Frank Blue', 'frank.blue@example.com', 'password123', 'job_seeker', 'active'), (NULL, 'Grace Yellow', 'grace.yellow@example.com', 'password123', 'employer', 'active'), (NULL, 'Sium', 'ss@com', 'tobitob', 'job_seeker', 'active'), (NULL, 'brainstation', 'brain@23.com', 'siummmmm', 'employer', 'inactive'), (NULL, 'brb ainstation', 'bra in@23.com', 'siummm mm', 'employer', 'inactive'), (NULL, 'brb adfinstation', 'bradfin@23.com', 'siummmfdmm', 'employer', 'inactive'), (NULL, 'brb adfinstation', 'braddffin@23.com', 'siummmfdmm', 'employer', 'inactive'), (NULL, 'brb adfinstation', 'bradfidfn@23.com', 'siummmfdmm', 'employer', 'inactive'), (NULL, 'Z adfisdnstation', 'bradfdfsin@23.com', 'siummmfdfdfmm', 'employer', 'inactive'), (NULL, 'brb adsdfinstation', 'bradfsain@23.com', 'siummmfdmmd', 'employer', 'inactive'), (NULL, 'brb adfin station', 'brsdadfjhin@23.com', 'siummdfmfdmm', 'employer', 'inactive')

INSERT INTO `advertisements` (`id`, `ad_image`, `description`) VALUES (NULL, 'https://i.ytimg.com/vi/SfLV8hD7zX4/maxresdefault.jpg', '100 dollar per day by sazim musk'), (NULL, 'https://i.ytimg.com/vi/ZgE-ZRvlIlk/maxresdefault.jpg', 'this is a add'), (NULL, 'https://i.ytimg.com/vi/IHIbg3zHJ20/maxresdefault.jpg', '50 dollar till 01/26'), (NULL, 'http://img.zergnet.com/1240050_300.jpg', '1000 dollar add for 5 years')

INSERT INTO `Jobs` (`job_id`, `title`, `salary`, `description`, `category`, `job_type`, `location`, `Company`, `status`) VALUES
(387, 'Content Writer', '60000 USD/year', 'Create and edit digital content.', 'Marketing', 'Part-time', 'Online', 'WordCraft', 'varified'),
(397, 'Data Scientist', '130000 USD/year', 'Extract insights from data.', 'Software', 'Full-time', 'Online', 'DataTech', 'pending'),
(399, 'HR Manager', '85000 USD/year', 'Manage hiring and workplace policies.', 'Marketing', 'Full-time', 'In-office', 'PeopleFirst', 'pending'),
(401, 'Network Administrator', '87000 USD/year', 'Manage network infrastructure.', 'Software', 'Full-time', 'Online', 'NetCom', 'pending'),
(403, 'AI Researcher', '140000 USD/year', 'Develop AI models.', 'Software', 'Full-time', 'Online', 'DeepMindX', 'pending'),
(407, 'Product Manager', '125000 USD/year', 'Lead product development.', 'Software', 'Full-time', 'Online', 'InnovateX', 'varified'),
(408, 'Software Engineer', '120000 USD/year', 'Develop and maintain software.', 'Software', 'Full-time', 'Online', 'TechCorp', 'varified'),
(410, 'Financial Analyst', '95000 USD/year', 'Analyze financial data.', 'Finance', 'Full-time', 'Online', 'FinGrowth', 'varified'),
(420, 'Sales Executive', '75000 USD/year', 'Manage client relations.', 'Marketing', 'Full-time', 'Online', 'SalesForce', 'varified'),
(421, 'Legal Advisor', '115000 USD/year', 'Provide legal guidance.', 'Finance', 'Part-time', 'In-office', 'LegalSolutions', 'varified'),
(422, 'Product Manager', '125000 USD/year', 'Lead product development.', 'Software', 'Full-time', 'Online', 'InnovateX', 'varified'),
(423, 'Software Engineer', '120000 USD/year', 'Develop and maintain software.', 'Software', 'Full-time', 'Online', 'TechCorp', 'varified'),
(425, 'Financial Analyst', '95000 USD/year', 'Analyze financial data.', 'Finance', 'Full-time', 'Online', 'FinGrowth', 'varified'),
(426, 'Healthcare Consultant', '110000 USD/year', 'Advise on healthcare business.', 'Healthcare', 'Part-time', 'In-office', 'MediCare', 'varified'),
(427, 'Data Scientist', '130000 USD/year', 'Extract insights from data.', 'Software', 'Full-time', 'Online', 'DataTech', 'varified'),
(428, 'Cybersecurity Analyst', '105000 USD/year', 'Protect systems from cyber threats.', 'Software', 'Full-time', 'Online', 'SecureTech', 'varified'),
(429, 'HR Manager', '85000 USD/year', 'Manage hiring and workplace policies.', 'Marketing', 'Full-time', 'In-office', 'PeopleFirst', 'varified'),
(430, 'UX/UI Designer', '90000 USD/year', 'Design user-friendly interfaces.', 'Software', 'Part-time', 'Online', 'CreativeDesigns', 'varified'),
(431, 'Network Administrator', '87000 USD/year', 'Manage network infrastructure.', 'Software', 'Full-time', 'Online', 'NetCom', 'varified'),
(432, 'Content Writer', '60000 USD/year', 'Create and edit digital content.', 'Marketing', 'Part-time', 'Online', 'WordCraft', 'varified'),
(433, 'AI Researcher', '140000 USD/year', 'Develop AI models.', 'Software', 'Full-time', 'Online', 'DeepMindX', 'pending'),
(434, 'Healthcare Manager', '98000 USD/year', 'Oversee healthcare operations.', 'Healthcare', 'Full-time', 'In-office', 'MediPlus', 'pending'),
(435, 'Sales Executive', '75000 USD/year', 'Manage client relations.', 'Marketing', 'Full-time', 'Online', 'SalesForce', 'pending'),
(436, 'Legal Advisor', '115000 USD/year', 'Provide legal guidance.', 'Finance', 'Part-time', 'In-office', 'LegalSolutions', 'pending'),
(437, 'Product Manager', '125000 USD/year', 'Lead product development.', 'Software', 'Full-time', 'Online', 'InnovateX', 'pending'),
(438, 'Healthcare Consultant', '110000 USD/year', 'Advise on healthcare business.', 'Healthcare', 'Part-time', 'In-office', 'MediCare', 'varified');

